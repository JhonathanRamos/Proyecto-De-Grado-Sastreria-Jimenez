<?= $cabecera ?>

<?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
        <?= session('mensaje') ?>
    </div>
<?php } ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">INGRESAR DATOS DEL USUARIO</h3>
            <p class="card-text">
            <form method="post" action="<?= site_url('/guardarUsuario') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input id="nombres" value="<?= old('nombres') ?>" class="form-control" type="text" name="nombres" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input id="apellidos" value="<?= old('apellidos') ?>" class="form-control" type="text" name="apellidos" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input id="email" value="<?= old('email') ?>" class="form-control" type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input id="celular" value="<?= old('celular') ?>" class="form-control" type="text" name="celular" required>
                </div>

                <!-- Asignación automática del rol de Cliente (sin opción de seleccionar rol) -->

                <button id="guardarBtnUsuario" class="btn btn-success btn-fw" type="submit">Guardar</button>
                <a href="<?= site_url('/usuarios') ?>" class="btn btn-danger btn-fw">Cancelar</a>
            </form>
            </p>
        </div>
    </div>
</div>

<?= $pie ?>
