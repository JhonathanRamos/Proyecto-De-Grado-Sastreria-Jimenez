<?php
namespace App\Models;

use CodeIgniter\Model;

class Tela extends Model
{
    protected $table = 'tela';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'calidad', 'descripcion', 'metros', 'precio', 'estado', 'imagenTela', 'imagenTraje', 'idUsuario'];
}
