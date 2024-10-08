<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Cliente;
use App\Models\TrajeMasculino;
use App\Models\Confeccion;



class Clientes extends Controller
{

    public function index()
    {
        $cliente = new Cliente();
        $confeccionModel = new Confeccion();

        // Seleccionar solo clientes activos
        $datos['clientes'] = $cliente->where('estado', 1)->orderBy('id', 'ASC')->findAll();

        // Añadir el adelanto total por cliente
        foreach ($datos['clientes'] as &$cliente) {
            // Obtener confecciones asociadas al cliente
            $confecciones = $confeccionModel->where('idCliente', $cliente['id'])->findAll();

            // Calcular el total del adelanto
            $totalAdelanto = 0;
            foreach ($confecciones as $confeccion) {
                $totalAdelanto += $confeccion['adelanto'];
            }

            // Añadir el adelanto calculado al array de datos del cliente
            $cliente['adelanto'] = $totalAdelanto;
        }

        // Añadir las vistas de cabecera y pie de página
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('bddclientes/cliente', $datos);
    }


    // public function index()
    // {
    //     $cliente = new Cliente();

    //     // Aplicar una condición para seleccionar solo clientes con estado igual a 1
    //     $datos['clientes'] = $cliente->where('estado', 1)->orderBy('id', 'ASC')->findAll();

    //     // Se está poniendo un nombre y dirigiendo donde están con $datos y la dirección con view
    //     $datos['cabecera'] = view('template/cabecera');
    //     $datos['pie'] = view('template/piepagina');

    //     return view('bddclientes/cliente', $datos);
    // }





    //Se esta Creando la vista de CREAR
    public function crear()
    {

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('bddclientes/crear', $datos);

    }




    public function comprar()
    {
        return view('sastreria/comprar.html');
    }

    public function traje()
    {
        return view('sastreria/traje.html');
    }
    public function diseno()
    {
        return view('sastreria/diseno.html');
    }

    public function novedad()
    {
        return view('sastreria/novedad.html');
    }

    public function sacoFemenino()
    {
        return view('sastreria/sacoFemenino.html');
    }

    public function sacoMasculino()
    {
        return view('sastreria/sacoMasculino.html');
    }

    public function index1()
    {
        return view('sastreria/index.html');
    }

    public function nosotros()
    {
        return view('sastreria/nosotros.html');
    }

    public function tienda()
    {
        return view('sastreria/tienda');
    }





    //Se esta Guardando los datos 
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
            'adelanto' => $this->request->getVar('adelanto'),
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


    // public function guardar()
    // {
    //     $cliente = new Cliente();

    //     $validacion = $this->validate([
    //         'nombre' => 'required|min_length[3]',
    //         'apellido' => 'required|min_length[3]',
    //         'celular' => 'required|numeric|min_length[8]', // Agregamos la validación para números
    //     ]);

    //     if (!$validacion) {
    //         $session= session();
    //         $session->setFlashdata('mensaje','Revise la informacion ');


    //         return redirect()->back()->withInput();
    //         // return $this->response->redirect(site_url('/cliente'));
    //     }


    //     $datos = [
    //         'nombre' => $this->request->getVar('nombre'),
    //         'apellido' => $this->request->getVar('apellido'),
    //         'sexo' => $this->request->getVar('sexo'),
    //         'celular' => $this->request->getVar('celular'),
    //         'adelanto' => $this->request->getVar('adelanto'),
    //         'fechaRegistro' => date('Y-m-d'),
    //         'estado' => 1, // Estado activo
    //     ];

    //     $cliente->insert($datos);
    //     return redirect()->to(site_url('/cliente'));
    // }



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
        $confeccionModel = new Confeccion();

        // Obtener datos del cliente
        $datos['cliente'] = $clienteModel->where('id', $id)->first();

        // Obtener todas las confecciones del cliente
        $confecciones = $confeccionModel->where('idCliente', $id)->findAll();

        // Sumar los adelantos
        $totalAdelanto = 0;
        foreach ($confecciones as $confeccion) {
            $totalAdelanto += $confeccion['adelanto'];
        }

        // Añadir el adelanto calculado a los datos del cliente
        $datos['cliente']['adelanto'] = $totalAdelanto;

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('bddclientes/editar', $datos);
    }




    public function actualizar()
    {
        $clienteModel = new Cliente();
        $confeccionModel = new Confeccion();
    
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
            $session->setFlashdata('mensaje', 'Revise la informacion');
            return redirect()->back()->withInput();
        }
    
        // Actualizar los datos del cliente
        $clienteModel->update($id, $datosCliente);
        
        // Obtener el adelanto del formulario
        $nuevoAdelanto = $this->request->getVar('adelanto');
    
        // Verificar si ya existe una confección para este cliente
        $confeccion = $confeccionModel->where('idCliente', $id)->first();
        
        if ($confeccion) {
            // Si existe, actualizar el adelanto
            $confeccionModel->where('idCliente', $id)->set(['adelanto' => $nuevoAdelanto])->update();
        } else {
            // Si no existe, crear una nueva confección con el adelanto
            $confeccionModel->insert([
                'idCliente' => $id,
                'adelanto' => $nuevoAdelanto
            ]);
        }
    
        return redirect()->to(site_url('/cliente'));
    }
    


}