<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleConfeccion extends Model {
    protected $table = 'detalleconfeccion';

    protected $primaryKey = 'id';
    protected $allowedFields = ['descripcion', 'precio', 'adelanto', 'unidadMedida' ,'idConfeccion','idUsuario'];

}


