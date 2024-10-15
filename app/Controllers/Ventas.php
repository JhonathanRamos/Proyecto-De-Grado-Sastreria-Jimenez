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

        // Obtener todas las ventas
        $ventas = $ventaModel->findAll();

        // Añadir información adicional a cada venta
        foreach ($ventas as &$venta) {
            // Obtener el cliente asociado directamente desde la tabla venta
            if (isset($venta['idCliente'])) {
                $cliente = $clienteModel->find($venta['idCliente']);
                
                // Verificar si se encontró el cliente
                if ($cliente) {
                    $venta['cliente'] = $cliente;
                } else {
                    $venta['cliente'] = ['nombre' => 'Cliente No Encontrado', 'apellido' => ''];
                }
            } else {
                $venta['cliente'] = ['nombre' => 'Cliente No Encontrado', 'apellido' => ''];
            }

            // Obtener los detalles de la confección (descripción y unidad de medida)
            if (isset($venta['idConfeccion'])) {
                $confeccion = $confeccionModel->find($venta['idConfeccion']);
                
                // Verificar si se encontró la confección
                if ($confeccion) {
                    $venta['descripcion'] = $confeccion['descripcion'];
                    $venta['unidadMedida'] = $confeccion['unidadMedida'];
                } else {
                    $venta['descripcion'] = 'No disponible';
                    $venta['unidadMedida'] = 'No disponible';
                }
            } else {
                $venta['descripcion'] = 'No disponible';
                $venta['unidadMedida'] = 'No disponible';
            }

            // Asignar directamente el total de la venta
            $venta['totalFinal'] = $venta['total'];
        }

        $data['ventas'] = $ventas; // Pasa las ventas con los datos adicionales a la vista
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('venta/venta', $data); // Carga la vista de ventas
    }

    public function crear() {
        $clienteModel = new Cliente();
        $confeccionModel = new Confeccion();

        // Obtener todos los clientes y confecciones para el formulario
        $data['clientes'] = $clienteModel->findAll();
        $data['confecciones'] = $confeccionModel->findAll();

        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('venta/crearVenta', $data); // Cargar vista de crear venta
    }

    public function guardarVenta() {
        $ventaModel = new Venta();
        $confeccionModel = new Confeccion();

        // Validar los campos del formulario
        $validacion = $this->validate([
            'idCliente' => 'required',
            'idConfeccion' => 'required',
            'adelanto' => 'required|numeric',
            'fechaRecoleccion' => 'required|valid_date',
            'estado' => 'required'
        ]);

        if (!$validacion) {
            session()->setFlashdata('mensaje', 'Por favor revise los campos del formulario');
            return redirect()->back()->withInput();
        }

        // Obtener los datos del formulario
        $idConfeccion = $this->request->getVar('idConfeccion');
        $adelanto = $this->request->getVar('adelanto');
        $estado = $this->request->getVar('estado');

        // Obtener los detalles de la confección para el total
        $confeccion = $confeccionModel->find($idConfeccion);
        $total = $confeccion['precio'];

        // Registrar la venta
        $ventaData = [
            'idCliente' => $this->request->getVar('idCliente'),
            'idConfeccion' => $idConfeccion,
            'total' => $total,  // Total de la confección
            'adelanto' => $adelanto,
            'estado' => $estado, // 1 = Incompleta, 0 = Completada
            'fecha' => date('Y-m-d H:i:s'),
            'fechaRegistro' => date('Y-m-d H:i:s'),
            'fechaActualizacion' => null,  // La puedes actualizar cuando se pague completo
            'idUsuario' => session()->get('user_id')
        ];

        $ventaModel->insert($ventaData);

        // Redirigir al listado de ventas
        session()->setFlashdata('mensaje', 'Venta registrada con éxito');
        return redirect()->to(site_url('/ventas'));
    }
}
