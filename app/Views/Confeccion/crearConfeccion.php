<?= $cabecera ?>

<?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
        <?= session('mensaje'); ?>
    </div>
<?php } ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Ingresar Detalles de Confección</h3>
            <p class="card-text">
            <form method="post" action="<?= site_url('/confeccion/guardar') ?>" enctype="multipart/form-data">
                <!-- Cambié la acción para que use la URL correcta -->

                <!-- Campo para Descripción (Entrada libre) -->
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input id="descripcion" value="<?= old('descripcion') ?>" class="form-control" type="text"
                        name="descripcion" placeholder="Ingrese descripción" required>
                </div>

                <!-- Campo para Precio (Entrada libre) -->
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input id="precio" value="<?= old('precio') ?>" class="form-control" type="text" name="precio"
                        placeholder="Ingrese precio" required>
                </div>

                <!-- Campo para Unidad de Medida  -->
                <div class="form-group">
                    <label for="unidadMedida">Unidad de Medida:</label>
                    <select id="unidadMedida" class="form-control" name="unidadMedida" required>
                        <option value="Confeccion" <?= old('unidadMedida') == 'Confeccion' ? 'selected' : '' ?>>Confección</option>
                        <option value="Arreglo" <?= old('unidadMedida') == 'Arreglo' ? 'selected' : '' ?>>Arreglo</option>
                    </select>
                </div>

                <!-- Botones de Guardar/Cancelar -->
                <button id="guardarBtnConfeccion" class="btn btn-success btn-fw" type="submit">Guardar</button>
                <!-- Cambié la URL del botón de Cancelar para redirigir a la lista de confecciones -->
                <a href="<?= site_url('/confeccion') ?>" class="btn btn-danger btn-fw">Cancelar</a>
            </form>
            </p>
        </div>
    </div>
</div>

<?= $pie ?>
