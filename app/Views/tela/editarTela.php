<?= $cabecera ?>

<?php if (session('mensaje')): ?>
    <div class="alert alert-success" role="alert">
        <?= session('mensaje') ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Editar Tela</h5>
        <p class="card-text">
        <form method="post" action="<?= site_url('/telas/actualizar/' . $tela['id']) ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input id="nombre" value="<?= old('nombre', $tela['nombre']) ?>" class="form-control" type="text"
                    name="nombre" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input id="descripcion" value="<?= old('descripcion', $tela['descripcion']) ?>" class="form-control"
                    type="text" name="descripcion" required>
            </div>

            <div class="form-group">
                <label for="calidad">Calidad:</label>
                <select id="calidad" name="calidad" class="form-control" required>
                    <option value="" disabled <?= old('calidad', $tela['calidad']) ? '' : 'selected' ?>>Seleccione una
                        opción</option>
                    <option value="Basico" <?= old('calidad', $tela['calidad']) == 'Basico' ? 'selected' : '' ?>>Básico
                    </option>
                    <option value="Medio" <?= old('calidad', $tela['calidad']) == 'Medio' ? 'selected' : '' ?>>Medio
                    </option>
                    <option value="Bueno" <?= old('calidad', $tela['calidad']) == 'Bueno' ? 'selected' : '' ?>>Bueno
                    </option>
                    <option value="Excelente" <?= old('calidad', $tela['calidad']) == 'Excelente' ? 'selected' : '' ?>>
                        Excelente</option>
                </select>
            </div>

            <div class="form-group">
                <label for="metros">Metros:</label>
                <input id="metros" value="<?= old('metros', $tela['metros']) ?>" class="form-control" type="number"
                    name="metros" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input id="precio" value="<?= old('precio', $tela['precio']) ?>" class="form-control" type="text"
                    name="precio" required>
            </div>

            <div class="form-group">
                <label for="imagenTela">Imagen Tela:</label>
                <input id="imagenTela" class="form-control-file" type="file" name="imagenTela">
                <?php if ($tela['imagenTela']): ?>
                    <img src="<?= base_url('uploads/' . $tela['imagenTela']); ?>" alt="Imagen actual" width="100"
                        class="mt-2">
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="imagenTraje">Imagen Traje:</label>
                <input id="imagenTraje" class="form-control-file" type="file" name="imagenTraje">
                <?php if ($tela['imagenTraje']): ?>
                    <img src="<?= base_url('uploads/' . $tela['imagenTraje']); ?>" alt="Imagen actual" width="100"
                        class="mt-2">
                <?php endif; ?>
            </div>

            <button class="btn btn-primary" type="submit">Actualizar</button>
            <a href="<?= site_url('/telas') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
        </p>
    </div>
</div>

<?= $pie ?>