<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Confeccion;
use App\Models\DetalleConfeccion;
use App\Models\Cliente;

class Confeccions extends Controller
{
    public function index()
    {
        $confeccionModel = new Confeccion();
        $detalleConfeccionModel = new DetalleConfeccion();  // Instancia del modelo de DetalleConfeccion
        $clienteModel = new Cliente();

        // Obtener todas las confecciones
        $confecciones = $confeccionModel->findAll();

        // Recorrer las confecciones y añadir los detalles correspondientes
        foreach ($confecciones as &$confeccion) {
            // Obtener el detalle de confección correspondiente
            $detalle = $detalleConfeccionModel->where('idConfeccion', $confeccion['id'])->first();
            
            // Verificar si se encontró el detalle
            if ($detalle) {
                // Añadir los detalles a la confección
                $confeccion['descripcion'] = $detalle['descripcion'];
                $confeccion['precio'] = $detalle['precio'];
                $confeccion['unidadMedida'] = $detalle['unidadMedida'];
                $confeccion['adelanto'] = $detalle['adelanto'];
            } else {
                // Si no hay detalle, rellenar con valores por defecto
                $confeccion['descripcion'] = 'No disponible';
                $confeccion['precio'] = 0;
                $confeccion['unidadMedida'] = 'No disponible';
                $confeccion['adelanto'] = 0;
            }

            // Obtener el cliente relacionado con la confección
            $cliente = $clienteModel->find($confeccion['idCliente']);
            $confeccion['cliente'] = $cliente;
        }

        // Preparar los datos para la vista
        $data['confecciones'] = $confecciones;
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        // Cargar la vista de confecciones con los detalles
        return view('Confeccion/confeccion', $data);
    }

    public function crear()
    {
        $clienteModel = new Cliente();
        $data['clientes'] = $clienteModel->findAll(); // Obtener los clientes para mostrarlos en un select

        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('Confeccion/crearConfeccion', $data);
    }

    // Guardar nueva confección y luego agregar los detalles de la confección
    public function guardar()
    {
        $confeccionModel = new Confeccion();
        $detalleConfeccionModel = new DetalleConfeccion();

        // Validar la confección y el detalle
        $validacion = $this->validate([
            'descripcion' => 'required|min_length[3]',
            'precio' => 'required|numeric',
            'unidadMedida' => 'required|min_length[1]',
            'idCliente' => 'required'  // Debes elegir un cliente
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

        // Primero guardar la confección
        $confeccionData = [
            'idCliente' => $this->request->getVar('idCliente')
        ];
        $confeccionModel->insert($confeccionData);
        $idConfeccion = $confeccionModel->insertID();  // Obtener el ID de la confección recién creada

        // Luego, guardar el detalle de la confección
        $detalleData = [
            'descripcion' => $this->request->getVar('descripcion'),
            'precio' => $this->request->getVar('precio'),
            'unidadMedida' => $this->request->getVar('unidadMedida'),
            'adelanto' => $this->request->getVar('adelanto'),  // Opcional
            'idUsuario' => $idUsuario,
            'idConfeccion' => $idConfeccion
        ];

        $detalleConfeccionModel->insert($detalleData);

        // Redirigir después de guardar
        session()->setFlashdata('mensaje', 'Confección y detalles guardados con éxito');
        return redirect()->to(site_url('/confeccion'));
    }
}
