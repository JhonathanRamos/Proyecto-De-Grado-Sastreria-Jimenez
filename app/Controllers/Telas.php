<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Tela;

class Telas extends Controller
{

    public function index()
    {
        $telaModel = new Tela();
        // Obtener solo las telas que no están eliminadas (estado = 1)
        $datos['telas'] = $telaModel->where('estado', 1)->orderBy('id', 'ASC')->findAll();
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('tela/tela', $datos); // Asegúrate de que esta ruta sea correcta
    }


    public function crear()
    {
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('tela/crearTela', $datos);
    }


    public function guardar()
    {
        $telaModel = new Tela();

        $validacion = $this->validate([
            'imagenTela' => [
                'uploaded[imagenTela]',
                'mime_in[imagenTela,image/jpg,image/jpeg,image/png]',
                'max_size[imagenTela,16384]', // 16 MB
            ],
            'imagenTraje' => [
                'mime_in[imagenTraje,image/jpg,image/jpeg,image/png]', // Solo válida si se sube
                'max_size[imagenTraje,16384]', // 16 MB
            ],
        ]);



        if (!$validacion) {
            session()->setFlashdata('mensaje', 'Revise la información proporcionada');
            return redirect()->back()->withInput();
        }

        $nombreImagenTela = null;
        $nombreImagenTraje = null;

        if ($imagenTela = $this->request->getFile('imagenTela')) {
            $nombreImagenTela = $imagenTela->getRandomName();
            $imagenTela->move('../public/uploads/', $nombreImagenTela);
        }

        if ($imagenTraje = $this->request->getFile('imagenTraje')) {
            $nombreImagenTraje = $imagenTraje->getRandomName();
            $imagenTraje->move('../public/uploads/', $nombreImagenTraje);
        }

        $idUsuario = session()->get('user_id');
        if (!$idUsuario) {
            session()->setFlashdata('mensaje', 'Usuario no identificado');
            return redirect()->back()->withInput();
        }

        $datos = [
            'nombre' => $this->request->getVar('nombre'),
            'calidad' => $this->request->getVar('calidad'),
            'descripcion' => $this->request->getVar('descripcion'),
            'metros' => $this->request->getVar('metros'),
            'precio' => $this->request->getVar('precio'),
            'estado' => 1,
            'imagenTela' => $nombreImagenTela,
            'imagenTraje' => $nombreImagenTraje,
            'idUsuario' => $idUsuario
        ];

        $telaModel->insert($datos);

        return $this->response->redirect(site_url('/telas'));
    }


    public function editar($id)
    {
        $telaModel = new Tela();
        $tela = $telaModel->find($id);

        if ($tela) {
            $datos['tela'] = $tela;
            $datos['cabecera'] = view('template/cabecera');
            $datos['pie'] = view('template/piepagina');
            return view('tela/editarTela', $datos);
        } else {
            session()->setFlashdata('mensaje', 'Tela no encontrada');
            return redirect()->to(site_url('/telas'));
        }
    }

    public function actualizar($id)
    {
        $telaModel = new Tela();

        $validacion = $this->validate([
            'imagenTela' => [
                'mime_in[imagenTela,image/jpg,image/jpeg,image/png]',
                'max_size[imagenTela,2048]',
            ],
            'imagenTraje' => [
                'mime_in[imagenTraje,image/jpg,image/jpeg,image/png]',
                'max_size[imagenTraje,2048]',
            ]
        ]);

        if (!$validacion) {
            session()->setFlashdata('mensaje', 'Revise la información proporcionada');
            return redirect()->back()->withInput();
        }

        $tela = $telaModel->find($id);
        $nombreImagenTela = $tela['imagenTela'];
        $nombreImagenTraje = $tela['imagenTraje'];

        if ($imagenTela = $this->request->getFile('imagenTela')) {
            if ($imagenTela->isValid() && !$imagenTela->hasMoved()) {
                $nombreImagenTela = $imagenTela->getRandomName();
                $imagenTela->move('../public/uploads/', $nombreImagenTela);
            }
        }

        if ($imagenTraje = $this->request->getFile('imagenTraje')) {
            if ($imagenTraje->isValid() && !$imagenTraje->hasMoved()) {
                $nombreImagenTraje = $imagenTraje->getRandomName();
                $imagenTraje->move('../public/uploads/', $nombreImagenTraje);
            }
        }

        $datos = [
            'nombre' => $this->request->getVar('nombre'),
            'calidad' => $this->request->getVar('calidad'),
            'descripcion' => $this->request->getVar('descripcion'),
            'metros' => $this->request->getVar('metros'),
            'precio' => $this->request->getVar('precio'),
            'imagenTela' => $nombreImagenTela,
            'imagenTraje' => $nombreImagenTraje,
        ];

        $telaModel->update($id, $datos);

        session()->setFlashdata('mensaje', 'Tela actualizada con éxito');
        return $this->response->redirect(site_url('/telas'));
    }

    public function borrar($id)
    {
        $telaModel = new Tela();

        // Verificar si la tela existe
        $tela = $telaModel->find($id);
        if ($tela) {
            // Actualizar el estado a 0 para la eliminación lógica
            $telaModel->update($id, ['estado' => 0]);
            session()->setFlashdata('mensaje', 'Tela desactivada con éxito');
        } else {
            session()->setFlashdata('mensaje', 'Tela no encontrada');
        }

        return redirect()->to(site_url('/telas'));
    }


    public function mostrarTela()
    {
        $telaModel = new Tela();
        $datos['telas'] = $telaModel->where('estado', 1)->orderBy('id', 'ASC')->findAll();
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('sastreria/telaTraje', $datos); // Verifica que esta ruta coincida con la ubicación del archivo

    }

    public function mostrarTelaTraje()
    {
        $telaModel = new Tela();
        $datos['telas'] = $telaModel->where('estado', 1)->orderBy('id', 'ASC')->findAll();
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('sastreria/telaTraje', $datos); // Verifica que esta ruta coincida con la ubicación del archivo

    }
}
