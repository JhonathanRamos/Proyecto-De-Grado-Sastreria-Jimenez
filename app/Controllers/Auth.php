<?php

namespace App\Controllers;

use App\Models\Login;

class Auth extends BaseController
{
    protected $loginModel;

    public function __construct()
    {
        // require __DIR__ . '/../../vendor/autoload.php'; // Ajustar la ruta al autoload de Composer

        $this->loginModel = new Login();
    }

    public function register()
  
    {

        
        if ($this->request->getMethod() === 'post') {
            $nombres = $this->request->getPost('nombres');
            $apellidos = $this->request->getPost('apellidos');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $celular = $this->request->getPost('celular');

            $data = [
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT), // Hash de la contraseña
                'estado' => 1,
                'celular' => $celular,
                'rol' => 2
            ];

            log_message('info', 'Hash de la contraseña registrada: ' . $data['password']); // Verificar el hash
            if ($this->loginModel->registerClient($data)) {
                session()->setFlashdata('success', 'Registro exitoso. Puedes iniciar sesión.');
                return redirect()->to('/login');
            } else {
                session()->setFlashdata('error', 'Error al registrar el usuario.');
                return redirect()->to('/login');
            }
        }

        
     

        return view('loginUsuario/login');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
    
            // Registrar el intento de inicio de sesión
            log_message('info', 'Intento de inicio de sesión con email: ' . $email);
    
            // Verifica el usuario en la base de datos
            $user = $this->loginModel->verifyUser($email, $password);
    
            if ($user) {
                // Si el usuario existe y la contraseña es válida
                session()->set('user_id', $user['id']);
                session()->set('user_name', $user['nombres']);
                session()->set('user_email', $user['email']);  // Guardar email en la sesión
                session()->set('user_role', $user['rol']); // Guarda el rol del usuario
    
                log_message('info', 'Inicio de sesión exitoso para el usuario: ' . $email);
            
                if ($user['rol'] == 1) {
                    return redirect()->to('/cliente');
                } elseif ($user['rol'] == 2) {
                    return redirect()->to('/index.html');
                }
            } else {
                log_message('error', 'Credenciales inválidas para el usuario: ' . $email);
                return redirect()->back()->with('error', 'Credenciales inválidas.');
            }
        }
    
        return view('loginUsuario/login');
    }
    
    

    
}
