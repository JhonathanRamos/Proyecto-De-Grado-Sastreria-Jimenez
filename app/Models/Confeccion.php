<?php

namespace App\Models;

use CodeIgniter\Model;

class Confeccion extends Model {
    protected $table = 'confeccion';

    protected $primaryKey = 'id';
    protected $allowedFields = ['descripcion','estado' ,'precio', 'adelanto', 'unidadMedida' ,'idUsuario'];

}


