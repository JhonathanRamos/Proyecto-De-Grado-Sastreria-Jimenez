<?php

namespace App\Models;

use CodeIgniter\Model;

class TrajeFemenino extends Model {
    protected $table = 'traje_femenino';

    protected $primaryKey = 'idCliente';
    
    protected $allowedFields = ['talle', 'largo', 'hombro', 'ancho', 'pecho', 'cintura', 'cadera' ,'largoManga', 'idCliente'];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function clientes() {
        return $this->hasMany(Cliente::class, 'idCliente');
    }
    
}
