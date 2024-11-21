<?php
namespace App\Models;

use CodeIgniter\Model;

class Detalle_Venta extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'idDetalleVenta';
    protected $allowedFields = ['cantidad','precio_unitario', 'metrosTela','descuento','subtotal','adelanto','restante','fechaPrueba',
                                'fechaEntrega','idConfeccion','idVenta','idTela' ];
}
