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
    
        // Validar los campos del formulario
        $validacion = $this->validate([
            'idCliente' => 'required',
            'idConfeccion' => 'required',
            'adelanto' => 'required|numeric',
            'fechaRecoleccion' => 'required', // Asegúrate de validar el campo de fecha
            'estado' => 'required'
        ]);
    
        if (!$validacion) {
            session()->setFlashdata('mensaje', 'Revise la información proporcionada');
            return redirect()->back()->withInput();
        }
    
        // Obtener el id del usuario logueado
        $idUsuario = session()->get('user_id');
        if (!$idUsuario) {
            session()->setFlashdata('mensaje', 'Usuario no identificado');
            return redirect()->back()->withInput();
        }
    
        // Calcular el total que falta por pagar
        $confeccionModel = new Confeccion();
        $confeccion = $confeccionModel->find($this->request->getVar('idConfeccion'));
        $adelanto = $this->request->getVar('adelanto');
        $total = $confeccion['precio'] - $adelanto;
    
        // Insertar la venta con la fecha especificada en el formulario
        $ventaData = [
            'idCliente' => $this->request->getVar('idCliente'),
            'idConfeccion' => $this->request->getVar('idConfeccion'),
            'adelanto' => $adelanto,
            'total' => $total,
            'estado' => $this->request->getVar('estado'),
            'fecha' => $this->request->getVar('fechaRecoleccion'), // Aquí tomamos la fecha del formulario
            'idUsuario' => $idUsuario,
            'fechaRegistro' => date('Y-m-d H:i:s') // Fecha de registro de la venta
        ];
    
        $ventaModel->insert($ventaData);
    
        // Redirigir después de guardar
        session()->setFlashdata('mensaje', 'Venta registrada con éxito');
        return redirect()->to(site_url('/venta'));
    }
    
}
