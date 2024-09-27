<?= $cabecera ?>

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

            <form method="post" action="<?= site_url('/actualizar') ?>" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $cliente['id'] ?>">


                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" value="<?= $cliente['nombre'] ?>" class="form-control" type="text" name="nombre">
                </div>

                <div class="form-group">
                    <label for="apellido">Primer Apellido:</label>
                    <input id="apellido" value="<?= $cliente['apellido'] ?>" class="form-control" type="text"
                        name="apellido">
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select id="sexo" class="form-control" name="sexo" required>
                        <option value="M" <?= ($cliente['sexo'] === 'M') ? 'selected' : '' ?>>Masculino</option>
                        <option value="F" <?= ($cliente['sexo'] === 'F') ? 'selected' : '' ?>>Femenino</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input id="celular" value="<?= $cliente['celular'] ?>" class="form-control" type="text"
                        name="celular">
                </div>


                <div class="form-group">
                    <label for="adelanto">Monto Pagado:</label>
                    <input id="adelanto" value="<?= $cliente['adelanto'] ?>" class="form-control" type="text"
                        name="adelanto">
                </div>


                <button id="guardarBtn" class="btn btn-success btn-fw" type="button">Guardar</button>
                <a href="<?= site_url('/cliente') ?>" class="btn btn-danger btn-fw">Cancelar</a>
                
                <div class="form-group">
                    <label for="fechaActualizacion"></label>
                    <input id="fechaActualizacion" class="form-control" type="text" name="fechaRegistro"
                        value="<?= date('Y-m-d H:i:s'); ?>" hidden>
                </div>

                


            
            </form>

            </p>
        </div>
    </div>
</div>



<?= $pie ?>