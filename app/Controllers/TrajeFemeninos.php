<?php
namespace App\Controllers;

use App\Models\TrajeFemenino;
use App\Models\Cliente;
use CodeIgniter\Controller;

class TrajeFemeninos extends Controller
{



    public function trajeFemenino()
    {

        $clienteModel = new Cliente();
        $clientes = $clienteModel->select('id AS idCliente, CONCAT(nombre, " ", apellido) AS nombre_completo')
            ->where('estado', 1)
            ->where('sexo', 'F')
            ->findAll();

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
        $datos['clientes'] = $clientes; // Pasar la lista de clientes a la vista

        // Obtén los datos de las faldas y la relación 'cliente'
        $trajeFemeninoModel = new TrajeFemenino();
        $trajeFemenino = $trajeFemeninoModel->select('traje_femenino.idCliente')
            ->join('cliente', 'cliente.id = traje_femenino.idCliente')
            ->findAll();

        $datos['trajeFemeninos'] = $trajeFemenino; // Pasar la lista de faldas a la vista

        return view('bddclientes/trajeFemenino', $datos);

    }

    public function index()
    {
        $trajeFemeninoModel = new TrajeFemenino();

        // Obtén los datos de las faldas y la relación 'cliente'
        $trajeFemenino = $trajeFemeninoModel->select('traje_femenino.idCliente, CONCAT( cliente.nombre ," ", cliente.apellido ) AS nombre_completo , traje_femenino.talle, traje_femenino.largo, 
        traje_femenino.hombro , traje_femenino.ancho , traje_femenino.pecho , traje_femenino.cintura , traje_femenino.cadera ,traje_femenino.largoManga')
            ->join('cliente', 'cliente.id = traje_femenino.idCliente')
            ->orderBy('idCliente', 'ASC')
            ->where('estado', 1)
            ->findAll();

        $datos['trajeFemeninos'] = $trajeFemenino;

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('datos/datosTrajeFemenino', $datos);
    }


    public function guardarTrajeFemenino()
    {
        $trajeFemeninoModel = new TrajeFemenino();

        // Reglas de validación
        $validacion = $this->validate([
            'idCliente' => 'required|integer',
            'talle' => 'required|numeric|min_length[2]|max_length[3]',
            'largo' => 'required|numeric|min_length[2]|max_length[3]',
            'hombro' => 'required|numeric|min_length[2]|max_length[3]',
            'ancho' => 'required|numeric|min_length[2]|max_length[3]',
            'pecho' => 'required|numeric|min_length[2]|max_length[3]',
            'cintura' => 'required|numeric|min_length[2]|max_length[3]',
            'cadera' => 'required|numeric|min_length[2]|max_length[3]',
            'largoManga' => 'required|numeric|min_length[2]|max_length[3]'
        ]);

        if (!$validacion) {
            // Retorna los errores de validación en JSON
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Si la validación es exitosa, guarda los datos
        $datos = [
            'idCliente' => $this->request->getVar('idCliente'),
            'talle' => $this->request->getVar('talle'),
            'largo' => $this->request->getVar('largo'),
            'hombro' => $this->request->getVar('hombro'),
            'ancho' => $this->request->getVar('ancho'),
            'pecho' => $this->request->getVar('pecho'),
            'cintura' => $this->request->getVar('cintura'),
            'cadera' => $this->request->getVar('cadera'),
            'largoManga' => $this->request->getVar('largoManga')
        ];

        $trajeFemeninoModel->insert($datos);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Datos del traje femenino guardados exitosamente',
            'redirectUrl' => site_url('datosTrajeFemenino')
        ]);
    }



    public function borrartrajeFemenino($idCliente = null)
    {
        $trajeFemeninoModel = new TrajeFemenino();


        $trajeFemenino = $trajeFemeninoModel->where('idCliente', $idCliente)->first();

        if ($trajeFemenino) {

            $trajeFemeninoModel->delete($trajeFemenino['idCliente']);
        }

        return redirect()->to(site_url('/datosTrajeFemenino'));
    }





    public function editartrajeFemenino($idCliente = null)
    {
        $trajeFemeninoModel = new TrajeFemenino();
        $clienteModel = new Cliente();//Mostrar el nombre del cliente a la hora de editar

        // Busca la falda asociada al idCliente
        $trajeFemenino = $trajeFemeninoModel->where('idCliente', $idCliente)->first();
        $cliente = $clienteModel->where('id', $idCliente)->first();//Mostrar el nombre del cliente a la hora de editar

        if (!$trajeFemenino) {
            // Manejar la situación si no se encuentra la falda asociada al cliente
            return redirect()->to(site_url('/datosTrajeFemenino'));
        }

        $datos['trajeFemeninos'] = $trajeFemenino;
        $datos['cliente'] = $cliente; //Mostrar el nombre del cliente a la hora de editar
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
        return view('datos/editarTrajeFemenino', $datos);





    }

    public function actualizartrajeFemenino()
    {
        $trajeFemenino = new TrajeFemenino();

        $datos = [
            'talle' => $this->request->getVar('talle'),
            'largo' => $this->request->getVar('largo'),
            'hombro' => $this->request->getVar('hombro'),
            'ancho' => $this->request->getVar('ancho'),
            'pecho' => $this->request->getVar('pecho'),
            'cintura' => $this->request->getVar('cintura'),
            'cadera' => $this->request->getVar('cadera'),
            'largoManga' => $this->request->getVar('largoManga')
        ];

        $id = $this->request->getVar('idCliente');

        // Validación de los datos de entrada con mensajes personalizados
        $validacion = $this->validate([
            'talle' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo talle es obligatorio.',
                    'numeric' => 'El talle debe ser un número.',
                    'min_length' => 'El talle debe tener al menos 2 dígito.'
                ]
            ],
            'largo' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo largo es obligatorio.',
                    'numeric' => 'El largo debe ser un número.',
                    'min_length' => 'El largo debe tener al menos 2 dígito.'
                ]
            ],
            'hombro' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo hombro es obligatorio.',
                    'numeric' => 'El hombro debe ser un número.',
                    'min_length' => 'El hombro debe tener al menos 2 dígito.'
                ]
            ],
            'ancho' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo ancho es obligatorio.',
                    'numeric' => 'El ancho debe ser un número.',
                    'min_length' => 'El ancho debe tener al menos 2 dígito.'
                ]
            ],
            'pecho' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo pecho es obligatorio.',
                    'numeric' => 'El pecho debe ser un número.',
                    'min_length' => 'El pecho debe tener al menos 2 dígito.'
                ]
            ],
            'cintura' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo cintura es obligatorio.',
                    'numeric' => 'La cintura debe ser un número.',
                    'min_length' => 'La cintura debe tener al menos 2 dígito.'
                ]
            ],
            'cadera' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo cadera es obligatorio.',
                    'numeric' => 'La cadera debe ser un número.',
                    'min_length' => 'La cadera debe tener al menos 2 dígito.'
                ]
            ],
            'largoManga' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo largo de manga es obligatorio.',
                    'numeric' => 'El largo de manga debe ser un número.',
                    'min_length' => 'El largo de manga debe tener al menos 2 dígito.'
                ]
            ]
        ]);

        if (!$validacion) {
            // Retornar JSON con los errores específicos para ser manejados en el JS
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Actualizar los datos del traje femenino
        $trajeFemenino->update($id, $datos);

        // Respuesta de éxito
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Traje femenino actualizado exitosamente.',
            'redirectUrl' => site_url('/datosTrajeFemenino')
        ]);
    }


}
