<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Reserva;
use App\Models\Tela;

class Reservas extends Controller
{
    protected $telaModel;
    protected $reservaModel;

    public function __construct()
    {
        $this->telaModel = new Tela();
        $this->reservaModel = new Reserva();
        helper(['form', 'url', 'session']);
    }

    /**
     * Selecciona una tela específica para la reserva y verifica si el usuario está autenticado.
     *
     * @param int $idTela El ID de la tela seleccionada
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     */
    public function seleccionarTela($idTela)
    {
        // Obtener el ID del usuario
        $cliente_id = session()->get('user_id');

        // Verificar que el ID de tela exista
        $tela = $this->telaModel->find($idTela);
        if (!$tela) {
            return redirect()->back()->with('error', 'Tela no encontrada.');
        }

        // Crear una nueva reserva
        $data = [
            'fechaReserva' => date('Y-m-d H:i:s'), // Fecha y hora actual como ejemplo
            'idUsuario' => $cliente_id,
            'idTela' => $idTela,
        ];

        // Guardar la reserva
        $this->reservaModel->insert($data);

        // Redirigir a "Mi Cuenta" con un mensaje de éxito
        return redirect()->to(base_url('mi-cuenta'))->with('success', 'Reserva creada exitosamente.');
    }






    /**
     * Guarda la reserva en la base de datos.
     */
    public function guardarReserva()
    {
        $cliente_id = session()->get('user_id');

        // Verifica si ya existe una reserva para el cliente
        $reservaExistente = $this->reservaModel->where('idUsuario', $cliente_id)->first();

        if ($reservaExistente) {
            return redirect()->to(base_url('mi-cuenta'))->with('error', 'Ya tienes una reserva activa.');
        }

        // Guardar la nueva reserva
        $data = [
            'fechaReserva' => $this->request->getPost('fechaReserva'),
            'idUsuario' => $cliente_id,
            'idTela' => $this->request->getPost('tela_id'),
        ];

        if ($this->reservaModel->insert($data)) {
            return redirect()->to(base_url('mi-cuenta'))->with('success', 'Reserva creada exitosamente');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al crear la reserva');
        }
    }


    public function cancelar($id)
    {
        // Verifica que la reserva existe antes de intentar eliminarla
        if ($this->reservaModel->find($id)) {
            // Elimina la reserva completamente
            $this->reservaModel->delete($id);
            return redirect()->to(base_url('mi-cuenta'))->with('success', 'Reserva cancelada exitosamente');
        }

        return redirect()->back()->with('error', 'No se encontró la reserva');
    }



}
