<?= $cabeceraEditar ?>

<?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo session('mensaje') ?>
    </div>
<?php } ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ingresar Medidas Del Traje Masculino del Cliente</h5>
        <p class="card-text">
        <form method="post" action="<?= site_url('/guardarFalda') ?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="idCliente">Cliente:</label>
                <select id="idCliente" class="form-control js-example-basic-single" name="idCliente"
                    style="width: 100%; color: white;" required>
                    <!-- Opción predeterminada vacía -->
                    <option value="" selected disabled>Seleccione un cliente</option>
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
                <input id="largo" value="<?= old('largo') ?>" class="form-control" type="number" name="largo" min="0"
                    max="999" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>

            <div class="form-group">
                <label for="cintura">Cintura:</label>
                <input id="cintura" value="<?= old('cintura') ?>" class="form-control" type="number" name="cintura"
                    min="0" max="999" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>

            <div class="form-group">
                <label for="cadera">Cadera:</label>
                <input id="cadera" value="<?= old('cadera') ?>" class="form-control" type="number" name="cadera" min="0"
                    max="999" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>


            <button id="BtnSuccess" class="btn btn-success btn-fw" type="submit">Guardar</button>
            <a href="<?= site_url('/datosFalda') ?>" class="btn btn-danger btn-fw">Cancelar</a>
        </form>
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const talleInput = document.getElementById('largo'); // Seleccionar el campo "Talle"
        if (talleInput) {
            talleInput.focus(); // Establecer el foco en "Talle"
        }

        const form = document.querySelector('form');

        form.addEventListener('keydown', function (event) {
            const focusableElements = Array.from(form.querySelectorAll('input, select, button'));
            const currentIndex = focusableElements.indexOf(document.activeElement);

            if (event.key === 'Enter') {
                event.preventDefault(); // Evitar el envío con Enter
                if (currentIndex >= 0 && currentIndex < focusableElements.length - 1) {
                    focusableElements[currentIndex + 1].focus(); // Ir al siguiente campo
                } else if (currentIndex === focusableElements.length - 1) {
                    focusableElements[currentIndex].click(); // Ejecutar el clic si es el último
                }
            } else if (event.key === 'ArrowDown') {
                event.preventDefault();
                if (currentIndex >= 0 && currentIndex < focusableElements.length - 1) {
                    focusableElements[currentIndex + 1].focus(); // Ir al siguiente campo
                }
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                if (currentIndex > 0) {
                    focusableElements[currentIndex - 1].focus(); // Ir al campo anterior
                }
            }
        });

        // Resaltar el campo en foco
        form.querySelectorAll('input, select, button').forEach(element => {
            element.addEventListener('focus', function () {
                this.style.outline = '2px solid #00ff00'; // Agregar borde verde al enfocar
            });
            element.addEventListener('blur', function () {
                this.style.outline = 'none'; // Quitar el borde al perder el foco
            });
        });
    });
</script>

<?= $pie ?>