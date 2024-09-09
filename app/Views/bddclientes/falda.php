<?=$cabecera?>

<?php if(session('mensaje')){?>
<div class="alert alert-danger" role="alert">
    <?php echo session('mensaje') ?>
</div>
<?php } ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ingresar Medidas Del Cliente</h5>
        <p class="card-text">
            <form method="post" action="<?= site_url('/guardarFalda') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="idCliente">Cliente:</label>
                    <select id="idCliente" class="form-control" name="idCliente" required>
                        <?php foreach ($clientes as $Cliente): ?>
                            <?php
                            $clienteTieneFalda = false;
                            foreach ($faldas as $falda) {
                                if ($falda['idCliente'] === $Cliente['idCliente']) {
                                    $clienteTieneFalda = true;
                                    break;
                                }
                            }
                            ?>
                            <?php if (!$clienteTieneFalda): ?>
                                <option value="<?= $Cliente['idCliente'] ?>">
                                    <?= $Cliente['nombre_completo'] ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="largo">Largo:</label>
                    <input id="largo" value="<?= old('largo') ?>" class="form-control" type="text" name="largo" required>
                </div>
                <div class="form-group">
                    <label for="cintura">Cintura:</label>
                    <input id="cintura" value="<?= old('cintura') ?>" class="form-control" type="text" name="cintura" required>
                </div>
                <div class="form-group">
                    <label for="cadera">Cadera:</label>
                    <input id="cadera" value="<?= old('cadera') ?>" class="form-control" type="text" name="cadera" required>
                </div>
                
                <button id="BtnSuccess" class="btn btn-success" type="submit">Guardar</button>
                <a href="<?=site_url('/cliente')?>" class="btn btn-danger">Cancelar</a>
            </form>
        </p>
    </div>
</div>

<?=$pie?>
