<?php
namespace App\Controllers;

use App\Models\Falda;
use App\Models\Cliente;
use CodeIgniter\Controller;


class Faldas extends Controller
{



    // public function falda(){

    //     $datos['cabecera']= view('template/cabecera');
    //     $datos['pie']= view('template/piepagina');

    //     return view('bddclientes/falda',$datos);

    // }

    // public function falda() {
    //     $clienteModel = new Cliente();
    //     $clientes = $clienteModel->select('id AS idCliente, CONCAT(nombre, " ", apellido) AS nombre_completo')
    //                           ->where('estado', 1)
    //                           ->findAll();

    //     $datos['cabecera'] = view('template/cabecera');
    //     $datos['pie'] = view('template/piepagina');
    //     $datos['clientes'] = $clientes; // Pasar la lista de clientes a la vista

    //     return view('bddclientes/falda', $datos);
    // }

    public function falda()
    {
        $clienteModel = new Cliente();
        $clientes = $clienteModel->select('id AS idCliente, CONCAT(nombre, " ", apellido) AS nombre_completo')
            ->where('estado', 1)
            ->where('sexo', 'F')
            ->findAll();

        $datos['cabeceraEditar'] = view('template/cabeceraEditar');
        $datos['pie'] = view('template/piepagina');
        $datos['clientes'] = $clientes; // Pasar la lista de clientes a la vista

        // Obtén los datos de las faldas y la relación 'cliente'
        $faldaModel = new Falda();
        $faldas = $faldaModel->select('falda.idCliente')
            ->join('cliente', 'cliente.id = falda.idCliente')
            ->findAll();

        $datos['faldas'] = $faldas; // Pasar la lista de faldas a la vista

        return view('bddclientes/falda', $datos);
    }


    public function index()
    {
        $faldaModel = new Falda();
        $search = $this->request->getGet('search'); // Obtener el término de búsqueda
        $orden = $this->request->getGet('orden');  // Obtener el criterio de orden

        // Crear la consulta base
        $query = $faldaModel->select(
            'falda.idCliente, CONCAT(cliente.nombre, " ", cliente.apellido) AS nombre_completo, falda.largo, falda.cintura, falda.cadera'
        )->join('cliente', 'cliente.id = falda.idCliente')
            ->where('cliente.estado', 1); // Mostrar solo clientes activos

        // Agregar el filtro de búsqueda
        if (!empty($search)) {
            $query->groupStart()
                ->like('cliente.nombre', $search, 'both')
                ->orLike('cliente.apellido', $search, 'both')
                ->groupEnd();
        }

        // Aplicar el orden
        switch ($orden) {
            case 'recientes':
                $query->orderBy('falda.idCliente', 'DESC'); // Más recientes
                break;
            case 'antiguos':
                $query->orderBy('falda.idCliente', 'ASC'); // Más antiguos
                break;
            case 'nombre_asc':
                $query->orderBy('cliente.nombre', 'ASC'); // Nombre A-Z
                break;
            case 'nombre_desc':
                $query->orderBy('cliente.nombre', 'DESC'); // Nombre Z-A
                break;
            default:
                $query->orderBy('cliente.nombre', 'ASC'); // Orden por defecto
                break;
        }

        // Paginación
        $faldas = $query->paginate(10); // Mostrar 10 resultados por página
        $paginacion = $faldaModel->pager;

        // Pasar los datos a la vista
        $datos = [
            'faldas' => $faldas,
            'paginacion' => $paginacion,
            'search' => $search,
            'orden' => $orden,
            'cabecera' => view('template/cabecera'),
            'pie' => view('template/piepagina'),
        ];

        return view('datos/datosFalda', $datos);
    }

    public function guardarFalda()
    {
        $faldaModel = new Falda();

        // Reglas de validación para los campos
        $validacion = $this->validate([
            'idCliente' => 'required|integer',
            'largo' => 'required|numeric|greater_than[0]|less_than_equal_to[999]',
            'cintura' => 'required|numeric|greater_than[0]|less_than_equal_to[999]',
            'cadera' => 'required|numeric|greater_than[0]|less_than_equal_to[999]'
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
            'cintura' => $this->request->getVar('cintura'),
            'cadera' => $this->request->getVar('cadera')
        ];

        $faldaModel->insert($datos);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Datos de la falda guardados exitosamente',
            'redirectUrl' => site_url('datosFalda')
        ]);
    }





    //SE PRUEBA DESDE AQUI EL EDITAR Y BORRAR AGREGASTE ESTADO EN MYSQL --> EL PROBLEMA ES CON EL ID A LO QUE VEO AGREGA EL GIT PTM XD WEY

    public function borrarFalda($idCliente = null)
    {
        $faldaModel = new Falda();

        // Busca la falda asociada al idCliente
        $falda = $faldaModel->where('idCliente', $idCliente)->first();

        if ($falda) {
            // Elimina la falda de la base de datos
            $faldaModel->delete($falda['idCliente']);
        }

        return redirect()->to(site_url('/datosFalda'));
    }




    public function editarFalda($idCliente = null)
    {
        $faldaModel = new Falda();
        $clienteModel = new Cliente();

        // Busca la falda asociada al idCliente
        $falda = $faldaModel->where('idCliente', $idCliente)->first();
        $cliente = $clienteModel->where('id', $idCliente)->first();


        if (!$falda) {
            // Manejar la situación si no se encuentra la falda asociada al cliente
            return redirect()->to(site_url('/datosFalda'));
        }

        $datos['falda'] = $falda;
        $datos['cliente'] = $cliente;
        $datos['cabeceraEditar'] = view('template/cabeceraEditar');
        $datos['pie'] = view('template/piepagina');
        return view('datos/editarFalda', $datos);
    }


    public function actualizarFalda()
    {
        $falda = new Falda();

        $datos = [
            'largo' => $this->request->getVar('largo'),
            'cintura' => $this->request->getVar('cintura'),
            'cadera' => $this->request->getVar('cadera')
        ];

        $id = $this->request->getVar('idCliente');

        // Validación de los datos de entrada
        $validacion = $this->validate([
            'largo' => [
                'rules' => 'required|numeric|min_length[2]',
                'errors' => [
                    'required' => 'El campo largo es obligatorio.',
                    'numeric' => 'El largo debe ser un número.',
                    'min_length' => 'El largo debe tener al menos 2 dígito.'
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
            ]
        ]);

        if (!$validacion) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Actualización de datos
        $falda->update($id, $datos);

        // Respuesta de éxito
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Falda actualizada exitosamente.',
            'redirectUrl' => site_url('/datosFalda')
        ]);
    }


}
