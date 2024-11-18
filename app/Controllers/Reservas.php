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
     * Muestra el formulario para confirmar la reserva con la tela seleccionada.
     */
    public function crear($idTela)
    {
        $this->verificarReservasVencidas(); // Verificar y actualizar reservas vencidas

        $tela = $this->telaModel->find($idTela);

        if (!$tela) {
            return redirect()->to('/telaTraje')->with('error', 'Tela no encontrada.');
        }

        $cliente_id = session()->get('user_id');

        return view('reservaCliente/crearReserva', [
            'tela' => $tela,
            'cliente_id' => $cliente_id,
        ]);
    }

    /**
     * Guarda la reserva en la base de datos.
     */
    public function guardar()
    {
        $this->verificarReservasVencidas(); // Verificar y actualizar reservas vencidas

        $cliente_id = session()->get('user_id');

        // Verificar si existe una reserva vencida o activa
        $reservaExistente = $this->reservaModel
            ->where('idUsuario', $cliente_id)
            ->whereIn('estado', [0, 1]) // Buscar tanto activas como canceladas
            ->first();

        // Validar la fecha de reserva
        $fechaReserva = $this->request->getPost('fechaReserva');
        if (empty($fechaReserva)) {
            return redirect()->back()->with('error', 'Por favor, selecciona una fecha válida.');
        }

        if (strtotime($fechaReserva) < strtotime(date('Y-m-d H:i'))) {
            return redirect()->back()->with('error', 'La fecha de reserva no puede ser en el pasado.');
        }

        $data = [
            'fechaReserva' => $fechaReserva,
            'idUsuario' => $cliente_id,
            'idTela' => $this->request->getPost('tela_id'),
            'estado' => 1, // Activa por defecto
        ];

        if ($reservaExistente) {
            // Reutilizar la fila existente
            $this->reservaModel->update($reservaExistente['id'], $data);
        } else {
            // Crear una nueva reserva
            $this->reservaModel->insert($data);
        }

        return redirect()->to('mi-cuenta')->with('success', 'Reserva creada exitosamente.');
    }

    public function cancelar($id)
    {
        // Buscar la reserva por ID
        $reserva = $this->reservaModel->find($id);

        if (!$reserva) {
            return redirect()->to('mi-cuenta')->with('error', 'Reserva no encontrada.');
        }

        // Cambiar el estado de la reserva a cancelado (0)
        $this->reservaModel->update($id, ['estado' => 0]);

        return redirect()->to('mi-cuenta')->with('success', 'Reserva cancelada correctamente.');
    }


    private function verificarReservasVencidas()
    {
        $reservasVencidas = $this->reservaModel
            ->where('fechaReserva <', date('Y-m-d H:i:s'))
            ->where('estado', 1) // Solo reservas activas
            ->findAll();

        foreach ($reservasVencidas as $reserva) {
            $this->reservaModel->update($reserva['id'], ['estado' => 0]); // Actualizar el estado a vencido
        }
    }
}
