<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Cliente;

class Clientes extends Controller
{
    public function index()
    {
        $cliente = new Cliente();

        $search = $this->request->getGet('search');
        $sexo = $this->request->getGet('sexo');
        $estado = $this->request->getGet('estado');
        $ordenar = $this->request->getGet('ordenar');

        // Consulta base
        $query = $cliente;

        // Filtro por estado (activos o eliminados)
        if ($estado !== null && $estado !== '') {
            $query->where('estado', $estado);
        }

        // Filtro por búsqueda
        if ($search) {
            $query->groupStart()
                ->like('nombre', $search)
                ->orLike('apellido', $search)
                ->orLike('celular', $search)
                ->groupEnd();
        }

        // Filtro por sexo
        if ($sexo) {
            $query->where('sexo', $sexo);
        }

        // Ordenar por fechas o nombres
        if ($ordenar) {
            switch ($ordenar) {
                case 'fechaRegistro_desc':
                    $query->orderBy('fechaRegistro', 'DESC');
                    break;
                case 'fechaRegistro_asc':
                    $query->orderBy('fechaRegistro', 'ASC');
                    break;
                case 'fechaActualizacion_desc':
                    $query->orderBy('fechaActualizacion', 'DESC');
                    break;
                case 'fechaActualizacion_asc':
                    $query->orderBy('fechaActualizacion', 'ASC');
                    break;
                case 'nombre_asc': // Ordenar por nombre A-Z
                    $query->orderBy('nombre', 'ASC');
                    break;
                case 'nombre_desc': // Ordenar por nombre Z-A
                    $query->orderBy('nombre', 'DESC');
                    break;
            }
        }

        // Paginación
        $clientes = $query->paginate(10);
        $paginacion = $cliente->pager;

        // Pasar datos a la vista
        $data = [
            'clientes' => $clientes,
            'paginacion' => $paginacion,
            'search' => $search,
            'sexo' => $sexo,
            'estado' => $estado,
            'ordenar' => $ordenar,
            'cabecera' => view('template/cabecera'),
            'pie' => view('template/piepagina'),
        ];

        return view('bddclientes/cliente', $data);
    }





    // Se está creando la vista de CREAR
    public function crear()
    {
        $datos['cabeceraEditar'] = view('template/cabeceraEditar');
        $datos['pie'] = view('template/piepagina');

        return view('bddclientes/crear', $datos);
    }

    // public function guardar()
    // {
    //     $cliente = new Cliente();

    //     $validacion = $this->validate([
    //         'nombre' => [
    //             'rules' => 'required|min_length[3]',
    //             'errors' => [
    //                 'required' => 'El campo Nombre es obligatorio.',
    //                 'min_length' => 'El Nombre debe tener al menos 3 caracteres.'
    //             ]
    //         ],
    //         'apellido' => [
    //             'rules' => 'required|min_length[3]',
    //             'errors' => [
    //                 'required' => 'El campo Apellido es obligatorio.',
    //                 'min_length' => 'El Apellido debe tener al menos 3 caracteres.'
    //             ]
    //         ],
    //         'celular' => [
    //             'rules' => 'permit_empty|numeric|min_length[8]',
    //             'errors' => [
    //                 'numeric' => 'El campo Celular debe contener solo números.',
    //                 'min_length' => 'El Celular debe tener al menos 8 dígitos.'
    //             ]
    //         ]
    //     ]);


    //     if (!$validacion) {
    //         // Devolver los errores detallados
    //         return $this->response->setJSON([
    //             'success' => false,
    //             'message' => 'Revise la información ingresada',
    //             'errors' => $this->validator->getErrors() // Devuelve los errores detallados
    //         ]);
    //     }

    //     $datos = [
    //         'nombre' => $this->request->getVar('nombre'),
    //         'apellido' => $this->request->getVar('apellido'),
    //         'sexo' => $this->request->getVar('sexo'),
    //         'celular' => $this->request->getVar('celular'),
    //         'fechaRegistro' => date('Y-m-d H:i:s'),
    //         'estado' => 1,
    //     ];

    //     $cliente->insert($datos);

    //     return $this->response->setJSON([
    //         'success' => true,
    //         'message' => 'Cliente creado exitosamente',
    //         'redirectUrl' => site_url('/cliente')
    //     ]);
    // }

    public function guardar()
    {
        $cliente = new Cliente();

        // Normalizar datos
        $nombre = strtolower(trim($this->request->getVar('nombre')));
        $apellido = strtolower(trim($this->request->getVar('apellido')));

        // Validar duplicados: Nombre y Apellido juntos
        $duplicado = $cliente->where('LOWER(nombre)', $nombre)
            ->where('LOWER(apellido)', $apellido)
            ->first();

        if ($duplicado) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ya existe un cliente con el mismo nombre y apellido.',
                'errors' => ['duplicado' => 'Este cliente ya está registrado.']
            ]);
        }

        // Validar campos requeridos
        $validacion = $this->validate([
            'nombre' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo Nombre es obligatorio.',
                    'min_length' => 'El Nombre debe tener al menos 3 caracteres.'
                ]
            ],
            'apellido' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo Apellido es obligatorio.',
                    'min_length' => 'El Apellido debe tener al menos 3 caracteres.'
                ]
            ],
            'celular' => [
                'rules' => 'permit_empty|numeric|min_length[8]',
                'errors' => [
                    'numeric' => 'El campo Celular debe contener solo números.',
                    'min_length' => 'El Celular debe tener al menos 8 dígitos.'
                ]
            ]
        ]);

        if (!$validacion) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Revise la información ingresada.',
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Insertar cliente nuevo
        $datos = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'celular' => trim($this->request->getVar('celular')),
            'sexo' => $this->request->getVar('sexo'),
            'fechaRegistro' => date('Y-m-d H:i:s'),
            'estado' => 1,
        ];

        $cliente->insert($datos);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Cliente creado exitosamente.',
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

        $datos['cabeceraEditar'] = view('template/cabeceraEditar');
        $datos['pie'] = view('template/piepagina');

        return view('bddclientes/editar', $datos);
    }

    public function actualizar()
    {
        $clienteModel = new Cliente();

        date_default_timezone_set('America/La_Paz');

        // Capturar ID y datos de cliente desde la solicitud
        $id = $this->request->getVar('id');
        $datosCliente = [
            'nombre' => strtolower($this->request->getVar('nombre')),
            'apellido' => strtolower($this->request->getVar('apellido')),
            'sexo' => $this->request->getVar('sexo'),
            'celular' => $this->request->getVar('celular'),
            'fechaActualizacion' => date('Y-m-d H:i:s'),
            'estado' => 1 // Estado activo
        ];

        // Validación de los datos de entrada
        $validacion = $this->validate([
            'nombre' => [
                'rules' => 'required|min_length[3]|alpha_space',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.',
                    'alpha_space' => 'El nombre solo debe contener letras y espacios.'
                ]
            ],
            'apellido' => [
                'rules' => 'required|min_length[3]|alpha_space',
                'errors' => [
                    'required' => 'El campo apellido es obligatorio.',
                    'min_length' => 'El apellido debe tener al menos 3 caracteres.',
                    'alpha_space' => 'El apellido solo debe contener letras y espacios.'
                ]
            ],
            'celular' => [
                'rules' => 'permit_empty|numeric|min_length[8]',
                'errors' => [
                    'required' => 'El campo celular es obligatorio.',
                    'numeric' => 'El celular debe contener solo números.',
                    'exact_length' => 'El celular debe tener exactamente 8 dígitos.'
                ]
            ],
            'sexo' => [
                'rules' => 'in_list[M,F]',
                'errors' => [
                    'in_list' => 'El campo sexo debe ser "M" para masculino o "F" para femenino.'
                ]
            ]
        ]);

        // Si la validación falla, devolver errores específicos en JSON
        if (!$validacion) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Actualizar los datos del cliente en la base de datos
        $clienteModel->update($id, $datosCliente);

        // Redirigir a la lista de clientes con un mensaje de éxito
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Cliente actualizado exitosamente',
            'redirectUrl' => site_url('/cliente')
        ]);
    }

    public function index1()
    {
        return view('sastreria/index.html');
    }
    public function nosotros()
    {
        return view('sastreria/nosotros.html');
    }

    public function contacto()
    {
        return view('sastreria/contacto.html');
    }

}
