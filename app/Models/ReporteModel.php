<?php
// ReporteModel.php
namespace App\Models;

use CodeIgniter\Model;

class ReporteModel extends Model 
{
    protected $table = 'tela';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'descripcion', 'calidad', 'metros', 'precio', 'estado', 'idUsuario'];

    public function telaConMasReservas()
    {
        return $this->db->table('reserva')
            ->select('tela.nombre, tela.calidad, tela.precio, tela.descripcion, 
                     COUNT(reserva.id) AS total_reservas, 
                     COUNT(DISTINCT reserva.idUsuario) as usuarios_unicos')
            ->join('tela', 'reserva.idTela = tela.id')
            ->where('tela.estado', 1)
            ->groupBy('tela.id, tela.nombre, tela.calidad, tela.precio, tela.descripcion')
            ->orderBy('total_reservas', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function ventasPorCliente()
    {
        return $this->db->table('venta')
            ->select('cliente.nombre, cliente.apellido, 
                     COUNT(venta.idVenta) AS total_ventas, 
                     SUM(venta.total) AS total_monto,
                     MAX(venta.fechaRegistro) as ultima_compra')
            ->join('cliente', 'venta.idCliente = cliente.id')
            ->where('cliente.estado', 1)
            ->groupBy('cliente.id')
            ->orderBy('total_monto', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function detallesDeVentas()
    {
        return $this->db->table('detalle_venta')
            ->select('detalle_venta.*, confeccion.descripcion AS producto,
                     venta.fechaRegistro, venta.metodoPago,
                     cliente.nombre AS cliente, cliente.apellido')
            ->join('confeccion', 'detalle_venta.idConfeccion = confeccion.id')
            ->join('venta', 'detalle_venta.idVenta = venta.idVenta')
            ->join('cliente', 'venta.idCliente = cliente.id')
            ->orderBy('venta.fechaRegistro', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function ventasPorMetodoDePago()
    {
        return $this->db->table('venta')
            ->select('metodoPago, COUNT(idVenta) AS total_ventas,
                     SUM(total) AS monto_total,
                     MIN(fechaRegistro) as primera_venta,
                     MAX(fechaRegistro) as ultima_venta')
            ->groupBy('metodoPago')
            ->orderBy('monto_total', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function confeccionesMasSolicitadas()
    {
        return $this->db->query("
            SELECT 
                c.id,
                c.descripcion,
                c.categoria,
                COUNT(dv.idConfeccion) as total_ventas,
                SUM(dv.cantidad) as unidades_vendidas,
                SUM(dv.subtotal) as ingresos_totales,
                AVG(dv.precio_unitario) as precio_promedio,
                COUNT(DISTINCT v.idCliente) as clientes_unicos,
                (
                    SELECT COUNT(*)
                    FROM detalle_venta dv2
                    JOIN venta v2 ON dv2.idVenta = v2.idVenta
                    WHERE dv2.idConfeccion = c.id
                    AND v2.estado = 0
                ) as trabajos_completados,
                (
                    SELECT COUNT(*)
                    FROM detalle_venta dv3
                    JOIN venta v3 ON dv3.idVenta = v3.idVenta
                    WHERE dv3.idConfeccion = c.id
                    AND v3.estado = 1
                ) as trabajos_pendientes
            FROM confeccion c
            LEFT JOIN detalle_venta dv ON c.id = dv.idConfeccion
            LEFT JOIN venta v ON dv.idVenta = v.idVenta
            WHERE c.estado = 1
            GROUP BY c.id, c.descripcion, c.categoria
            ORDER BY unidades_vendidas DESC"
        )->getResultArray();
    }
}
