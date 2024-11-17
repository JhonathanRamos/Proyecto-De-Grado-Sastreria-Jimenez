<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Cliente;
use CodeIgniter\Controller;

class ReportesController extends BaseController
{
    // Muestra la vista de los reportes
    public function index()
    {
        $data['cabecera'] = view('template/cabecera'); // Cabecera
        $data['pie'] = view('template/piepagina'); // Pie de página

        // Cargar la vista de reportes generales
        return view('reportes/reportes', $data); // Vista de reportes
    }

    // Exportar reportes en PDF según el tipo de reporte
    public function exportarPDF($estado)
    {
        // Verificar si el estado es válido (activos o inactivos)
        if ($estado !== 'activos' && $estado !== 'inactivos') {
            return redirect()->back()->with('error', 'Estado no válido');
        }

        // Generar el HTML según el estado
        $html = $this->generarHtmlEstadoClientes($estado);

        // Inicializar Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Mostrar el PDF en el navegador
        $dompdf->stream("reporte_estadoClientes_$estado.pdf", ["Attachment" => 0]); // Abrir en el navegador
    }

    // Generar HTML para el estado de clientes utilizando vistas de la base de datos
    private function generarHtmlEstadoClientes($estado)
    {
        $db = \Config\Database::connect();

        // Seleccionar la vista adecuada según el estado
        $vista = ($estado === 'activos') ? 'clientesActivos' : 'clientesInactivos';

        // Consultar la vista correspondiente
        $query = $db->query("SELECT * FROM $vista");
        $clientes = $query->getResultArray();

        // Título del reporte
        $titulo = $estado === 'activos' ? "Clientes Activos" : "Clientes Inactivos";

        // Generar el HTML
        $html = "<h1>$titulo</h1>";
        $html .= "<table border='1' cellpadding='10' cellspacing='0' width='100%'>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Sexo</th>
                    <th>Celular</th>
                    <th>Estado</th>
                    <th>Fecha de Registro</th>
                </tr>";

        foreach ($clientes as $cliente) {
            $estadoTexto = $cliente['estado'] == 1 ? 'Activo' : 'Inactivo';
            $sexoTexto = $cliente['sexo'] == 'M' ? 'Masculino' : 'Femenino';
            $html .= "<tr>
                    <td>{$cliente['id']}</td>
                    <td>{$cliente['nombre']}</td>
                    <td>{$cliente['apellido']}</td>
                    <td>{$sexoTexto}</td>
                    <td>{$cliente['celular']}</td>
                    <td>{$estadoTexto}</td>
                    <td>{$cliente['fechaRegistro']}</td>
                  </tr>";
        }

        $html .= "</table>";
        return $html;
    }




    public function exportarPDFDeudores()
    {
        $db = \Config\Database::connect();

        // Llamar al procedimiento almacenado que obtenga la información de deudores
        $query = $db->query("CALL obtenerDeudores()");
        $deudores = $query->getResultArray();

        // Cerrar cualquier resultado adicional para liberar memoria
        while ($db->connID->more_results() && $db->connID->next_result()) {
        }

        // Generar HTML del reporte de deudores
        $html = "<h1>Reporte de Deudores</h1>";
        $html .= "<table border='1' cellpadding='10' cellspacing='0' width='100%' style='border-collapse: collapse;'>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Adelanto</th>
                    <th>Precio C o A</th>
                    <th>Total a Pagar</th>
                    <th>Método de Pago</th>
                    <th>Fecha Registro</th>
                </tr>";

        foreach ($deudores as $deudor) {
            $html .= "<tr>
                    <td>{$deudor['idVenta']}</td>
                    <td>{$deudor['nombreCliente']} {$deudor['apellidoCliente']}</td>
                    <td>{$deudor['adelanto']} Bs</td>
                    <td>{$deudor['precioConfeccionArreglo']} Bs</td>
                    <td>{$deudor['totalPagar']} Bs</td>
                    <td>{$deudor['metodoPago']}</td>
                    <td>{$deudor['fechaRegistro']}</td>
                  </tr>";
        }

        $html .= "</table>";

        // Inicializar Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Mostrar el PDF en el navegador
        $dompdf->stream("reporte_deudores.pdf", ["Attachment" => 0]);
    }





    // Generar HTML para el total de la deuda por cliente
    private function generarHtmlDeudaPorCliente()
    {
        $db = \Config\Database::connect();

        // Consulta para obtener la deuda detallada por cliente
        $query = $db->query("SELECT cliente.id AS cliente_id, cliente.nombre, cliente.apellido, 
                                    confeccion.descripcion AS confeccion, 
                                    confeccion.precio AS precioConfeccion, 
                                    venta.adelanto, 
                                    (confeccion.precio - venta.adelanto) AS deuda
                             FROM venta
                             JOIN cliente ON venta.idCliente = cliente.id
                             JOIN confeccion ON venta.idConfeccion = confeccion.id
                             WHERE venta.estado = 0 AND (confeccion.precio - venta.adelanto) > 0
                             ORDER BY cliente.id");

        // Resultados de la consulta
        $deudas = $query->getResultArray();

        // Generar el HTML para el reporte
        $html = "<h1>Detalle de Deuda por Cliente</h1>";

        // Agrupar deudas por cliente
        $clientes = [];
        foreach ($deudas as $deuda) {
            $clientes[$deuda['cliente_id']]['nombre'] = $deuda['nombre'] . ' ' . $deuda['apellido'];
            $clientes[$deuda['cliente_id']]['deudas'][] = $deuda;
        }

        // Generar la tabla de deuda por cliente
        foreach ($clientes as $cliente_id => $cliente) {
            $html .= "<h2>Cliente: {$cliente['nombre']}</h2>";
            $html .= "<table border='1' cellpadding='10' cellspacing='0' width='100%'>
                        <tr>
                            <th>Confección</th>
                            <th>Precio Confección</th>
                            <th>Adelanto</th>
                            <th>Deuda</th>
                        </tr>";

            $totalDeuda = 0;
            foreach ($cliente['deudas'] as $deuda) {
                $totalDeuda += $deuda['deuda'];
                $html .= "<tr>
                            <td>{$deuda['confeccion']}</td>
                            <td>{$deuda['precioConfeccion']} Bs</td>
                            <td>{$deuda['adelanto']} Bs</td>
                            <td>{$deuda['deuda']} Bs</td>
                          </tr>";
            }

            $html .= "<tr>
                        <td colspan='3'><strong>Total Deuda</strong></td>
                        <td><strong>{$totalDeuda} Bs</strong></td>
                      </tr>";
            $html .= "</table><br>";
        }

        return $html;
    }

    // Exportar PDF para el reporte detallado de deuda por cliente
    public function exportarPDFDeudaPorCliente()
    {
        // Generar el HTML para el reporte de deuda por cliente
        $html = $this->generarHtmlDeudaPorCliente();

        // Inicializar Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Mostrar el PDF en el navegador
        $dompdf->stream("reporte_deuda_detallado_por_cliente.pdf", ["Attachment" => 0]);
    }


    // Generar HTML para trabajos pendientes
    private function generarHtmlTrabajosPendientes()
    {
        $db = \Config\Database::connect();

        // Consulta para obtener los trabajos pendientes junto con el cálculo del total a pagar
        $query = $db->query("SELECT venta.id AS idVenta, cliente.nombre, cliente.apellido, 
                                    confeccion.descripcion AS descripcionConfeccion,
                                    confeccion.precio AS precioConfeccion, 
                                    venta.adelanto, 
                                    (confeccion.precio - venta.adelanto) AS totalPagar, 
                                    venta.fechaRegistro
                             FROM venta
                             JOIN cliente ON venta.idCliente = cliente.id
                             JOIN confeccion ON venta.idConfeccion = confeccion.id
                             WHERE venta.estado = 0");

        $trabajosPendientes = $query->getResultArray();

        // Generar HTML para el reporte de trabajos pendientes
        $html = "<h1>Trabajos Pendientes</h1>";
        $html .= "<table border='1' cellpadding='10' cellspacing='0' width='100%'>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Descripción</th>
                        <th>Adelanto</th>
                        <th>Total a Pagar</th>
                        <th>Estado</th>
                        <th>Fecha de Registro</th>
                    </tr>";

        // Llenar la tabla con los trabajos pendientes
        foreach ($trabajosPendientes as $trabajo) {
            $html .= "<tr>
                        <td>{$trabajo['idVenta']}</td>
                        <td>{$trabajo['nombre']} {$trabajo['apellido']}</td>
                        <td>{$trabajo['descripcionConfeccion']}</td>
                        <td>{$trabajo['adelanto']} Bs</td>
                        <td>{$trabajo['totalPagar']} Bs</td>
                        <td>Pendiente</td>
                        <td>{$trabajo['fechaRegistro']}</td>
                      </tr>";
        }

        $html .= "</table>";
        return $html;
    }


    // Generar HTML para ventas por fecha
    public function generarHtmlVentasPorFecha()
    {
        $db = \Config\Database::connect();

        // Validar si los parámetros GET existen
        $fechaInicio = $this->request->getGet('fechaInicio');
        $fechaFin = $this->request->getGet('fechaFin');

        if (!$fechaInicio || !$fechaFin) {
            return redirect()->back()->with('error', 'Debe seleccionar un rango de fechas válido.');
        }

        $query = $db->query("SELECT venta.*, cliente.nombre, cliente.apellido, confeccion.descripcion
                             FROM venta
                             JOIN cliente ON venta.idCliente = cliente.id
                             JOIN confeccion ON venta.idConfeccion = confeccion.id
                             WHERE venta.fechaRegistro BETWEEN '$fechaInicio' AND '$fechaFin'");

        $ventas = $query->getResultArray();

        $html = "<h1>Ventas del $fechaInicio al $fechaFin</h1>";
        $html .= "<table border='1' cellpadding='10' cellspacing='0' width='100%'>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Descripción</th>
                        <th>Adelanto</th>
                        <th>Total a Pagar</th>
                        <th>Estado</th>
                        <th>Fecha Registro</th>
                        <th>Fecha Entrega</th>
                    </tr>";

        foreach ($ventas as $venta) {
            // Asegurar que totalPagar tiene un valor
            $totalPagar = isset($venta['totalPagar']) ? $venta['totalPagar'] : 0;
            $estadoTexto = $venta['estado'] == 1 ? 'Completado' : 'Pendiente';
            $html .= "<tr>
                                    <td>{$venta['idVenta']}</td>
                                    <td>{$venta['nombre']} {$venta['apellido']}</td>
                                    <td>{$venta['descripcion']}</td>
                                    <td>{$venta['adelanto']} Bs</td>
                                    <td>{$totalPagar} Bs</td>
                                    <td>{$estadoTexto}</td>
                                    <td>{$venta['fechaRegistro']}</td>
                                    <td>{$venta['fechaEntrega']}</td>
                                  </tr>";
        }



        $html .= "</table>";

        // Inicializar Dompdf y generar el PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream("reporte_ventas_por_fecha.pdf", ["Attachment" => 0]);
    }


}