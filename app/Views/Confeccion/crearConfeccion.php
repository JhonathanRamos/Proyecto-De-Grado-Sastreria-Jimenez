<?= $cabecera ?>

<?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
        <?= session('mensaje'); ?>
    </div>
<?php } ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Ingresar Tipo de Confección</h3>
            <p class="card-text">
                <form method="post" action="<?= site_url('/guardarConfeccion') ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="idCliente">Cliente:</label>
                        <select id="idCliente" name="idCliente" class="form-control" required>
                            <option value="">Seleccione un cliente</option>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?= $cliente['id'] ?>"><?= $cliente['nombre'] . ' ' . $cliente['apellido'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <input id="descripcion" value="<?= old('descripcion') ?>" class="form-control" type="text" name="descripcion" required>
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input id="precio" value="<?= old('precio') ?>" class="form-control" type="text" name="precio" required>
                    </div>

                    <div class="form-group">
                        <label for="unidadMedida">Unidad de Medida:</label>
                        <input id="unidadMedida" value="<?= old('unidadMedida') ?>" class="form-control" type="text" name="unidadMedida" required>
                    </div>

                    <div class="form-group">
                        <label for="adelanto">Adelanto (Opcional):</label>
                        <input id="adelanto" value="<?= old('adelanto') ?>" class="form-control" type="text" name="adelanto">
                    </div>

                    <button id="guardarBtnConfeccion" class="btn btn-success btn-fw" type="submit">Guardar</button>
                    <a href="<?= site_url('/confeccion') ?>" class="btn btn-danger btn-fw">Cancelar</a>
                </form>
            </p>
        </div>
    </div>
</div>

<?= $pie ?>
