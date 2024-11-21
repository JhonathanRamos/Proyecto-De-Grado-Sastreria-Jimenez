<?php

namespace App\Controllers;

use App\Models\Detalle_Venta;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Confeccion;
use App\Models\Tela;

class Ventas extends BaseController
{
    protected $detalleVentaModel;
    protected $ventaModel;
    protected $clienteModel;
    protected $confeccionModel;
    protected $telaModel;

    public function __construct()
    {
        $this->detalleVentaModel = new Detalle_Venta();
        $this->ventaModel = new Venta();
        $this->clienteModel = new Cliente();
        $this->confeccionModel = new Confeccion();
        $this->telaModel = new Tela();
        helper(['form', 'url']);
    }

    /**
     * Muestra el formulario para crear una nueva venta
     */
    public function crear()
    {
        $data['clientes'] = $this->clienteModel->findAll();
        $data['confecciones'] = $this->confeccionModel->findAll();
        $data['telas'] = $this->telaModel->findAll();
        $data['cabecera'] = view('template/cabecera');
        $data['pie'] = view('template/piepagina');

        return view('venta/crearVenta', $data);
    }



    /**
     * Guarda una nueva venta con múltiples detalles
     */
    public function guardarVenta()
    {
        // Validar datos principales
        $validation = $this->validate([
            'idCliente' => 'required|integer',
            'detalles' => 'required'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        // Decodificar los detalles enviados desde el formulario
        $detalles = $this->request->getPost('detalles');
        if (is_string($detalles)) {
            $detalles = json_decode($detalles, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()->withInput()->with('error', 'El campo detalles contiene un JSON inválido.');
            }
        }

        if (empty($detalles)) {
            return redirect()->back()->withInput()->with('error', 'No se encontraron detalles de la venta.');
        }

        // Crear venta principal
        $ventaData = [
            'idCliente' => $this->request->getPost('idCliente'),
            'idUsuario' => session()->get('user_id') ?? 1,
            'total' => 0, // Se calculará después
            'estado' => 1,
            'metodoPago' => $this->request->getPost('metodoPago'),
            'fechaRegistro' => date('Y-m-d H:i:s'),
            'fechaActualizacion' => date('Y-m-d H:i:s'),
        ];

        $idVenta = $this->ventaModel->insert($ventaData);

        if (!$idVenta) {
            return redirect()->back()->withInput()->with('error', 'Error al guardar la venta principal.');
        }

        $totalVenta = 0;

        foreach ($detalles as $detalle) {
            $idConfeccion = $detalle['idConfeccion'] ?? null;
            $confeccion = $this->confeccionModel->find($idConfeccion);

            if (!$confeccion) {
                return redirect()->back()->withInput()->with('error', 'Confección no válida en uno de los detalles.');
            }

            $subtotal = (float) ($detalle['subtotal'] ?? 0);
            $adelanto = (float) ($detalle['adelanto'] ?? 0);
            $descuento = (float) ($detalle['descuento'] ?? 0);
            $metrosTela = (float) ($detalle['metrosTela'] ?? 0);
            $precioTela = (float) ($detalle['precio_tela'] ?? 0);

            // Calcular costo de la tela
            $costoTela = $metrosTela * $precioTela;

            // Actualizar subtotal con el costo de la tela
            $subtotal += $costoTela;

            // Aplicar descuento
            $subtotalConDescuento = $subtotal - $descuento;

            // Calcular restante
            $restante = $subtotalConDescuento - $adelanto;

            $detalleData = [
                'idVenta' => $idVenta,
                'idConfeccion' => $idConfeccion,
                'idTela' => $detalle['idTela'] ?? null,
                'cantidad' => $detalle['cantidad'] ?? 1,
                'precio_unitario' => $detalle['precio_unitario'] ?? 0,
                'metrosTela' => $metrosTela,
                'subtotal' => $subtotal,
                'descuento' => $descuento,
                'adelanto' => $adelanto,
                'restante' => $restante,
                'fechaPrueba' => $detalle['fechaPrueba'] ?? null,
                'fechaEntrega' => $detalle['fechaEntrega'] ?? null,
            ];

            if (!$this->detalleVentaModel->insert($detalleData)) {
                return redirect()->back()->withInput()->with('error', 'Error al guardar un detalle de la venta.');
            }

            $totalVenta += $subtotalConDescuento;
        }

        // Actualizar el total de la venta
        $this->ventaModel->update($idVenta, ['total' => $totalVenta]);

        return redirect()->to('/venta')->with('success', 'Venta registrada correctamente.');
    }

    public function index()
    {
        // Configuración para la búsqueda
        $search = $this->request->getGet('search'); // Obtener el término de búsqueda
        $perPage = 10; // Número de ventas por página

        // Consulta base para obtener las ventas activas
        $builder = $this->ventaModel->where('estado', 1);

        // Si hay búsqueda, aplicarla al nombre o apellido del cliente
        if (!empty($search)) {
            $builder = $builder->join('clientes', 'clientes.id = ventas.idCliente')
                ->like('clientes.nombre', $search)
                ->orLike('clientes.apellido', $search);
        }

        // Obtener ventas paginadas
        $ventas = $builder->paginate($perPage);
        $paginacion = $this->ventaModel->pager;

        // Preparar los datos de los clientes y cálculos adicionales
        foreach ($ventas as &$venta) {
            $venta['cliente'] = $this->clienteModel->find($venta['idCliente']);
            $totalPagado = $this->detalleVentaModel
                ->where('idVenta', $venta['idVenta'])
                ->selectSum('adelanto')
                ->get()
                ->getRow()
                ->adelanto ?? 0;
            $venta['faltante'] = max(0, $venta['total'] - $totalPagado);
        }

        $data = [
            'ventas' => $ventas,
            'search' => $search,
            'paginacion' => $paginacion,
            'cabecera' => view('template/cabecera'),
            'pie' => view('template/piepagina'),
        ];

        return view('venta/venta', $data);
    }






    public function editar($idVenta)
    {
        $venta = $this->ventaModel->find($idVenta);
        if (!$venta) {
            return redirect()->to('/venta')->with('error', 'Venta no encontrada.');
        }

        $clientes = $this->clienteModel->findAll();

        $data = [
            'venta' => $venta,
            'clientes' => $clientes,
            'cabecera' => view('template/cabecera'),
            'pie' => view('template/piepagina'),
        ];

        return view('venta/editar', $data);
    }

    // public function cancelarVenta($idVenta)
    // {
    //     $this->ventaModel->update($idVenta, ['estado' => 0]);
    //     return redirect()->to('/venta')->with('success', 'Venta cancelada correctamente.');
    // }

    public function realizarVenta($idVenta)
    {
        $this->ventaModel->update($idVenta, ['estado' => 2]);
        return redirect()->to('/venta')->with('success', 'Venta marcada como realizada.');
    }


    public function borrar($idVenta)
    {
        // Verificar si la venta existe
        $venta = $this->ventaModel->find($idVenta);

        if (!$venta) {
            return redirect()->to('/venta')->with('error', 'La venta no existe.');
        }

        // Cambiar el estado de la venta a 0
        $this->ventaModel->update($idVenta, ['estado' => 0]);

        return redirect()->to('/venta')->with('success', 'Venta eliminada correctamente.');
    }


    public function ver($idVenta)
    {
        $venta = $this->ventaModel
            ->select('venta.*, cliente.nombre as cliente_nombre, cliente.apellido as cliente_apellido')
            ->join('cliente', 'cliente.id = venta.idCliente')
            ->where('venta.idVenta', $idVenta)
            ->first();

        if (!$venta) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("La venta con ID $idVenta no fue encontrada.");
        }

        $detalles = $this->detalleVentaModel
            ->select('detalle_venta.*, confeccion.descripcion as confeccion, confeccion.categoria, 
                      tela.nombre as tela, tela.precio as precio_tela, detalle_venta.metrosTela as metros')
            ->join('confeccion', 'confeccion.id = detalle_venta.idConfeccion', 'left')
            ->join('tela', 'tela.id = detalle_venta.idTela', 'left')
            ->where('detalle_venta.idVenta', $idVenta)
            ->findAll();

        foreach ($detalles as &$detalle) {
            $detalle['tela'] = $detalle['tela'] ?? 'No uso de tela';
            $detalle['precio_tela'] = $detalle['precio_tela'] ?? 0;
            $detalle['metros'] = $detalle['metros'] ?? 0;
        }

        $data = [
            'cabecera' => view('template/cabecera'),
            'pie' => view('template/piepagina'),
            'venta' => $venta,
            'detalles' => $detalles,
        ];

        return view('venta/verVenta', $data);
    }


    // Método para confirmar el pago completo
    public function confirmarPago()
    {
        $idDetalle = $this->request->getPost('idDetalle');
        $restante = (float) $this->request->getPost('restante');

        if ($idDetalle && $restante > 0) {
            // Actualizar el detalle de la venta
            $actualizado = $this->detalleVentaModel->update($idDetalle, ['restante' => 0]);

            if ($actualizado) {
                // Obtener el ID de la venta relacionada con este detalle
                $detalle = $this->detalleVentaModel->find($idDetalle);
                $idVenta = $detalle['idVenta'];

                // Verificar si todos los detalles de la venta están pagados
                $detallesPendientes = $this->detalleVentaModel
                    ->where('idVenta', $idVenta)
                    ->where('restante >', 0)
                    ->countAllResults();

                if ($detallesPendientes === 0) {
                    // Actualizar el estado de la venta a 2 (completado)
                    $this->ventaModel->update($idVenta, ['estado' => 2]);
                }

                return redirect()->back()->with('success', 'Pago confirmado correctamente.');
            } else {
                return redirect()->back()->with('error', 'No se pudo actualizar el pago.');
            }
        }

        return redirect()->back()->with('error', 'No se pudo confirmar el pago. Datos inválidos.');
    }









}
