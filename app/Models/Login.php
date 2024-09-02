<?php

namespace App\Models;

use CodeIgniter\Model;

class Login extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres', 'apellidos', 'email', 'password', 'celular', 'estado', 'rol'];

    public function registerClient($data)
    {
        
        return $this->insert($data);
    }
    public function verifyUser($email, $password)
    {
        $user = $this->where('email', $email)->first(); // Obtener el primer usuario que coincida con el email
        if ($user) {
            log_message('info', 'Password almacenada: ' . $user['password']); // Para verificar el hash almacenado
            
            // Verificar la contraseña con el hash de PHP
            if (password_verify($password, $user['password'])) {
                return $user; // Retornar el usuario si las credenciales son válidas
            }
    
            // Verificar la contraseña con el hash SHA-256 de MySQL
            $hashedPassword = hash('sha256', $password);
            if ($hashedPassword === $user['password']) {
                return $user; // Retornar el usuario si las credenciales son válidas
            }
        }
        return null; // Retornar null si no coincide
    }
    
    
    
}
