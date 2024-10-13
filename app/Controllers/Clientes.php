<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Cliente;

class Clientes extends Controller
{
    public function index()
    {
        $cliente = new Cliente();

        // Seleccionar solo clientes activos, paginados de 10 en 10
        $datos['clientes'] = $cliente->where('estado', 1)
                                    ->orderBy('id', 'ASC')
                                    ->paginate(10); // Mostrar 10 clientes por página

        // Generar los enlaces de paginación
        $datos['paginacion'] = $cliente->pager;

        // Añadir las vistas de cabecera y pie de página
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('bddclientes/cliente', $datos);
    }

    // Se está creando la vista de CREAR
    public function crear()
    {
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('bddclientes/crear', $datos);
    }

    public function guardar()
    {
        $cliente = new Cliente();

        $validacion = $this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]',
            'celular' => 'required|numeric|min_length[8]',
        ]);

        if (!$validacion) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Revise la información',
            ]);
        }

        $datos = [
            'nombre' => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
            'sexo' => $this->request->getVar('sexo'),
            'celular' => $this->request->getVar('celular'),
            'fechaRegistro' => date('Y-m-d H:i:s'),
            'estado' => 1,
        ];

        $cliente->insert($datos);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Cliente creado exitosamente',
            'redirectUrl' => site_url('/cliente')
        ]);
    }

    public function borrar($id = null)
    {
        $clienteModel = new Cliente();

        // Verificamos si el cliente existe
        $cliente = $clienteModel->find($id);
        if (!$cliente) {
            // El cliente no existe, puedes manejar esta situación según tus necesidades
            return redirect()->to(site_url('/cliente'));
        }

        // Actualizamos el estado del cliente a 0 (inactivo) en lugar de eliminarlo físicamente
        $clienteModel->update($id, ['estado' => 0]);

        return redirect()->to(site_url('/cliente'));
    }

    public function editar($id = null)
    {
        $clienteModel = new Cliente();

        // Obtener datos del cliente
        $datos['cliente'] = $clienteModel->where('id', $id)->first();

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('bddclientes/editar', $datos);
    }

    public function actualizar()
    {
        $clienteModel = new Cliente();

        date_default_timezone_set('America/La_Paz');

        // Actualizar datos del cliente
        $datosCliente = [
            'nombre' => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
            'sexo' => $this->request->getVar('sexo'),
            'celular' => $this->request->getVar('celular'),
            'fechaActualizacion' => date('Y-m-d H:i:s'),
            'estado' => 1, // Estado activo
        ];

        $id = $this->request->getVar('id');

        // Validar los datos
        $validacion = $this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]',
            'celular' => 'required|numeric|min_length[8]', // Validación para números
        ]);

        if (!$validacion) {
            $session = session();
            $session->setFlashdata('mensaje', 'Revise la información');
            return redirect()->back()->withInput();
        }

        // Actualizar los datos del cliente
        $clienteModel->update($id, $datosCliente);

        return redirect()->to(site_url('/cliente'));
    }
}
