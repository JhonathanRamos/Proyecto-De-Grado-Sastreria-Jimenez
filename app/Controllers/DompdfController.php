<?php
namespace App\Controllers;

use Dompdf\Dompdf;
use CodeIgniter\Controller;
use CodeIgniter\Database\Database;

class DompdfController extends BaseController
{
    // Exportar ventas completadas (estado = 1)
    public function exportarCompletadasPDF()
    {
        // Conectar a la base de datos
        $db = \Config\Database::connect();

        // Obtener ventas completadas (estado = 1)
        $query = $db->query("SELECT venta.*, cliente.nombre, cliente.apellido, confeccion.descripcion
                             FROM venta
                             JOIN cliente ON venta.idCliente = cliente.id
                             JOIN confeccion ON venta.idConfeccion = confeccion.id
                             WHERE venta.estado = 1"); // Estado 1 es completado

        $ventas = $query->getResultArray();

        // Pasar las ventas a la vista
        $html = view('venta/ventasPDF', ['ventas' => $ventas]);

        // Inicializar Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Enviar el PDF al navegador
        $dompdf->stream('ventas_completadas.pdf', ['Attachment' => false]);
    }

    // Exportar ventas pendientes (estado = 0)
    public function exportarPendientesPDF()
    {
        // Conectar a la base de datos
        $db = \Config\Database::connect();

        // Obtener ventas pendientes (estado = 0)
        $query = $db->query("SELECT venta.*, cliente.nombre, cliente.apellido, confeccion.descripcion
                             FROM venta
                             JOIN cliente ON venta.idCliente = cliente.id
                             JOIN confeccion ON venta.idConfeccion = confeccion.id
                             WHERE venta.estado = 0"); // Estado 0 es pendiente

        $ventas = $query->getResultArray();

        // Pasar las ventas a la vista
        $html = view('venta/ventasPDF', ['ventas' => $ventas]);

        // Inicializar Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Enviar el PDF al navegador
        $dompdf->stream('ventas_pendientes.pdf', ['Attachment' => false]);
    }
}
