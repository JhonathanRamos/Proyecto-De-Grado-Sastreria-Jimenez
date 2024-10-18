<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Confeccion;

class Ventas extends Controller
{
    // Método para listar las ventas
    public function index()
    {
        $ventaModel = new Venta();
        $clienteModel = new Cliente();
        $confeccionModel = new Confeccion();

        // Obtener todas las ventas
        $ventas = $ventaModel->findAll();

        // Añadir información adicional a cada venta
        foreach ($ventas as &$venta) {
            // Obtener el cliente asociado
            if (isset($venta['idCliente'])) {
                $cliente = $clienteModel->find($venta['idCliente']);
                $venta['cliente'] = $cliente ? $cliente : ['nombre' => 'Cliente No Encontrado', 'apellido' => ''];
            } else {
                $venta['cliente'] = ['nombre' => 'Cliente No Encontrado', 'apellido' => ''];
            }

            // Obtener los detalles de la confección
            if (isset($venta['idConfeccion'])) {
                $confeccion = $confeccionModel->find($venta['idConfeccion']);
                $venta['descripcion'] = $confeccion ? $confeccion['descripcion'] : 'No disponible';
                $venta['precio'] = $confeccion ? $confeccion['precio'] : 0;
            } else {
                $venta['descripcion'] = 'No disponible';
                $venta['precio'] = 0;
            }

            // Calcular el total a pagar (precio - adelanto)
            $venta['totalPagar'] = $venta['precio'] - $venta['adelanto'];
        }

        $data['ventas'] = $ventas;
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('venta/venta', $data); // Carga la vista de ventas
    }

    // Método para cargar el formulario de crear venta
    public function crear()
    {
        $clienteModel = new Cliente();
        $confeccionModel = new Confeccion();

        // Obtener todos los clientes y confecciones para el formulario
        $data['clientes'] = $clienteModel->findAll();
        $data['confecciones'] = $confeccionModel->findAll();

        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('venta/crearVenta', $data); // Cargar vista de crear venta
    }

    // Método para guardar la venta
    public function guardarVenta()
    {
        $ventaModel = new Venta();

        // Validar los campos del formulario
        $validacion = $this->validate([
            'idCliente' => 'required',
            'idConfeccion' => 'required',
            'adelanto' => 'required|numeric',
            'fechaRecoleccion' => 'required',
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

        // Obtener la confección para calcular el total
        $confeccionModel = new Confeccion();
        $confeccion = $confeccionModel->find($this->request->getVar('idConfeccion'));
        $precio = $confeccion ? $confeccion['precio'] : 0;
        $adelanto = $this->request->getVar('adelanto');  // Capturar el adelanto desde el formulario
        $total = $precio - $adelanto;  // Calcular el total

        // Insertar la venta
        $ventaData = [
            'idCliente' => $this->request->getVar('idCliente'),
            'idConfeccion' => $this->request->getVar('idConfeccion'),
            'adelanto' => $adelanto,  // Guardar el adelanto en la venta
            'total' => $total,  // Total calculado
            'estado' => $this->request->getVar('estado'),
            'fecha' => $this->request->getVar('fechaRecoleccion'),
            'idUsuario' => $idUsuario,
            'fechaRegistro' => date('Y-m-d H:i:s') // Fecha de registro de la venta
        ];

        $ventaModel->insert($ventaData);

        // Redirigir después de guardar
        session()->setFlashdata('mensaje', 'Venta registrada con éxito');
        return redirect()->to(site_url('/venta'));
    }
}
