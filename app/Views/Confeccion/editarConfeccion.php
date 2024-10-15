<?= $cabecera ?>

<?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo session('mensaje');
        ?>
    </div>
<?php } ?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Modificar Confección</h2>
            <p class="card-text">

            <form method="post" action="<?= site_url('/confeccion/actualizar/' . $confeccion['id']) ?>" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $confeccion['id'] ?>">

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input id="descripcion" value="<?= $confeccion['descripcion'] ?>" class="form-control" type="text" name="descripcion" required>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input id="precio" value="<?= $confeccion['precio'] ?>" class="form-control" type="text" name="precio" required>
                </div>

                <div class="form-group">
                    <label for="unidadMedida">Unidad de Medida:</label>
                    <select id="unidadMedida" class="form-control" name="unidadMedida" required>
                        <option value="Confeccion" <?= ($confeccion['unidadMedida'] === 'Confeccion') ? 'selected' : '' ?>>Confección</option>
                        <option value="Arreglo" <?= ($confeccion['unidadMedida'] === 'Arreglo') ? 'selected' : '' ?>>Arreglo</option>
                    </select>
                </div>

                <button id="guardarBtnConfeccion" class="btn btn-success btn-fw" type="submit">Guardar</button>
                <a href="<?= site_url('/confeccion') ?>" class="btn btn-danger btn-fw">Cancelar</a>

                <div class="form-group">
                    <input id="fechaActualizacion" class="form-control" type="hidden" name="fechaActualizacion"
                        value="<?= date('Y-m-d H:i:s'); ?>">
                </div>
            </form>

            </p>
        </div>
    </div>
</div>

<?= $pie ?>
