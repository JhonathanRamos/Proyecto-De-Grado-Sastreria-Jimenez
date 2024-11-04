<?php

namespace App\Controllers;

use App\Models\Login;

class Auth extends BaseController
{
    protected $loginModel;

    public function __construct()
    {
        $this->loginModel = new Login();
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $nombres = $this->request->getPost('nombres');
            $apellidos = $this->request->getPost('apellidos');
            $email = $this->request->getPost('email');
            $celular = $this->request->getPost('celular');

            // Generar una contraseña temporal
            $tempPassword = bin2hex(random_bytes(4)); // Contraseña temporal de 8 caracteres

            // Datos a guardar en la base de datos, incluyendo la contraseña temporal
            $data = [
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'email' => $email,
                'password' => password_hash($tempPassword, PASSWORD_DEFAULT), // Guardar el hash de la contraseña temporal
                'estado' => 1,
                'celular' => $celular,
                'rol' => 2,
                'is_temp_password' => true // Marca que indica que es una contraseña temporal
            ];

            // Guardar el usuario en la base de datos
            if ($this->loginModel->registerClient($data)) {
                // Enviar correo electrónico al usuario con la contraseña temporal
                $emailService = \Config\Services::email();
                $emailService->setFrom('tuemail@gmail.com', 'Sastreria Jimenez');
                $emailService->setTo($email);
                $emailService->setSubject('Registro exitoso: Contraseña Temporal');
                $emailService->setMessage("Hola $nombres,\n\nTu registro fue exitoso. Tu contraseña temporal es: $tempPassword\n\nPor favor, inicia sesión y cambia tu contraseña.");

                if ($emailService->send()) {
                    session()->setFlashdata('success', 'Registro exitoso. Se envió una contraseña temporal a tu correo.');
                } else {
                    session()->setFlashdata('error', 'Error al enviar el correo de registro.');
                }

                return redirect()->to('/login');
            } else {
                session()->setFlashdata('error', 'Error al registrar el usuario.');
                return redirect()->to('/login');
            }
        }

        return view('loginUsuario/change_password');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getVar('email'); // Usando getVar en lugar de getPost por compatibilidad con PSR-7
            $password = $this->request->getVar('password');

            log_message('info', 'Intento de inicio de sesión con email: ' . $email);

            $user = $this->loginModel->verifyUser($email, $password);

            if ($user) {
                session()->set([
                    'isLoggedIn' => true,
                    'user_id' => $user['id'],
                    'user_name' => $user['nombres'],
                    'user_email' => $user['email'],
                    'user_role' => $user['rol'],
                    'is_temp_password' => $user['is_temp_password'] // Asegúrate de que esta clave esté en la base de datos
                ]);

                log_message('info', 'Inicio de sesión exitoso para el usuario: ' . $email);

                if (session()->get('is_temp_password')) {
                    return redirect()->to('/mi-cuenta');
                }

                return ($user['rol'] == 1) ? redirect()->to('/cliente') : redirect()->to('/');
            } else {
                log_message('error', 'Credenciales inválidas para el usuario: ' . $email);
                return redirect()->back()->with('error', 'Credenciales inválidas.');
            }
        }

        return view('loginUsuario/login');
    }


    public function miCuenta()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Aquí podrías obtener más detalles del usuario si fuera necesario
        return view('loginUsuario/miCuenta');
    }

    public function cambiarContrasena()
    {
        if ($this->request->getMethod() === 'post') {
            $newPassword = $this->request->getVar('new_password');
            $confirmPassword = $this->request->getVar('confirm_password');

            if ($newPassword !== $confirmPassword) {
                return redirect()->back()->with('error', 'Las contraseñas no coinciden.');
            }

            $userId = session()->get('user_id');
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la base de datos
            $this->loginModel->update($userId, [
                'password' => $hashedPassword
            ]);

            session()->setFlashdata('success', 'Contraseña actualizada exitosamente.');
            return redirect()->to('/');
        }

        return redirect()->to('/mi-cuenta');
    }

    public function olvidarContrasena()
    {
        // Verifica si el usuario está autenticado
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Obtener el ID y el correo electrónico del usuario
        $userId = session()->get('user_id');
        $userEmail = session()->get('user_email');
        $userName = session()->get('user_name'); // Para personalizar el mensaje

        // Generar una nueva contraseña temporal
        $newPassword = bin2hex(random_bytes(4)); // Genera una contraseña aleatoria de 8 caracteres
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $this->loginModel->update($userId, [
            'password' => $hashedPassword
        ]);

        // Configurar y enviar el correo electrónico con la nueva contraseña
        $emailService = \Config\Services::email();
        $emailService->setFrom('tuemail@example.com', 'Nombre de tu Empresa');
        $emailService->setTo($userEmail);
        $emailService->setSubject('Restablecimiento de Contraseña');
        $emailService->setMessage("Hola $userName,\n\nSe ha generado una nueva contraseña para tu cuenta.\n\nTu nueva contraseña es: $newPassword\n\nPor favor, inicia sesión y cambia tu contraseña tan pronto como puedas para asegurar tu cuenta.");

        // Enviar el correo electrónico y mostrar un mensaje de éxito o error
        if ($emailService->send()) {
            session()->setFlashdata('success', 'Se ha enviado una nueva contraseña a tu correo.');
        } else {
            session()->setFlashdata('error', 'Hubo un problema al enviar el correo de restablecimiento. Por favor, intenta nuevamente.');
        }

        // Redirigir a la página de "Mi Cuenta"
        return redirect()->to('/mi-cuenta');
    }

    public function logout()
    {
        session()->destroy(); // Destruye la sesión actual del usuario
        return redirect()->to('/login'); // Redirige al usuario a la página de inicio de sesión
    }



}
