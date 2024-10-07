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
        <h5 class="card-title">Ingresar Medidas Del Cliente</h5>
        <p class="card-text">
            <form method="post" action="<?=site_url('/guardarPantalon')?>" enctype="multipart/form-data">

            <div class="form-group">
                    <label for="idCliente">Cliente:</label>
                    <select id="idCliente" class="form-control" name="idCliente" class="js-example-basic-single"style="width: 100%; color: white;">
                        <?php foreach ($clientes as $Cliente): ?>
                            <?php
                            $clienteTienePantalon = false;
                            foreach ($pantalones as $pantalon) {
                                if ($pantalon['idCliente'] === $Cliente['idCliente']) {
                                    $clienteTienePantalon = true;
                                    break;
                                }
                            }
                            ?>
                            <?php if (!$clienteTienePantalon): ?>
                                <option value="<?= $Cliente['idCliente'] ?>">
                                    <?= $Cliente['nombre_completo'] ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="largo">Largo:</label>
                    <input id="largo" value="<?=old('largo')?>"  class="form-control" type="text" name="largo" required>
                </div>

                <div class="form-group">
                    <label for="entrepierna">Entre Pierna:</label>
                    <input id="entrepierna" value="<?=old('entrepierna')?>"  class="form-control" type="text" name="entrepierna" required>
                </div>

                <div class="form-group">
                    <label for="cintura">Cintura:</label>
                    <input id="cintura" value="<?=old('cintura')?>"  class="form-control" type="text" name="cintura" required>
                </div>

                <div class="form-group">
                    <label for="cadera">Cadera:</label>
                    <input id="cadera" value="<?=old('cadera')?>"  class="form-control" type="text" name="cadera" required>
                </div>

                <div class="form-group">
                    <label for="pierna">Pierna:</label>
                    <input id="pierna" value="<?=old('pierna')?>"  class="form-control" type="text" name="pierna" required>
                </div>

                <div class="form-group">
                    <label for="rodilla">Rodilla:</label>
                    <input id="rodilla" value="<?=old('rodilla')?>"  class="form-control" type="text" name="rodilla" required>
                </div>

                <div class="form-group">
                    <label for="bota">Bota:</label>
                    <input id="bota" value="<?=old('bota')?>"  class="form-control" type="text" name="bota" required>
                </div>


                <button id="BtnSuccess" class="btn btn-success btn-fw" type="submit">Guardar</button>
                <a href="<?=site_url('/cliente')?>" class="btn btn-danger btn-fw">Cancelar</a>
            </form>

        </p>
    </div>
</div>



<?=$pie?>

