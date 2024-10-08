<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Confeccion;
use App\Models\Cliente;

class Confeccions extends Controller
{
    public function index()
    {
        $confeccionModel = new Confeccion();
        $clienteModel = new Cliente();

        // Obtener todas las confecciones
        $confecciones = $confeccionModel->findAll();

        // Añadir información del cliente a cada confección
        foreach ($confecciones as &$confeccion) {
            $cliente = $clienteModel->find($confeccion['idCliente']);
            $confeccion['cliente'] = $cliente;
        }

        $data['confecciones'] = $confecciones; // Pasa las confecciones con datos adicionales a la vista
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('Confeccion/confeccion', $data); // Usa "Confeccion" con "C" mayúscula

    }

    // Método para editar confección (muestra el formulario de edición)
    public function editar($id = null)
    {
        // Lógica para mostrar el formulario de edición de una confección específica
    }

    // Método para borrar confección
    public function borrar($id = null)
    {
        // Lógica para eliminar una confección específica
    }
}
