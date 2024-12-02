<?= $cabeceraEditar ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Detalles de la Venta</h1>

            <!-- Información principal de la venta -->
            <div class="mb-4">
                <h4>Información General</h4>
                <p><strong>ID Venta:</strong> <?= esc($venta['idVenta']); ?></p>
                <p><strong>Cliente:</strong> <?= esc($venta['cliente_nombre'] . ' ' . $venta['cliente_apellido']); ?>
                </p>
                <p><strong>Fecha de Registro:</strong> <?= esc($venta['fechaRegistro']); ?></p>
                <p><strong>Total:</strong> <?= esc($venta['total']) . ' Bs'; ?></p>
                <p><strong>Método de Pago:</strong> <?= esc($venta['metodoPago']); ?></p>
                <p><strong>Estado:</strong> <?= ($venta['estado'] == 1) ? 'Activo' : 'Cancelado'; ?></p>
            </div>

            <!-- Tabla de Detalles de la Venta -->
            <div class="table-responsive">
                <h4>Detalles de la Venta</h4>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Confección (Categoría)</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Tela (Metros)</th>
                            <th>Subtotal</th>
                            <th>Descuento</th>
                            <th>Adelanto</th>
                            <th>Total a Pagar</th>
                            <th>Fecha de Entrega</th>
                            <th>Fecha de Prueba</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalles as $index => $detalle): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td>
                                    <?= esc($detalle['confeccion']); ?>
                                    (<?= esc($detalle['categoria']); ?>)
                                </td>
                                <td><?= esc($detalle['cantidad']); ?></td>
                                <td><?= esc($detalle['precio_unitario']) . ' Bs'; ?></td>
                                <td>
                                    <?= $detalle['idTela'] ? esc($detalle['metros']) . ' metros' : 'No uso de tela'; ?>
                                </td>
                                <td><?= esc($detalle['subtotal']) . ' Bs'; ?></td>
                                <td><?= esc($detalle['descuento']) . ' Bs'; ?></td>
                                <td><?= esc($detalle['adelanto']) . ' Bs'; ?></td>
                                <td><?= esc($detalle['restante']) . ' Bs'; ?></td>
                                <td><?= esc($detalle['fechaEntrega']); ?></td>
                                <td><?= esc($detalle['fechaPrueba'] ?: 'N/A'); ?></td>
                                <td>
                                    <!-- Botón para pagar o mostrar "Pagado" -->
                                    <?php if ($detalle['restante'] > 0): ?>
                                        <form method="post" action="<?= site_url('/ventas/confirmarPago') ?>">
                                            <input type="hidden" name="idDetalle" value="<?= $detalle['idDetalleVenta']; ?>">
                                            <input type="hidden" name="restante" value="<?= $detalle['restante']; ?>">
                                            <button type="submit" class="btn btn-success">
                                                Pagar <?= esc($detalle['restante']) . ' Bs'; ?>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-success">Pagado</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

            <!-- Botón para volver -->
            <div class="mt-4">
                <a href="<?= site_url('/venta') ?>" class="btn btn-primary">Volver a Ventas</a>
            </div>
        </div>
    </div>
</div>

<?= $pie ?>