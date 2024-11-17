<?php

namespace App\Models;

use CodeIgniter\Model;

class Login extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres', 'apellidos', 'email', 'password', 'celular', 'estado', 'rol', 'is_temp_password' , 'fechaRegistro'];


    public function registerClient($data)
    {

        return $this->insert($data);
    }
    public function verifyUser($email, $password)
    {
        $user = $this->where('email', $email)->first(); // Obtener el usuario por email

        if ($user) {
            log_message('info', 'Password almacenada: ' . $user['password']);

            // Verificar la contraseña con el hash
            if (password_verify($password, $user['password'])) {
                // Verificar si es una contraseña temporal
                if (!empty($user['is_temp_password']) && $user['is_temp_password']) {
                    session()->set('is_temp_password', true); // Marcar la sesión como temporal
                }
                return $user;
            }
        }

        return null; // Retornar null si no coincide
    }


}