<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Venta;
use App\Models\Cliente;

class Ventas extends Controller {       
    public function index() {
        $ventaModel = new Venta();
        $ventas = $ventaModel->findAll(); // Obtiene todas las ventas

        $data['ventas'] = $ventas; // Pasa las ventas a la vista
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('venta/venta', $data); // Carga la vista de ventas
    }
}