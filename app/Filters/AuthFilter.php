<?php

//CREADO PARA FILTRAR Y MOSTRAR EL SISTEMA AL ADMINISTRADOR
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verifica si el usuario está autenticado
        if (!session()->has('user_id')) {
            // Redirige a la página de inicio de sesión
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita lógica aquí para este caso
    }
}

