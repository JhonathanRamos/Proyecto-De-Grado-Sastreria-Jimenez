<?= $cabecera ?>

<?php if (session('mensaje')) { ?>

    <div class="alert alert-danger" role="alert">
        <?php
        echo session('mensaje')
            ?>
    </div>

<?php } ?>

 <div class="col-12 grid-margin stretch-card">
<div class="card">
    <div class="card-body">
        <h3 class="card-title">INGRESAR DATOS DEL CLIENTE</h3>
        <p class="card-text">
        <form method="post" action="<?= site_url('/guardar') ?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input id="nombre" value="<?= old('nombre') ?>" class="form-control" type="text" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input id="apellido" value="<?= old('apellido') ?>" class="form-control" type="text" name="apellido"
                    required>
            </div>


            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select id="sexo" class="form-control" name="sexo" required>
                    <option value="M" <?= (old('sexo') === 'M') ? 'selected' : '' ?>>Masculino</option>
                    <option value="F" <?= (old('sexo') === 'F') ? 'selected' : '' ?>>Femenino</option>
                </select>
            </div>


            <div class="form-group">
                <label for="celular">Celular:</label>
                <input id="celular" value="<?= old('celular') ?>" class="form-control" type="text" name="celular"
                    required>
            </div>



<<<<<<< HEAD
            <div class="form-group">
                <label for="adelanto">Monto Pagado:</label>
                <input id="adelanto" value="<?= old('adelanto') ?>" class="form-control" type="text" name="adelanto">
            </div>
=======
                <div class="form-group">
                    <label for="adelanto">Monto adelanto:</label>
                    <input id="adelanto" value="<?=old('adelanto')?>"  class="form-control" type="text" name="adelanto">
                </div>
>>>>>>> 760834dfa50c831261f243373babb7b1e6ba6154

            <div class="form-group">
                
                <input id="fechaRegistro" class="form-control" type="text" name="fechaRegistro"
                    value="<?= date('Y-m-d H:i:s'); ?>"  hidden>
            </div>


            <button id="guardarBtnUsuario" class="btn btn-success btn-fw" type="button">Guardar</button>
            <a href="<?= site_url('/cliente') ?>" class="btn btn-danger btn-fw">Cancelar</a>
        </form>

        </p>
    </div>
</div>
</div>




<?= $pie ?>