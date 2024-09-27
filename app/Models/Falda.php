<?php

namespace App\Models;

use CodeIgniter\Model;

class Falda extends Model {
    protected $table = 'falda';

    protected $primaryKey = 'idCliente';
    protected $allowedFields = ['largo', 'cintura', 'cadera', 'estado' ,'idCliente'];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function clientes() {
        return $this->hasMany(Cliente::class, 'idCliente');
    }
}
