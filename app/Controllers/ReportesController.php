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


    // Generar HTML para el estado de clientes
    private function generarHtmlEstadoClientes($estado)
    {
        $clienteModel = new Cliente();

        // Filtrar clientes por estado
        $clientes = ($estado === 'activos')
            ? $clienteModel->where('estado', 1)->findAll()
            : $clienteModel->where('estado', 0)->findAll();

        // Título del reporte
        $titulo = $estado === 'activos' ? "Clientes Activos" : "Clientes Inactivos";

        // Generar el HTML
        $html = "<h1>$titulo</h1>";
        $html .= "<table border='1' cellpadding='10' cellspacing='0' width='100%'>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Sexo</th> <!-- Nueva columna -->
                        <th>Celular</th>
                        <th>Estado</th>
                        <th>Fecha de Registro</th>
                    </tr>";

        foreach ($clientes as $cliente) {
            $estadoTexto = $cliente['estado'] == 1 ? 'Activo' : 'Inactivo';
            $sexoTexto = $cliente['sexo'] == 'M' ? 'Masculino' : 'Femenino'; // Asumiendo que 'M' y 'F' son los valores en la DB
            $html .= "<tr>
                        <td>{$cliente['id']}</td>
                        <td>{$cliente['nombre']}</td>
                        <td>{$cliente['apellido']}</td>
                        <td>{$sexoTexto}</td> <!-- Mostrar el sexo del cliente -->
                        <td>{$cliente['celular']}</td>
                        <td>{$estadoTexto}</td>
                        <td>{$cliente['fechaRegistro']}</td>
                      </tr>";
        }

        $html .= "</table>";
        return $html;
    }



    // Generar HTML para deudores
    // Generar HTML para deudores
    // Generar HTML para deudores
    private function generarHtmlDeudores()
    {
        $db = \Config\Database::connect();

        // Ajustar la consulta para que el total a pagar sea la diferencia entre precio y adelanto
        $query = $db->query("SELECT venta.idVenta AS idVenta, cliente.nombre, cliente.apellido, 
                                venta.adelanto, (confeccion.precio - venta.adelanto) AS totalPagar, 
                                venta.metodo_pago, venta.fechaRegistro
                         FROM venta
                         JOIN cliente ON venta.idCliente = cliente.id
                         JOIN confeccion ON venta.idConfeccion = confeccion.id
                         WHERE venta.estado = 0 AND (confeccion.precio - venta.adelanto) > 0");

        // Resultados de la consulta
        $ventas = $query->getResultArray();

        // Inicio del HTML
        $html = "<h1>Deudores</h1>";
        $html .= "<table border='1' cellpadding='10' cellspacing='0' width='100%'>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Adelanto</th>
                    <th>Total a Pagar</th>
                    <th>Método de Pago</th>
                    <th>Fecha Registro</th>
                </tr>";

        // Recorrer las ventas para generar las filas de la tabla
        foreach ($ventas as $venta) {
            $html .= "<tr>
                    <td>{$venta['idVenta']}</td>
                    <td>{$venta['nombre']} {$venta['apellido']}</td>
                    <td>{$venta['adelanto']} Bs</td>
                    <td>{$venta['totalPagar']} Bs</td>
                    <td>{$venta['metodo_pago']}</td>
                    <td>{$venta['fechaRegistro']}</td>
                  </tr>";
        }

        $html .= "</table>";
        return $html;
    }

    public function exportarPDFDeudores()
    {
        // Generar el HTML para el reporte de deudores
        $html = $this->generarHtmlDeudores();

        // Inicializar Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Mostrar el PDF en el navegador
        $dompdf->stream("reporte_deudores.pdf", ["Attachment" => 0]); // Abrir en el navegador
    }



    // Generar HTML para el total de la deuda por cliente
    private function generarHtmlDeudaPorCliente()
    {
        $db = \Config\Database::connect();

        // Consulta para obtener el total de la deuda por cliente
        $query = $db->query("SELECT cliente.id, cliente.nombre, cliente.apellido, 
                                SUM(confeccion.precio - venta.adelanto) AS totalDeuda
                         FROM venta
                         JOIN cliente ON venta.idCliente = cliente.id
                         JOIN confeccion ON venta.idConfeccion = confeccion.id
                         WHERE venta.estado = 0
                         GROUP BY cliente.id
                         HAVING totalDeuda > 0");  // Solo mostrar clientes con deuda pendiente

        // Resultados de la consulta
        $clientes = $query->getResultArray();

        // Generar el HTML
        $html = "<h1>Total de Deuda por Cliente</h1>";
        $html .= "<table border='1' cellpadding='10' cellspacing='0' width='100%'>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Total Deuda</th>
                </tr>";

        foreach ($clientes as $cliente) {
            $html .= "<tr>
                    <td>{$cliente['id']}</td>
                    <td>{$cliente['nombre']} {$cliente['apellido']}</td>
                    <td>{$cliente['totalDeuda']} Bs</td>
                  </tr>";
        }

        $html .= "</table>";
        return $html;
    }

    // Exportar PDF para el total de deuda por cliente
    public function exportarPDFDeudaPorCliente()
    {
        // Generar el HTML para el reporte de deuda por cliente
        $html = $this->generarHtmlDeudaPorCliente();

         // Inicializar Dompdf
         $dompdf = new Dompdf();
         $dompdf->loadHtml($html);
         $dompdf->setPaper('A4', 'landscape');
         $dompdf->render();
 
         // Mostrar el PDF en el navegador
         $dompdf->stream("reporte_deudores.pdf", ["Attachment" => 0]); // Abrir en el navegador
    }


    // Generar HTML para trabajos pendientes
    private function generarHtmlTrabajosPendientes()
    {
        $db = \Config\Database::connect();

        $query = $db->query("SELECT venta.*, cliente.nombre, cliente.apellido, confeccion.descripcion
                             FROM venta
                             JOIN cliente ON venta.idCliente = cliente.id
                             JOIN confeccion ON venta.idConfeccion = confeccion.id
                             WHERE venta.estado = 0");

        $trabajosPendientes = $query->getResultArray();

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

        foreach ($trabajosPendientes as $trabajo) {
            $html .= "<tr>
                        <td>{$trabajo['id']}</td>
                        <td>{$trabajo['nombre']} {$trabajo['apellido']}</td>
                        <td>{$trabajo['descripcion']}</td>
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
                                    <td>{$venta['fecha']}</td>
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
