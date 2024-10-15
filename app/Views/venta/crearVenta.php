<?= $cabecera ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Registrar Nueva Venta</h3>
            <p class="card-text">
            <form method="post" action="<?= site_url('/guardarVenta') ?>" enctype="multipart/form-data">

                <!-- Campo para Cliente (Seleccionar cliente de la lista) -->
                <div class="form-group">
                    <label for="idCliente">Cliente:</label>
                    <select id="idCliente" class="form-control" name="idCliente" required>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['id']; ?>">
                                <?= $cliente['nombre'] . ' ' . $cliente['apellido']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para Confección (Seleccionar confección relacionada) -->
                <div class="form-group">
                    <label for="idConfeccion">Confección:</label>
                    <select id="idConfeccion" class="form-control" name="idConfeccion" required>
                        <?php foreach ($confecciones as $confeccion): ?>
                            <option value="<?= $confeccion['id']; ?>">
                                <?= $confeccion['descripcion']; ?> (<?= $confeccion['precio'] . ' Bs'; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para Adelanto (Cuánto adelanta el cliente) -->
                <div class="form-group">
                    <label for="adelanto">Adelanto:</label>
                    <input id="adelanto" value="<?= old('adelanto') ?>" class="form-control" type="number"
                        name="adelanto" placeholder="Ingrese el adelanto" required>
                </div>

                <!-- Campo para Fecha de Recolección -->
                <div class="form-group">
                    <label for="fechaRecoleccion">Fecha de Recolección:</label>
                    <input id="fechaRecoleccion" value="<?= old('fechaRecoleccion') ?>" class="form-control" type="date"
                        name="fechaRecoleccion" required>
                </div>

                <!-- Campo para Estado (Estado de la venta) -->
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" class="form-control" name="estado" required>
                        <option value="1">Pendiente</option>
                        <option value="0">Completado</option>
                    </select>
                </div>

                <!-- Botones de Guardar/Cancelar -->
                <button id="guardarBtnVenta" class="btn btn-success btn-fw" type="submit">Guardar</button>
                <a href="<?= site_url('/ventas') ?>" class="btn btn-danger btn-fw">Cancelar</a>
            </form>
            </p>
        </div>
    </div>
</div>

<?= $pie ?>
