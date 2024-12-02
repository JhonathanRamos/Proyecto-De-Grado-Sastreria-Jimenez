<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\ReporteModel;
use CodeIgniter\Controller;

class ReportesController extends BaseController
{
    protected $reporteModel;

    public function __construct()
    {
        $this->reporteModel = new ReporteModel();
    }

    // Muestra la vista de los reportes
    public function index()
    {
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');
        return view('reportes/reportes', $data);
    }

    public function reporte1()
    {

        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');
        $data['telaConMasReservas'] = $this->reporteModel->telaConMasReservas();
        return view('reportes/reporte1', $data);
    }

    public function reporte2()
    {
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');
        
        // Obtener ventas por cliente
        $data['ventasPorCliente'] = $this->reporteModel->ventasPorCliente();
        
        return view('reportes/reporte2', $data);
    }

    public function reporte3()
    {
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');
        
        // Obtener detalles de ventas
        $data['detallesVentas'] = $this->reporteModel->detallesDeVentas();
        
        return view('reportes/reporte3', $data);
    }

    public function reporte4()
    {
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');
        
        // Obtener ventas por método de pago
        $data['ventasPorMetodo'] = $this->reporteModel->ventasPorMetodoDePago();
        
        return view('reportes/reporte4', $data);
    }
    public function reporte5()
    {
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');
        
        // Obtener análisis de confecciones
        $data['confecciones'] = $this->reporteModel->confeccionesMasSolicitadas();
        
        return view('reportes/reporte5', $data);
    }

    public function exportarPDF($tipo)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        
        $dompdf = new Dompdf($options);
        
        // Seleccionar datos según el tipo de reporte
        switch ($tipo) {
            case 'telas':
                $data['items'] = $this->reporteModel->telaConMasReservas();
                $html = view('reportes/pdf/telas_pdf', $data);
                $titulo = 'Reporte_Telas_' . date('Y-m-d');
                break;
            case 'ventas':
                $data['items'] = $this->reporteModel->ventasPorCliente();
                $html = view('reportes/pdf/ventas_pdf', $data);
                $titulo = 'Reporte_Ventas_' . date('Y-m-d');
                break;
            // [Otros casos según necesidad]
            default:
                return redirect()->back()->with('error', 'Tipo de reporte no válido');
        }

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($titulo . ".pdf", ["Attachment" => 0]);
    }
}