<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;

class ReportesController extends BaseController
{
    // Muestra la vista de los reportes
    public function index()
    {
        $data['cabecera'] = view('template/cabecera'); // Asegúrate de que este archivo existe
        $data['pie'] = view('template/piepagina'); // Asegúrate de que este archivo existe

        // Cargar la vista de reportes generales
        return view('reportes/reportes', $data); // Pasar la cabecera y pie de página a la vista
    }


    // Exportar estado de clientes a PDF
    public function exportarPDF($tipoReporte)
    {
        // Aquí puedes obtener los datos para cada tipo de reporte.
        // Puedes hacerlo en base al parámetro $tipoReporte que se recibe
        switch ($tipoReporte) {
            case 'estadoClientes':
                $html = $this->generarHtmlEstadoClientes();
                break;
            case 'deudores':
                $html = $this->generarHtmlDeudores();
                break;
            case 'totalDeuda':
                $html = $this->generarHtmlTotalDeuda();
                break;
            case 'trabajosPendientes':
                $html = $this->generarHtmlTrabajosPendientes();
                break;
            case 'ventasPorFecha':
                $html = $this->generarHtmlVentasPorFecha();
                break;
            default:
                return redirect()->back()->with('error', 'Reporte no válido');
        }

        // Inicializar DOMPDF
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Para cargar recursos externos como imágenes
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Opcionalmente, configurar el tamaño y la orientación de la página
        $dompdf->setPaper('A4', 'landscape'); // Landscape o portrait

        // Renderizar el PDF
        $dompdf->render();

        // Enviar el PDF como descarga
        $dompdf->stream("reporte_$tipoReporte.pdf", ["Attachment" => 1]);
    }

    // Generar el HTML para el estado de clientes
    private function generarHtmlEstadoClientes()
    {
        // Obtener datos desde el modelo (puedes implementar el modelo correspondiente)
        $clientes = []; // Debes reemplazar esto por la lógica de obtención de datos

        // Aquí puedes generar el HTML que quieres que se exporte a PDF
        $html = "<h1>Estado de Clientes</h1>";
        $html .= "<table border='1' cellpadding='10'><tr><th>#</th><th>Nombre</th><th>Estado</th></tr>";
        foreach ($clientes as $cliente) {
            $html .= "<tr><td>{$cliente['id']}</td><td>{$cliente['nombre']}</td><td>{$cliente['estado']}</td></tr>";
        }
        $html .= "</table>";

        return $html;
    }

    // Similarmente, puedes crear otros métodos para generar los otros tipos de reportes
    private function generarHtmlDeudores()
    {
        $html = "<h1>Deudores</h1>";
        // Aquí va la lógica para obtener y mostrar los datos
        return $html;
    }

    private function generarHtmlTotalDeuda()
    {
        $html = "<h1>Total de la Deuda</h1>";
        // Aquí va la lógica para obtener y mostrar los datos
        return $html;
    }

    private function generarHtmlTrabajosPendientes()
    {
        $html = "<h1>Trabajos Pendientes</h1>";
        // Aquí va la lógica para obtener y mostrar los datos
        return $html;
    }

    private function generarHtmlVentasPorFecha()
    {
        $html = "<h1>Ventas por Fecha</h1>";
        // Aquí va la lógica para obtener y mostrar los datos
        return $html;
    }
}
