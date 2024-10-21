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
        $ventas = $ventaModel->where('estado', 0)->findAll();

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

        // Detectar si se ha pasado un cliente y una confección en la URL
        $idCliente = $this->request->getGet('cliente');
        $confeccionSeleccionada = $this->request->getGet('confeccion');

        // Si se ha pasado un cliente, buscar ese cliente y preseleccionarlo
        if ($idCliente) {
            $data['clienteSeleccionado'] = $clienteModel->find($idCliente);
        } else {
            $data['clienteSeleccionado'] = null;  // Ningún cliente preseleccionado
        }

        // Si se ha pasado una confección, buscar esa confección y preseleccionarla
        if ($confeccionSeleccionada) {
            $data['confeccionSeleccionada'] = $confeccionSeleccionada;
        } else {
            $data['confeccionSeleccionada'] = null;  // Ninguna confección preseleccionada
        }

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
            'estado' => 'required',
            'metodo_pago' => 'required', // Validar el método de pago
            'pagado' => 'required|in_list[1,0]' // Validar si el pago fue realizado
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
            'adelanto' => $adelanto,
            'total' => $total,
            'estado' => $this->request->getVar('estado'),
            'fecha' => $this->request->getVar('fechaRecoleccion'),
            'idUsuario' => $idUsuario,
            'fechaRegistro' => date('Y-m-d H:i:s'),
            'metodo_pago' => $this->request->getVar('metodo_pago'), // Guardar método de pago
            'pagado' => $this->request->getVar('pagado') // Guardar si el pago fue realizado
        ];

        $ventaModel->insert($ventaData);

        // Redirigir después de guardar
        session()->setFlashdata('mensaje', 'Venta registrada con éxito');
        return redirect()->to(site_url('/venta'));
    }



    // Método para editar una venta
    public function editar($id)
    {
        $ventaModel = new Venta();
        $clienteModel = new Cliente();
        $confeccionModel = new Confeccion();

        // Obtener la venta a editar
        $venta = $ventaModel->find($id);
        if (!$venta) {
            session()->setFlashdata('mensaje', 'Venta no encontrada');
            return redirect()->to('/venta');
        }

        // Obtener todos los clientes y confecciones para el formulario
        $data['clientes'] = $clienteModel->findAll();
        $data['confecciones'] = $confeccionModel->findAll();
        $data['venta'] = $venta;
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('venta/editarVenta', $data); // Cargar vista de edición
    }

    // Método para actualizar una venta
    public function actualizarVenta($id)
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

        // Obtener la confección para calcular el total
        $confeccionModel = new Confeccion();
        $confeccion = $confeccionModel->find($this->request->getVar('idConfeccion'));
        $precio = $confeccion ? $confeccion['precio'] : 0;
        $adelanto = $this->request->getVar('adelanto');
        $total = $precio - $adelanto;

        // Actualizar la venta
        $ventaData = [
            'idCliente' => $this->request->getVar('idCliente'),
            'idConfeccion' => $this->request->getVar('idConfeccion'),
            'adelanto' => $adelanto,
            'total' => $total,
            'estado' => $this->request->getVar('estado'),
            'fecha' => $this->request->getVar('fechaRecoleccion')
        ];

        $ventaModel->update($id, $ventaData);

        // Redirigir después de actualizar
        session()->setFlashdata('mensaje', 'Venta actualizada con éxito');
        return redirect()->to(site_url('/venta'));
    }

    // Método para borrar una venta
    public function borrar($id)
    {
        $ventaModel = new Venta();  // Aquí estás manejando el modelo de Venta, no el de Usuario

        // Buscar la venta según el id
        $venta = $ventaModel->find($id);

        if ($venta) {
            // Actualizar el estado de la venta a 0 en lugar de eliminarla
            $ventaModel->update($id, ['estado' => 0]);
            session()->setFlashdata('mensaje', 'Venta marcada como eliminada con éxito.');
        } else {
            session()->setFlashdata('mensaje', 'Venta no encontrada.');
        }

        return redirect()->to(site_url('/venta'));
    }

    public function confirmarPago()
    {
        // Simula obtener el ID de una venta (por ahora lo dejaremos estático para pruebas)
        $idVenta = 1;  // O puedes obtenerlo dinámicamente si ya lo tienes

        // Pasar los datos necesarios a la vista
        $data['idVenta'] = $idVenta;
        $data['cabecera'] = view('template/cabecera'); // Incluye la cabecera
        $data['pie'] = view('template/piepagina');     // Incluye el pie de página

        // Cargar la vista de confirmación de pago
        return view('venta/confirmarPago', $data);
    }




}
