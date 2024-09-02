<?php 
namespace App\Models;

use CodeIgniter\Model;


class Cliente extends Model{
    protected $table      = 'cliente';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields= ['nombre' , 'apellido' , 'celular' , 'sexo' , 'estado' , 'pago' , 'fechaRegistro' , 'fechaActualizacion'];

    
    public function faldas() {
        return $this->hasMany(Falda::class, 'cliente_id');
    }

    public function pantalon() {
        return $this->hasMany(Pantalon::class, 'cliente_id');
    }

    public function trajeFemenino() {
        return $this->hasMany(TrajeFemenino::class, 'cliente_id');
    }

    public function trajeMasculino() {
        return $this->hasMany(TrajeMasculino::class, 'cliente_id');
    }
}




