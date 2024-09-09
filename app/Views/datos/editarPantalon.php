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
    <h2 class="card-title">
    Modificar Datos Del Pantalon De: <span style="font-weight: bold;"><?=$cliente['nombre'] . ' ' . $cliente['apellido']?></span>
    </h2>
        <p class="card-text">
            <form method="post" action="<?=site_url('/actualizarPantalon')?>" enctype="multipart/form-data">

            <input type="hidden" name="idCliente" value="<?=$pantalon['idCliente']?>">

                <div class="form-group">
                    <label for="largo">Largo:</label>
                    <input id="largo" value="<?=old('largo',$pantalon['largo'])?>"  class="form-control" type="text" name="largo" required>
                </div>

                <div class="form-group">
                    <label for="entrepierna">Entre Pierna:</label>
                    <input id="entrepierna" value="<?=old('entrepierna',$pantalon['entrepierna'])?>"  class="form-control" type="text" name="entrepierna" required>
                </div>

                <div class="form-group">
                    <label for="cintura">Cintura:</label>
                    <input id="cintura" value="<?=old('cintura',$pantalon['cintura'])?>"  class="form-control" type="text" name="cintura" required>
                </div>

                <div class="form-group">
                    <label for="cadera">Cadera:</label>
                    <input id="cadera" value="<?=old('cadera',$pantalon['cadera'])?>"  class="form-control" type="text" name="cadera" required>
                </div>

                <div class="form-group">
                    <label for="pierna">Pierna:</label>
                    <input id="pierna" value="<?=old('pierna',$pantalon['pierna'])?>"  class="form-control" type="text" name="pierna" required>
                </div>

                <div class="form-group">
                    <label for="rodilla">Rodilla:</label>
                    <input id="rodilla" value="<?=old('rodilla',$pantalon['rodilla'])?>"  class="form-control" type="text" name="rodilla" required>
                </div>

                <div class="form-group">
                    <label for="bota">Bota:</label>
                    <input id="bota" value="<?=old('bota',$pantalon['bota'])?>"  class="form-control" type="text" name="bota" required>
                </div>


                <button id="guardarBtn" class="btn btn-success" type="button">Guardar</button>
                <a href="<?=site_url('/datosPantalon')?>" class="btn btn-danger">Cancelar</a>
            </form>

        </p>
    </div>
</div>



<?=$pie?>

