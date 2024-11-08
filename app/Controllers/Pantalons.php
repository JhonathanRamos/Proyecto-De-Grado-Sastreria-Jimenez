<?php
namespace App\Controllers;

use App\Models\Pantalon;
use App\Models\Cliente;
use CodeIgniter\Controller;

class Pantalons extends Controller
{



    public function pantalon()
    {

        $clienteModel = new Cliente();
        $clientes = $clienteModel->select('id AS idCliente, CONCAT(nombre, " ", apellido) AS nombre_completo')
            ->where('estado', 1)
            ->where('sexo', 'M')
            ->findAll();

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
        $datos['clientes'] = $clientes; // Pasar la lista de clientes a la vista

        // Obtén los datos de las faldas y la relación 'cliente'
        $pantalonModel = new Pantalon();
        $pantalon = $pantalonModel->select('pantalon.idCliente')
            ->join('cliente', 'cliente.id = pantalon.idCliente')
            ->findAll();

        $datos['pantalones'] = $pantalon; // Pasar la lista de faldas a la vista

        return view('bddclientes/pantalon', $datos);

    }


    public function index()
    {
        $pantalonModel = new Pantalon();

        // Obtén los datos de las faldas y la relación 'cliente'
        $pantalon = $pantalonModel->select('pantalon.idCliente, CONCAT( cliente.nombre ," ", cliente.apellido ) AS nombre_completo , pantalon.largo, pantalon.entrepierna, 
        pantalon.cintura , pantalon.cadera , pantalon.pierna , pantalon.rodilla , pantalon.bota')
            ->join('cliente', 'cliente.id = pantalon.idCliente')
            ->orderBy('idCliente', 'ASC')
            ->where('estado', 1)
            ->findAll();

        $datos['pantalones'] = $pantalon;

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('datos/datosPantalon', $datos);
    }

    public function guardarPantalon()
    {
        $pantalonModel = new Pantalon();
        $clienteModel = new Cliente();

        // Reglas de validación
        $validacion = $this->validate([
            'idCliente' => 'required|integer',
            'largo' => 'required|numeric|min_length[2]|max_length[3]',
            'entrepierna' => 'required|numeric|min_length[2]|max_length[3]',
            'cintura' => 'required|numeric|min_length[2]|max_length[3]',
            'cadera' => 'required|numeric|min_length[2]|max_length[3]',
            'pierna' => 'required|numeric|min_length[2]|max_length[3]',
            'rodilla' => 'required|numeric|min_length[2]|max_length[3]',
            'bota' => 'required|numeric|min_length[2]|max_length[3]'
        ]);

        // Si la validación falla, devolver errores en JSON
        if (!$validacion) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Si la validación es exitosa, guarda los datos
        $datos = [
            'idCliente' => $this->request->getVar('idCliente'),
            'largo' => $this->request->getVar('largo'),
            'entrepierna' => $this->request->getVar('entrepierna'),
            'cintura' => $this->request->getVar('cintura'),
            'cadera' => $this->request->getVar('cadera'),
            'pierna' => $this->request->getVar('pierna'),
            'rodilla' => $this->request->getVar('rodilla'),
            'bota' => $this->request->getVar('bota')
        ];

        $pantalonModel->insert($datos);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Datos del pantalón guardados exitosamente',
            'redirectUrl' => site_url('datosPantalon')
        ]);
    }


    //SE PRUEBA DESDE AQUI EL EDITAR Y BORRAR AGREGASTE ESTADO EN MYSQL --> EL PROBLEMA ES CON EL ID A LO QUE VEO AGREGA EL GIT PTM XD WEY

    public function borrarPantalon($idCliente = null)
    {
        $pantalonModel = new Pantalon();

        // Busca la falda asociada al idCliente
        $pantalon = $pantalonModel->where('idCliente', $idCliente)->first();

        if ($pantalon) {
            // Elimina la falda de la base de datos
            $pantalonModel->delete($pantalon['idCliente']);
        }

        return redirect()->to(site_url('/datosPantalon'));
    }




    public function editarPantalon($idCliente = null)
    {
        $pantalonModel = new Pantalon();
        $clienteModel = new Cliente();//Mostrar el nombre del cliente a la hora de editar

        // Busca la falda asociada al idCliente
        $pantalon = $pantalonModel->where('idCliente', $idCliente)->first();
        $cliente = $clienteModel->where('id', $idCliente)->first();//Mostrar el nombre del cliente a la hora de editar

        if (!$pantalon) {
            // Manejar la situación si no se encuentra la falda asociada al cliente
            return redirect()->to(site_url('/datosPantalon'));
        }

        $datos['pantalon'] = $pantalon;
        $datos['cliente'] = $cliente; //Mostrar el nombre del cliente a la hora de editar
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
        return view('datos/editarPantalon', $datos);




    }


    public function actualizarPantalon()
    {
        $pantalon = new Pantalon();

        $datos = [
            'largo' => $this->request->getVar('largo'),
            'entrepierna' => $this->request->getVar('entrepierna'),
            'cintura' => $this->request->getVar('cintura'),
            'cadera' => $this->request->getVar('cadera'),
            'pierna' => $this->request->getVar('pierna'),
            'rodilla' => $this->request->getVar('rodilla'),
            'bota' => $this->request->getVar('bota')
        ];

        $id = $this->request->getVar('idCliente');

        // Validación de los datos de entrada con mensajes personalizados
        $validacion = $this->validate([
            'largo' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo largo es obligatorio.',
                    'numeric' => 'El largo debe ser un número.',
                    'min_length' => 'El largo debe tener al menos 2 dígito.'
                ]
            ],
            'entrepierna' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo entrepierna es obligatorio.',
                    'numeric' => 'La entrepierna debe ser un número.',
                    'min_length' => 'La entrepierna debe tener al menos 2 dígito.'
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
            'pierna' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo pierna es obligatorio.',
                    'numeric' => 'La pierna debe ser un número.',
                    'min_length' => 'La pierna debe tener al menos 2 dígito.'
                ]
            ],
            'rodilla' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo rodilla es obligatorio.',
                    'numeric' => 'La rodilla debe ser un número.',
                    'min_length' => 'La rodilla debe tener al menos 2 dígito.'
                ]
            ],
            'bota' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo bota es obligatorio.',
                    'numeric' => 'La bota debe ser un número.',
                    'min_length' => 'La bota debe tener al menos 2 dígito.'
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

        // Actualizar los datos del pantalón
        $pantalon->update($id, $datos);

        // Respuesta de éxito
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Pantalón actualizado exitosamente.',
            'redirectUrl' => site_url('/datosPantalon')
        ]);
    }

}
