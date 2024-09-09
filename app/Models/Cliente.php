<?php 
namespace App\Models;

use CodeIgniter\Model;


class Cliente extends Model{
    protected $table      = 'cliente';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields= ['nombre' , 'apellido' , 'celular' , 'sexo' , 'estado' , 'adelanto' , 'fechaRegistro' , 'fechaActualizacion'];

    
    public function faldas() {
        return $this->hasMany(Falda::class, 'idCliente');
    }

    public function pantalon() {
        return $this->hasMany(Pantalon::class, 'idCliente');
    }

    public function trajeFemenino() {
        return $this->hasMany(TrajeFemenino::class, 'idCliente');
    }

    public function trajeMasculino() {
        return $this->hasMany(TrajeMasculino::class, 'idCliente');
    }
}




