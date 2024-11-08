<?php 
namespace App\Models;

use CodeIgniter\Model;

class Reserva extends Model
{
    protected $table = 'reserva';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fechaReserva','idUsuario','idTela', 'estado'];
}
