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
    Modificar Datos Del Traje Masculino De: <span style="font-weight: bold;"><?=$cliente['nombre'] . ' ' . $cliente['apellido']?></span>
    </h2>
        <p class="card-text">
            <form method="post" action="<?=site_url('/actualizartrajeMasculino')?>" enctype="multipart/form-data">
           
                <input type="hidden" name="idCliente" value="<?=$trajeMasculinos['idCliente']?>">


                <div class="form-group">
                    <label for="talle">Talle:</label>
                    <input id="talle" value="<?=old('talle',$trajeMasculinos['talle'])?>"  class="form-control" type="text" name="talle" required>
                </div>

                <div class="form-group">
                    <label for="largo">Largo:</label>
                    <input id="largo" value="<?=old('largo',$trajeMasculinos['largo'])?>"  class="form-control" type="text" name="largo" required>
                </div>

                <div class="form-group">
                    <label for="hombro">Hombro:</label>
                    <input id="hombro" value="<?=old('hombro',$trajeMasculinos['hombro'])?>"  class="form-control" type="text" name="hombro" required>
                </div>

                <div class="form-group">
                    <label for="ancho">Ancho:</label>
                    <input id="ancho" value="<?=old('ancho',$trajeMasculinos['ancho'])?>"  class="form-control" type="text" name="ancho" required>
                </div>

                <div class="form-group">
                    <label for="pecho">Pecho:</label>
                    <input id="pecho"pecho value="<?=old('pecho',$trajeMasculinos['pecho'])?>"  class="form-control" type="text" name="pecho" required>
                </div>

                <div class="form-group">
                    <label for="estomago">Estomago:</label>
                    <input id="estomago" value="<?=old('estomago',$trajeMasculinos['estomago'])?>"  class="form-control" type="text" name="estomago" required>
                </div>

                <div class="form-group">
                    <label for="largoManga">LargoManga:</label>
                    <input id="largoManga" value="<?=old('largoManga',$trajeMasculinos['largoManga'])?>"  class="form-control" type="text" name="largoManga" required>
                </div>


                <button id="guardarBtn" class="btn btn-success" type="button">Guardar</button>
                <a href="<?=site_url('/datosTrajeMasculino')?>" class="btn btn-danger">Cancelar</a>
            </form>

        </p>
    </div>
</div>



<?=$pie?>

