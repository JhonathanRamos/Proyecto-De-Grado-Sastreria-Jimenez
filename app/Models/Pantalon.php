<?php

namespace App\Models;

use CodeIgniter\Model;

class Pantalon extends Model {
    protected $table = 'pantalon';
    protected $primaryKey = 'idCliente';
    protected $allowedFields = ['largo', 'entrepierna','cintura', 'cadera', 'pierna', 'rodilla', 'bota', 'idCliente'];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function clientes() {
        return $this->hasMany(Cliente::class, 'idCliente');
    }
    
    
}
