<?=$cabecera?>

<?php if(session('mensaje')){?>

<div class="alert alert-danger" role="alert">
<?php
echo session('mensaje')
?>
</div>

<?php } ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ingresar Datos del Cliente</h5>
        <p class="card-text">
            <form method="post" action="<?=site_url('/guardar')?>" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" value="<?=old('nombre')?>"  class="form-control" type="text" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input id="apellido"  value="<?=old('apellido')?>"  class="form-control" type="text" name="apellido" required>
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
                    <input id="celular"  value="<?=old('celular')?>"  class="form-control" type="text" name="celular" required>
                </div>



                <div class="form-group">
                    <label for="adelanto">Monto adelanto:</label>
                    <input id="adelanto" value="<?=old('adelanto')?>"  class="form-control" type="text" name="adelanto">
                </div>

                <div class="form-group">
                    <label for="fechaRegistro">Fecha de Registro:</label>
                    <input id="fechaRegistro" class="form-control" type="text" name="fechaRegistro" value="<?= date('Y-m-d H:i:s'); ?>" disabled>
                </div>


                <button id="guardarBtnUsuario" class="btn btn-success" type="button">Guardar</button>
                <a href="<?=site_url('/cliente')?>" class="btn btn-danger">Cancelar</a>
            </form>

        </p>
    </div>
</div>



<?=$pie?>

