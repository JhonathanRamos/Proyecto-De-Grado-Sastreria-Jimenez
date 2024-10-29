<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TrajeController extends Controller
{
    public function index()
    {
        $data = [
            'cabecera' => view('template/cabecera'), // Incluye la cabecera
            'pie' => view('template/piepagina')      // Incluye el pie de página
        ];

        return view('traje/traje', $data); // Cargar la vista principal con cabecera y pie de página
    }
}
