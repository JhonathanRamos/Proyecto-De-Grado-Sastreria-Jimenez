<?= $cabeceraEditar ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Editar Venta</h3>
            <p class="card-text">
            <form method="post" action="<?= site_url('ventas/actualizarVenta/' . $venta['idVenta']) ?>"
                enctype="multipart/form-data">

                <!-- Campo para Cliente -->
                <div class="form-group">
                    <label for="idCliente">Cliente:</label>
                    <select id="idCliente" class="form-control" name="idCliente" required>
                        <option value="">Seleccione un cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= esc($cliente['id']); ?>" <?= $cliente['id'] == $venta['idCliente'] ? 'selected' : '' ?>>
                                <?= esc($cliente['nombre']) . ' ' . esc($cliente['apellido']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para Confección -->
                <div class="form-group">
                    <label for="idConfeccion">Confección:</label>
                    <select id="idConfeccion" class="form-control" name="idConfeccion" required>
                        <?php foreach ($confecciones as $confeccion): ?>
                            <option value="<?= esc($confeccion['id']); ?>" <?= $confeccion['id'] == $venta['idConfeccion'] ? 'selected' : '' ?>>
                                <?= esc($confeccion['descripcion']); ?> (<?= esc($confeccion['precio']) . ' Bs'; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para Adelanto -->
                <div class="form-group">
                    <label for="adelanto">Adelanto:</label>
                    <input id="adelanto" value="<?= isset($venta['adelanto']) ? esc($venta['adelanto']) : '' ?>"
                        class="form-control" type="number" name="adelanto" required>

                </div>

                <!-- Campo para Fecha de Recolección -->
                <div class="form-group">
                    <label for="fechaRecoleccion">Fecha y Hora de Recolección:</label>
                    <input id="fechaRecoleccion"
                        value="<?= esc(date('Y-m-d\TH:i', strtotime($venta['fechaEntrega']))) ?>" class="form-control"
                        type="datetime-local" name="fechaRecoleccion" required>
                </div>

                <!-- Campo para Estado -->
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" class="form-control" name="estado" required>
                        <option value="1" <?= $venta['estado'] == 1 ? 'selected' : '' ?>>Completado</option>
                        <option value="0" <?= $venta['estado'] == 0 ? 'selected' : '' ?>>Pendiente</option>
                    </select>
                </div>

                <button class="btn btn-success btn-fw" type="submit">Actualizar</button>
                <a href="<?= site_url('/venta') ?>" class="btn btn-danger btn-fw">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?= $pie ?>