<?php

namespace App\Controllers;

use App\Models\Login;
use App\Models\Reserva;
class Auth extends BaseController
{
    protected $loginModel;
    protected $reservaModel;

    public function __construct()
    {
        $this->loginModel = new Login();
        $this->reservaModel = new Reserva();
    }
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $nombres = strtolower(trim($this->request->getPost('nombres'))); // Convertir a minúsculas
            $apellidos = strtolower(trim($this->request->getPost('apellidos'))); // Convertir a minúsculas
            $email = strtolower(trim($this->request->getPost('email'))); // Email en minúsculas y sin espacios
            $celular = $this->request->getPost('celular');

            // Validación de campos
            if (strlen($nombres) < 3 || strlen($apellidos) < 3) {
                session()->setFlashdata('error', 'Nombre y Apellido deben tener más de 3 caracteres.');
                return redirect()->back()->withInput()->with('activeTab', 'register');
            }

            if (!is_numeric($celular) || strlen($celular) != 8) {
                session()->setFlashdata('error', 'El número de celular debe tener 8 dígitos.');
                return redirect()->back()->withInput()->with('activeTab', 'register');
            }

            // Verificar si el email ya existe
            if ($this->loginModel->where('email', $email)->first()) {
                session()->setFlashdata('error', 'El correo electrónico ya está registrado.');
                return redirect()->back()->withInput()->with('activeTab', 'register');
            }

            // Generar una contraseña temporal
            $tempPassword = bin2hex(random_bytes(4));

            // Datos a guardar en la base de datos
            $data = [
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'email' => $email,
                'password' => password_hash($tempPassword, PASSWORD_DEFAULT),
                'estado' => 1,
                'celular' => $celular,
                'rol' => 2,
                'is_temp_password' => true
            ];

            // Guardar el usuario en la base de datos
            if ($this->loginModel->registerClient($data)) {
                // Crear el mensaje HTML
                $htmlMessage = "
                    <!DOCTYPE html>
                    <html lang='es'>
                    <head>
                        <meta charset='UTF-8'>
                        <style>
                            body { font-family: Arial, sans-serif; color: #333; }
                            .email-container { max-width: 600px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 8px; }
                            .header { background: #2c3e50; padding: 15px; color: #ecf0f1; text-align: center; border-radius: 8px 8px 0 0; }
                            .header h1 { margin: 0; }
                            .content { padding: 20px; }
                            .temp-password { font-size: 20px; color: #e74c3c; padding: 10px; background: #fef3f3; text-align: center; border-radius: 5px; }
                            .footer { text-align: center; color: #95a5a6; font-size: 14px; margin-top: 20px; }
                        </style>
                    </head>
                    <body>
                        <div class='email-container'>
                            <div class='header'>
                                <h1>Sastrería Jimenez</h1>
                                <p>Elegancia y estilo en cada prenda</p>
                            </div>
                            <div class='content'>
                                <p>Hola <strong>$nombres</strong>,</p>
                                <p>¡Tu registro fue exitoso!</p>
                                <p>Nos complace darte la bienvenida a nuestra sastrería. Tu contraseña temporal para ingresar es la siguiente:</p>
                                <div class='temp-password'>$tempPassword</div>
                                <p>Por favor, inicia sesión y cambia tu contraseña lo antes posible para proteger tu cuenta.</p>
                                <p>Gracias por elegir Sastrería Jimenez para tus necesidades de vestimenta.</p>
                            </div>
                            <div class='footer'>
                                &copy; " . date('Y') . " Sastrería Jimenez. Todos los derechos reservados.
                            </div>
                        </div>
                    </body>
                    </html>";

                // Configurar y enviar el correo
                $emailService = \Config\Services::email();
                $emailService->setFrom('tuemail@gmail.com', 'Sastreria Jimenez');
                $emailService->setTo($email);
                $emailService->setSubject('Registro exitoso: Contraseña Temporal');
                $emailService->setMessage($htmlMessage);

                if ($emailService->send()) {
                    session()->setFlashdata('success', 'Registro exitoso. Se envió una contraseña temporal a tu correo.');
                } else {
                    session()->setFlashdata('error', 'Error al enviar el correo de registro.');
                }

                return redirect()->to('/login');
            } else {
                session()->setFlashdata('error', 'Error al registrar el usuario.');
                return redirect()->back()->withInput()->with('activeTab', 'register');
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
                    'user_role' => $user['rol'], // asegúrate de que este valor esté guardado como 'user_role'
                    'is_temp_password' => $user['is_temp_password']
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

        $cliente_id = session()->get('user_id');

        // Obtener las reservas del usuario junto con el nombre y precio de la tela
        $reservas = $this->reservaModel
            ->select('reserva.id, reserva.fechaReserva, tela.nombre as nombreTela, tela.precio')
            ->join('tela', 'tela.id = reserva.idTela')
            ->where('reserva.idUsuario', $cliente_id)
            ->findAll();

        return view('loginUsuario/miCuenta', [
            'reservas' => $reservas
        ]);
    }







    public function cambiarContrasena()
    {
        if ($this->request->getMethod() === 'post') {
            $newPassword = $this->request->getVar('new_password');
            $confirmPassword = $this->request->getVar('confirm_password');

            // Validación de coincidencia de contraseñas
            if ($newPassword !== $confirmPassword) {
                session()->setFlashdata('error', 'Las contraseñas no coinciden.');
                return redirect()->back()->withInput();
            }

            $userId = session()->get('user_id');

            // Obtener la contraseña actual del usuario
            $usuario = $this->loginModel->find($userId);
            $currentPasswordHash = $usuario['password'];

            // Verificar si la nueva contraseña es igual a la actual
            if (password_verify($newPassword, $currentPasswordHash)) {
                session()->setFlashdata('error', 'La nueva contraseña no puede ser igual a la actual.');
                return redirect()->back()->withInput();
            }

            // Encriptar la nueva contraseña y actualizar la base de datos
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $this->loginModel->update($userId, [
                'password' => $hashedPassword,
                'is_temp_password' => 0 // Cambiar a 0 para indicar que ya no es una contraseña temporal
            ]);

            session()->setFlashdata('success', 'Contraseña actualizada exitosamente.');
            return redirect()->to('/mi-cuenta');
        }

        return redirect()->to('/mi-cuenta');
    }

    public function logout()
    {
        session()->destroy(); // Destruye la sesión actual del usuario
        return redirect()->to('/login'); // Redirige al usuario a la página de inicio de sesión
    }


    public function olvidarContrasenia()
    {
        return view('loginUsuario/olvidarContrasenia');
    }


    public function olvidoContrasenia()
    {
        $email = $this->request->getPost('email');

        // Verificar si el correo existe en la base de datos
        $user = $this->loginModel->where('email', $email)->first();

        if (!$user) {
            session()->setFlashdata('error', 'No se encontró ninguna cuenta asociada con este correo electrónico.');
            return redirect()->back();
        }

        // Generar una nueva contraseña temporal
        $newPassword = bin2hex(random_bytes(4)); // Contraseña temporal de 8 caracteres
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $this->loginModel->update($user['id'], [
            'password' => $hashedPassword,
            'is_temp_password' => 1
        ]);

        // Crear el mensaje HTML para el correo de restablecimiento de contraseña
        $htmlMessage = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; color: #333; }
                .email-container { max-width: 600px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 8px; }
                .header { background: #2c3e50; padding: 15px; color: #ecf0f1; text-align: center; border-radius: 8px 8px 0 0; }
                .header h1 { margin: 0; }
                .content { padding: 20px; }
                .temp-password { font-size: 20px; color: #e74c3c; padding: 10px; background: #fef3f3; text-align: center; border-radius: 5px; }
                .footer { text-align: center; color: #95a5a6; font-size: 14px; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='header'>
                    <h1>Sastrería Jimenez</h1>
                    <p>Elegancia y estilo en cada prenda</p>
                </div>
                <div class='content'>
                    <p>Hola <strong>{$user['nombres']}</strong>,</p>
                    <p>Hemos recibido una solicitud para restablecer tu contraseña. A continuación, te proporcionamos una nueva contraseña temporal:</p>
                    <div class='temp-password'>$newPassword</div>
                    <p>Por favor, inicia sesión y cambia esta contraseña lo antes posible para proteger tu cuenta.</p>
                    <p>Gracias por confiar en Sastrería Jimenez.</p>
                </div>
                <div class='footer'>
                    &copy; " . date('Y') . " Sastrería Jimenez. Todos los derechos reservados.
                </div>
            </div>
        </body>
        </html>";

        // Configurar y enviar el correo electrónico con el mensaje HTML
        $emailService = \Config\Services::email();
        $emailService->setFrom('tuemail@example.com', 'Sastrería Jimenez');
        $emailService->setTo($email);
        $emailService->setSubject('Restablecimiento de Contraseña');
        $emailService->setMessage($htmlMessage);

        if ($emailService->send()) {
            session()->setFlashdata('success', 'Se ha enviado una nueva contraseña a tu correo.');
        } else {
            session()->setFlashdata('error', 'Hubo un problema al enviar el correo de restablecimiento. Por favor, intenta nuevamente.');
        }

        return redirect()->to('/login');


    }


    public function index()
    {
        $search = $this->request->getGet('search');
        $query = $this->loginModel->where('estado', 1)->where('rol', 2); // Filtrar solo usuarios con rol de cliente

        if (!empty($search)) {
            $query->groupStart()
                ->like('nombres', $search)
                ->orLike('apellidos', $search)
                ->orLike('email', $search)
                ->orLike('celular', $search)
                ->orLike('fechaRegistro', $search)
                ->groupEnd();
        }

        $usuarios = $query->orderBy('id', 'DESC')->paginate(10);
        $paginacion = $this->loginModel->pager;

        $data = [
            'usuarios' => $usuarios,
            'paginacion' => $paginacion,
            'search' => $search,
            'cabecera' => view('template/cabecera'),
            'pie' => view('template/piepagina')
        ];

        return view('usuarios/usuarios', $data);
    }



    // Método para cargar la vista de creación de usuario
    public function crear()
    {
        $data = [
            'cabecera' => view('template/cabecera'),
            'pie' => view('template/piepagina')
        ];

        return view('usuarios/crearUsuarios', $data);
    }

    // Método para guardar un nuevo usuario
    public function guardar()
    {
        if ($this->request->getMethod() === 'post') {
            // Captura y sanitiza los datos del formulario
            $nombres = strtolower(trim($this->request->getPost('nombres')));
            $apellidos = strtolower(trim($this->request->getPost('apellidos')));
            $email = strtolower(trim($this->request->getPost('email')));
            $celular = $this->request->getPost('celular');

            // Validación de los campos
            if (strlen($nombres) < 3 || strlen($apellidos) < 3) {
                session()->setFlashdata('error', 'Nombre y Apellido deben tener más de 3 caracteres.');
                return redirect()->back()->withInput();
            }

            if (!is_numeric($celular) || strlen($celular) != 8) {
                session()->setFlashdata('error', 'El número de celular debe tener 8 dígitos.');
                return redirect()->back()->withInput();
            }

            // Verificar si el email ya existe
            if ($this->loginModel->where('email', $email)->first()) {
                session()->setFlashdata('error', 'El correo electrónico ya está registrado.');
                return redirect()->back()->withInput();
            }

            // Genera una contraseña temporal
            $tempPassword = bin2hex(random_bytes(4));

            // Crea el nuevo usuario en la base de datos
            $data = [
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'email' => $email,
                'password' => password_hash($tempPassword, PASSWORD_DEFAULT),
                'estado' => 1,
                'celular' => $celular,
                'rol' => 2,  // Asigna automáticamente el rol de Cliente
                'is_temp_password' => true
            ];

            // Inserta el usuario en la base de datos
            if ($this->loginModel->insert($data)) {
                // Configura el contenido del correo
                $htmlMessage = "
            <!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <style>
                    body { font-family: Arial, sans-serif; color: #333; }
                    .email-container { max-width: 600px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 8px; }
                    .header { background: #2c3e50; padding: 15px; color: #ecf0f1; text-align: center; border-radius: 8px 8px 0 0; }
                    .header h1 { margin: 0; }
                    .content { padding: 20px; }
                    .temp-password { font-size: 20px; color: #e74c3c; padding: 10px; background: #fef3f3; text-align: center; border-radius: 5px; }
                    .footer { text-align: center; color: #95a5a6; font-size: 14px; margin-top: 20px; }
                </style>
            </head>
            <body>
                <div class='email-container'>
                    <div class='header'>
                        <h1>Sastrería Jimenez</h1>
                        <p>Elegancia y estilo en cada prenda</p>
                    </div>
                    <div class='content'>
                        <p>Hola <strong>$nombres</strong>,</p>
                        <p>¡Tu registro fue exitoso!</p>
                        <p>Nos complace darte la bienvenida a nuestra sastrería. Tu contraseña temporal para ingresar es la siguiente:</p>
                        <div class='temp-password'>$tempPassword</div>
                        <p>Por favor, inicia sesión y cambia tu contraseña lo antes posible para proteger tu cuenta.</p>
                        <p>Gracias por elegir Sastrería Jimenez para tus necesidades de vestimenta.</p>
                    </div>
                    <div class='footer'>
                        &copy; " . date('Y') . " Sastrería Jimenez. Todos los derechos reservados.
                    </div>
                </div>
            </body>
            </html>";

                // Configura el correo y envíalo
                $emailService = \Config\Services::email();
                $emailService->setFrom('tuemail@gmail.com', 'Sastreria Jimenez');
                $emailService->setTo($email);
                $emailService->setSubject('Registro exitoso: Contraseña Temporal');
                $emailService->setMessage($htmlMessage);

                if ($emailService->send()) {
                    session()->setFlashdata('success', 'Registro exitoso. Se envió una contraseña temporal a tu correo.');
                } else {
                    session()->setFlashdata('error', 'Usuario creado, pero hubo un problema al enviar el correo.');
                }

                return redirect()->to('/usuarios');
            } else {
                session()->setFlashdata('error', 'Error al registrar el usuario.');
                return redirect()->back()->withInput();
            }
        }

        return view('usuarios/crearUsuarios');
    }







    // Método para eliminar un usuario (cambia su estado a 0)
    public function borrar($id = null)
    {
        $usuario = $this->loginModel->find($id);
        if (!$usuario) {
            return redirect()->to('/usuarios');
        }

        $this->loginModel->update($id, ['estado' => 0]);

        return redirect()->to('/usuarios')->with('mensaje', 'Usuario eliminado exitosamente');
    }


    // Método para cargar la vista de edición de usuario
    public function editar($id = null)
    {
        $data = [
            'usuario' => $this->loginModel->find($id),
            'cabecera' => view('template/cabecera'),
            'pie' => view('template/piepagina')
        ];

        return view('usuarios/editarUsuarios', $data);
    }


    // Método para actualizar un usuario
    public function actualizar()
    {
        $id = $this->request->getVar('id');

        $validacion = $this->validate([
            'nombres' => 'required|min_length[3]',
            'apellidos' => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[usuario.email,id,{$id}]",
            'celular' => 'required|numeric|min_length[8]',
            'rol' => 'required|in_list[1,2,3]',
        ]);

        if (!$validacion) {
            return redirect()->back()->withInput()->with('mensaje', 'Revise la información ingresada');
        }

        $data = [
            'nombres' => strtolower($this->request->getVar('nombres')),
            'apellidos' => strtolower($this->request->getVar('apellidos')),
            'email' => strtolower(trim($this->request->getVar('email'))),
            'celular' => $this->request->getVar('celular'),
            'rol' => $this->request->getVar('rol'),
            'estado' => $this->request->getVar('estado')
        ];

        $this->loginModel->update($id, $data);

        return redirect()->to('/usuarios')->with('mensaje', 'Usuario actualizado exitosamente');
    }

}
