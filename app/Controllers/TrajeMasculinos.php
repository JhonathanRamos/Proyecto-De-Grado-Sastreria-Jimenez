<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TrajeMasculino; // Make sure to import the appropriate model
use App\Models\Cliente;

class TrajeMasculinos extends Controller
{

    public function trajeMasculino()
    {

        $clienteModel = new Cliente();
        $clientes = $clienteModel->select('id AS idCliente, CONCAT(nombre, " ", apellido) AS nombre_completo ')
            ->where('estado', 1)
            ->where('sexo', 'M')
            ->findAll();

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
        $datos['clientes'] = $clientes; // Pasar la lista de clientes a la vista

        // Obtén los datos de las faldas y la relación 'cliente'
        $trajeMasculinoModel = new TrajeMasculino();
        $trajeMasculino = $trajeMasculinoModel->select('traje_masculino.idCliente')
            ->join('cliente', 'cliente.id = traje_masculino.idCliente')
            ->findAll();

        $datos['trajeMasculinos'] = $trajeMasculino; // Pasar la lista de faldas a la vista

        return view('bddclientes/trajeMasculino', $datos);

    }

    public function index()
    {
        $trajeMasculinoModel = new TrajeMasculino();

        // Obtén los datos de las faldas y la relación 'cliente'
        $trajeMasculino = $trajeMasculinoModel->select('traje_masculino.idCliente, CONCAT( cliente.nombre ," ", cliente.apellido ) AS nombre_completo , traje_masculino.talle, traje_masculino.largo, 
        traje_masculino.hombro , traje_masculino.ancho , traje_masculino.pecho , traje_masculino.estomago , traje_masculino.largoManga')
            ->join('cliente', 'cliente.id = traje_masculino.idCliente')
            ->orderBy('idCliente', 'ASC')
            ->where('estado', 1)
            ->findAll();

        $datos['trajeMasculinos'] = $trajeMasculino;

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('datos/datosTrajeMasculino', $datos);
    }

    public function guardartrajeMasculino()
    {
        $trajeMasculino = new TrajeMasculino();
        $clienteModel = new Cliente();

        // Obtén la lista de clientes activos
        $clientes = $clienteModel->where('estado', 1)->findAll();

        // Configurar la validación para cada campo requerido
        $validationRules = [
            'idCliente' => 'required|is_natural_no_zero',
            'talle' => 'required|numeric|min_length[2]|max_length[3]',
            'largo' => 'required|numeric|min_length[2]|max_length[3]',
            'hombro' => 'required|numeric|min_length[2]|max_length[3]',
            'ancho' => 'required|numeric|min_length[2]|max_length[3]',
            'pecho' => 'required|numeric|min_length[2]|max_length[3]',
            'estomago' => 'required|numeric|min_length[2]|max_length[3]',
            'largoManga' => 'required|numeric|min_length[2]|max_length[3]',
        ];

        // Validar los datos ingresados
        if (!$this->validate($validationRules)) {
            // Si la validación falla, devolver un mensaje de error en JSON
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Revise la información ingresada.',
                'errors' => $this->validator->getErrors() // Devuelve los errores específicos de cada campo
            ]);
        }

        // Si la validación es exitosa, procede a guardar los datos
        $datos = [
            'idCliente' => $this->request->getVar('idCliente'),
            'talle' => $this->request->getVar('talle'),
            'largo' => $this->request->getVar('largo'),
            'hombro' => $this->request->getVar('hombro'),
            'ancho' => $this->request->getVar('ancho'),
            'pecho' => $this->request->getVar('pecho'),
            'estomago' => $this->request->getVar('estomago'),
            'largoManga' => $this->request->getVar('largoManga')
        ];

        // Insertar los datos en la base de datos
        $trajeMasculino->insert($datos);

        // Redirigir o devolver un JSON de éxito
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Medidas guardadas exitosamente.',
            'redirectUrl' => site_url('/datosTrajeMasculino')
        ]);
    }


    //SE PRUEBA DESDE AQUI EL EDITAR Y BORRAR AGREGASTE ESTADO EN MYSQL --> EL PROBLEMA ES CON EL ID A LO QUE VEO AGREGA EL GIT PTM XD WEY

    public function borrartrajeMasculino($idCliente = null)
    {
        $trajeMasculinoModel = new TrajeMasculino();


        $trajeMasculino = $trajeMasculinoModel->where('idCliente', $idCliente)->first();

        if ($trajeMasculino) {

            $trajeMasculinoModel->delete($trajeMasculino['idCliente']);
        }

        return redirect()->to(site_url('/datosTrajeMasculino'));
    }





    public function editartrajeMasculino($idCliente = null)
    {
        $trajeMasculinoModel = new TrajeMasculino();
        $clienteModel = new Cliente();//Mostrar el nombre del cliente a la hora de editar

        // Busca la falda asociada al idCliente
        $trajeMasculino = $trajeMasculinoModel->where('idCliente', $idCliente)->first();
        $cliente = $clienteModel->where('id', $idCliente)->first();//Mostrar el nombre del cliente a la hora de editar

        if (!$trajeMasculino) {
            // Manejar la situación si no se encuentra la falda asociada al cliente
            return redirect()->to(site_url('/datosTrajeMasculino'));
        }

        $datos['trajeMasculinos'] = $trajeMasculino;
        $datos['cliente'] = $cliente; //Mostrar el nombre del cliente a la hora de editar
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
        return view('datos/editarTrajeMasculino', $datos);

    }




    public function actualizartrajeMasculino()
    {
        $trajeMasculino = new TrajeMasculino();

        $datos = [
            'talle' => $this->request->getVar('talle'),
            'largo' => $this->request->getVar('largo'),
            'hombro' => $this->request->getVar('hombro'),
            'ancho' => $this->request->getVar('ancho'),
            'pecho' => $this->request->getVar('pecho'),
            'estomago' => $this->request->getVar('estomago'),
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
            'estomago' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo estómago es obligatorio.',
                    'numeric' => 'El estómago debe ser un número.',
                    'min_length' => 'El estómago debe tener al menos 2 dígito.'
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

        // Actualizar los datos del traje masculino
        $trajeMasculino->update($id, $datos);

        // Respuesta de éxito
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Traje masculino actualizado exitosamente.',
            'redirectUrl' => site_url('/datosTrajeMasculino')
        ]);
    }
}
