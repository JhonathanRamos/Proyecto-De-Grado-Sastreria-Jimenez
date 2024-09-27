<?=$cabecera?>

<?php if(session('mensaje')){?>
<div class="alert alert-danger" role="alert">
    <?php echo session('mensaje') ?>
</div>
<?php } ?>

<div class="card">
    <div class="card-body">
    <h2 class="card-title">
    Modificar Datos De La Falda De: <span style="font-weight: bold;"><?=$cliente['nombre'] . ' ' . $cliente['apellido']?></span>
    </h2>

        
        <p class="card-text">
            <form method="post" action="<?=site_url('/actualizarFalda')?>" enctype="multipart/form-data">
                <input type="hidden" name="idCliente" value="<?=$falda['idCliente']?>">

                <div class="form-group">
                    <label for="largo">Largo:</label>
                    <input id="largo" value="<?=old('largo', $falda['largo'])?>" class="form-control" type="text" name="largo" required>
                </div>

                <div class="form-group">
                    <label for="cintura">Cintura:</label>
                    <input id="cintura" value="<?=old('cintura', $falda['cintura'])?>" class="form-control" type="text" name="cintura" required>
                </div>

                <div class="form-group">
                    <label for="cadera">Cadera:</label>
                    <input id="cadera" value="<?=old('cadera', $falda['cadera'])?>" class="form-control" type="text" name="cadera" required>
                </div>

                <button id="guardarBtn" class="btn btn-success" type="button">Guardar</button>
                <a href="<?=site_url('/datosFalda')?>" class="btn btn-danger">Cancelar</a>
            </form>
        </p>
    </div>
</div>

<?=$pie?>
