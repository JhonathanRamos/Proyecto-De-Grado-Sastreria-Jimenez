<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Confeccion;

class Confeccions extends Controller
{
    public function index()
    {
        $confeccionModel = new Confeccion();

        // Obtener todas las confecciones
        $confecciones = $confeccionModel->findAll();

        // Preparar los datos para la vista
        $data['confecciones'] = $confecciones;
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        // Cargar la vista de confecciones
        return view('Confeccion/confeccion', $data);
    }

    public function crear()
    {
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('Confeccion/crearConfeccion', $data);
    }

    // Guardar nueva confección
    public function guardar()
    {
        $confeccionModel = new Confeccion();

        // Validar los campos del formulario
        $validacion = $this->validate([
            'descripcion' => 'required|min_length[3]',
            'precio' => 'required|numeric',
            'unidadMedida' => 'required|min_length[1]',
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

        // Insertar la confección
        $confeccionData = [
            'descripcion' => $this->request->getVar('descripcion'),
            'precio' => $this->request->getVar('precio'),
            'unidadMedida' => $this->request->getVar('unidadMedida'),
            'idUsuario' => $idUsuario,
            'created_at' => date('Y-m-d H:i:s')  // Fecha de creación
        ];

        $confeccionModel->insert($confeccionData);

        // Redirigir después de guardar
        session()->setFlashdata('mensaje', 'Confección guardada con éxito');
        return redirect()->to(site_url('/confeccion'));
    }

    // Editar una confección
    public function editar($id)
    {
        $confeccionModel = new Confeccion();
        $confeccion = $confeccionModel->find($id);

        if ($confeccion) {
            $data['confeccion'] = $confeccion;
            $data['cabecera'] = view('template/cabecera');
            $data['pie'] = view('template/piepagina');
            return view('Confeccion/editarConfeccion', $data);
        } else {
            session()->setFlashdata('mensaje', 'Confección no encontrada');
            return redirect()->to(site_url('/confeccion'));
        }
    }

    // Actualizar una confección
    public function actualizar($id)
    {
        $confeccionModel = new Confeccion();

        // Validar los campos del formulario
        $validacion = $this->validate([
            'descripcion' => 'required|min_length[3]',
            'precio' => 'required|numeric',
            'unidadMedida' => 'required|min_length[1]',
        ]);

        if (!$validacion) {
            session()->setFlashdata('mensaje', 'Revise la información proporcionada');
            return redirect()->back()->withInput();
        }

        // Actualizar la confección
        $confeccionData = [
            'descripcion' => $this->request->getVar('descripcion'),
            'precio' => $this->request->getVar('precio'),
            'unidadMedida' => $this->request->getVar('unidadMedida'),
        ];

        $confeccionModel->update($id, $confeccionData);

        // Redirigir después de actualizar
        session()->setFlashdata('mensaje', 'Confección actualizada con éxito');
        return redirect()->to(site_url('/confeccion'));
    }

    // Eliminar una confección
    public function borrar($id)
    {
        $confeccionModel = new Confeccion();
        $confeccionModel->delete($id);

        // Redirigir después de eliminar
        session()->setFlashdata('mensaje', 'Confección eliminada con éxito');
        return redirect()->to(site_url('/confeccion'));
    }
}
