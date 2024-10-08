<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Confeccion;

class Ventas extends Controller {       
    public function index() {
        $ventaModel = new Venta();
        $clienteModel = new Cliente();
        $confeccionModel = new Confeccion();

        // Obtiene todas las ventas
        $ventas = $ventaModel->findAll();

        // Añadir información adicional a cada venta
        foreach ($ventas as &$venta) {
            // Obtener el cliente asociado a la venta
            $cliente = $clienteModel->find($venta['idCliente']);
            $venta['cliente'] = $cliente;

            // Obtener el adelanto del cliente desde la tabla `confeccion`
            $confecciones = $confeccionModel->where('idCliente', $venta['idCliente'])->findAll();
            $totalAdelanto = 0;

            foreach ($confecciones as $confeccion) {
                $totalAdelanto += $confeccion['adelanto'];
            }

            // Añadir el adelanto al array de datos de la venta
            $venta['adelanto'] = $totalAdelanto;

            // Calcular el total después de restar el adelanto
            $venta['totalFinal'] = $venta['total'] - $totalAdelanto;
        }

        $data['ventas'] = $ventas; // Pasa las ventas con los datos adicionales a la vista
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('venta/venta', $data); // Carga la vista de ventas
    }
}
