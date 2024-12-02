<?= $cabeceraEditar ?>

<?php if (session('mensaje')) { ?>

    <div class="alert alert-danger" role="alert">
        <?php
        echo session('mensaje')
            ?>
    </div>

<?php } ?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Modificar Datos del Cliente</h2>
            <p class="card-text">

            <form action="<?= base_url('/usuarios/actualizar') ?>" method="post">
                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                <div class="form-group">
                    <label for="nombres">Nombres</label>
                    <input type="text" name="nombres" class="form-control" value="<?= $usuario['nombres'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" value="<?= $usuario['apellidos'] ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="<?= $usuario['email'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="text" name="celular" class="form-control" value="<?= $usuario['celular'] ?>" required>
                </div>

              
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="1" <?= $usuario['estado'] == 1 ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $usuario['estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <a href="<?= base_url('/usuarios') ?>" class="btn btn-secondary">Cancelar</a>
            </form>




            </p>
        </div>
    </div>
</div>



<?= $pie ?>