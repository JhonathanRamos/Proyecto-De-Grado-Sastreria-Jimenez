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
    Modificar Datos Del Traje Femenino De: <span style="font-weight: bold;"><?=$cliente['nombre'] . ' ' . $cliente['apellido']?></span>
    </h2>
        <p class="card-text">
            <form method="post" action="<?=site_url('/actualizartrajeFemenino')?>" enctype="multipart/form-data">
           
                <input type="hidden" name="cliente_id" value="<?=$trajeFemeninos['cliente_id']?>">


                <div class="form-group">
                    <label for="talle">Talle:</label>
                    <input id="talle" value="<?=old('talle',$trajeFemeninos['talle'])?>"  class="form-control" type="text" name="talle" required>
                </div>

                <div class="form-group">
                    <label for="largo">Largo:</label>
                    <input id="largo" value="<?=old('largo',$trajeFemeninos['largo'])?>"  class="form-control" type="text" name="largo" required>
                </div>

                <div class="form-group">
                    <label for="hombro">Hombro:</label>
                    <input id="hombro" value="<?=old('hombro',$trajeFemeninos['hombro'])?>"  class="form-control" type="text" name="hombro" required>
                </div>

                <div class="form-group">
                    <label for="ancho">Ancho:</label>
                    <input id="ancho" value="<?=old('ancho',$trajeFemeninos['ancho'])?>"  class="form-control" type="text" name="ancho" required>
                </div>

                <div class="form-group">
                    <label for="pecho">Pecho:</label>
                    <input id="pecho"pecho value="<?=old('pecho',$trajeFemeninos['pecho'])?>"  class="form-control" type="text" name="pecho" required>
                </div>

                <div class="form-group">
                    <label for="cintura">Cintura:</label>
                    <input id="cintura" value="<?=old('cintura',$trajeFemeninos['cintura'])?>"  class="form-control" type="text" name="cintura" required>
                </div>

                <div class="form-group">
                    <label for="cadera">Cadera:</label>
                    <input id="cadera" value="<?=old('cadera',$trajeFemeninos['cadera'])?>"  class="form-control" type="text" name="cadera" required>
                </div>

                <div class="form-group">
                    <label for="largoManga">LargoManga:</label>
                    <input id="largoManga" value="<?=old('largoManga',$trajeFemeninos['largoManga'])?>"  class="form-control" type="text" name="largoManga" required>
                </div>


                <button id="guardarBtn" class="btn btn-success" type="button">Guardar</button>
                <a href="<?=site_url('/datosTrajeFemenino')?>" class="btn btn-danger">Cancelar</a>
            </form>

        </p>
    </div>
</div>



<?=$pie?>

