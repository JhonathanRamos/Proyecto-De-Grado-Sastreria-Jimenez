<?php 
namespace App\Models;

use CodeIgniter\Model;


class Venta extends Model{
    protected $table      = 'venta';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idVenta';
    protected $allowedFields= ['fecha' , 'total' , 'estado' , 'fechaRegistro' , 'fechaActualizacion' , 'idUsuario' , 'idCliente'];

}




