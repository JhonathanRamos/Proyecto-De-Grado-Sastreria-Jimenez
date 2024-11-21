<?php
namespace App\Models;

use CodeIgniter\Model;


class Venta extends Model
{
    protected $table = 'venta';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idVenta';
    protected $allowedFields = ['total', 'estado', 'metodoPago', 'descuento', 'fechaRegistro', 'fechaActualizacion', 'idUsuario', 'idCliente'];

    protected $useTimestamps = true;
    protected $createdField = 'fechaRegistro';
    protected $updatedField = 'fechaActualizacion';

    protected $returnType = 'array'; // Para retornar datos en formato de arreglo
}
