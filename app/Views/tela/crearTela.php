<?=$cabecera?>

<?php if (session('mensaje')): ?>
    <div class="alert alert-danger" role="alert">
        <?= session('mensaje') ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ingresar Tela</h5>
        <p class="card-text">
            <form method="post" action="<?= site_url('/guardarTela') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" value="<?= old('nombre') ?>" class="form-control" type="text" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input id="descripcion" value="<?= old('descripcion') ?>" class="form-control" type="text" name="descripcion" required>
                </div>

                <div class="form-group">
                    <label for="calidad">Calidad:</label>
                    <input id="calidad" value="<?= old('calidad') ?>" class="form-control" type="text" name="calidad" required>
                </div>

                <div class="form-group">
                    <label for="metros">Metros:</label>
                    <input id="metros" value="<?= old('metros') ?>" class="form-control" type="number" name="metros" required>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input id="precio" value="<?= old('precio') ?>" class="form-control" type="text" name="precio" required>
                </div>

                <div class="form-group">
                    <label for="imagenTela">Imagen Tela:</label>
                    <input id="imagenTela" class="form-control-file" type="file" name="imagenTela" required>
                </div>

                <div class="form-group">
                    <label for="imagenTraje">Imagen Traje:</label>
                    <input id="imagenTraje" class="form-control-file" type="file" name="imagenTraje" required>
                </div>

                <button class="btn btn-success" type="submit">Guardar</button>
            </form>
        </p>
    </div>
</div>

<?= $pie ?>
