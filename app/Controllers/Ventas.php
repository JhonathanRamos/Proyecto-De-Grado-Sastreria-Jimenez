<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Confeccion;
use App\Models\DetalleConfeccion;

class Ventas extends Controller {       
    public function index() {
        $ventaModel = new Venta();
        $clienteModel = new Cliente();
        $confeccionModel = new Confeccion(); // Cambiamos a Confeccion
        $detalleConfeccionModel = new DetalleConfeccion(); // Añadimos para acceder a los detalles de la confección

        // Obtiene todas las ventas
        $ventas = $ventaModel->findAll();

        // Añadir información adicional a cada venta
        foreach ($ventas as &$venta) {
            // Obtener la confección asociada a la venta
            $confeccion = $confeccionModel->find($venta['idConfeccion']); // Usamos 'idConfeccion'
            
            // Verificar si existe la confección y obtener el cliente asociado
            if ($confeccion) {
                $cliente = $clienteModel->find($confeccion['idCliente']);
                $venta['cliente'] = $cliente;
            } else {
                $venta['cliente'] = null;
            }

            // Obtener los detalles de la confección desde la tabla `detalleconfeccion`
            $detallesConfeccion = $detalleConfeccionModel->where('idConfeccion', $venta['idConfeccion'])->findAll();
            $totalAdelanto = 0;

            foreach ($detallesConfeccion as $detalle) {
                $totalAdelanto += $detalle['adelanto'];
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
