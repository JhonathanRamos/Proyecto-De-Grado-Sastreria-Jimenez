<?php

namespace App\Models;

use CodeIgniter\Model;

class TrajeMasculino extends Model {
    protected $table = 'traje_masculino';

    protected $primaryKey = 'idCliente';
    protected $allowedFields = ['talle', 'largo', 'hombro', 'ancho', 'pecho', 'estomago', 'largoManga', 'idCliente'];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function clientes() {
        return $this->hasMany(Cliente::class, 'idCliente');
    }
}
