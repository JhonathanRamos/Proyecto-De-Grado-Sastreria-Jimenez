<?= $cabeceraEditar ?>

<?php if (session('mensaje')) { ?>

    <div class="alert alert-danger" role="alert">
        <?php
        echo session('mensaje')
            ?>
    </div>

<?php } ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ingresar Medidas Del Traje Masculino Del Cliente</h5>
        <p class="card-text">
        <form method="post" action="<?= site_url('/guardartrajeMasculino') ?>" enctype="multipart/form-data">

            <!-- Campo de selección de cliente -->
            <div class="form-group">
                <label for="idCliente">Cliente:</label>
                <select id="idCliente" name="idCliente" class="form-control"
                    style="width: 100%; max-height: 50px; overflow-y: auto;" required>
                    <!-- Opción predeterminada vacía -->
                    <option value="" selected disabled>Seleccione un cliente</option>
                    <?php foreach ($clientes as $Cliente): ?>
                        <?php
                        $clienteTieneTrajeMasculino = false;
                        foreach ($trajeMasculinos as $trajeMasculino) {
                            if ($trajeMasculino['idCliente'] === $Cliente['idCliente']) {
                                $clienteTieneTrajeMasculino = true;
                                break;
                            }
                        }
                        ?>
                        <?php if (!$clienteTieneTrajeMasculino): ?>
                            <option value="<?= $Cliente['idCliente'] ?>">
                                <?= $Cliente['nombre_completo'] ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>


            <!-- Resto de los campos -->
            <div class="form-group">
                <label for="talle">Talle:</label>
                <input id="talle" value="<?= old('talle') ?>" class="form-control" type="number" name="talle" min="0"
                    max="999" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>
            <div class="form-group">
                <label for="largo">Largo:</label>
                <input id="largo" value="<?= old('largo') ?>" class="form-control" type="number" name="largo" min="0"
                    max="999" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>
            <div class="form-group">
                <label for="hombro">Hombro:</label>
                <input id="hombro" value="<?= old('hombro') ?>" class="form-control" type="number" name="hombro" min="0"
                    max="999" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>
            <div class="form-group">
                <label for="ancho">Ancho:</label>
                <input id="ancho" value="<?= old('ancho') ?>" class="form-control" type="number" name="ancho" min="0"
                    max="999" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>
            <div class="form-group">
                <label for="pecho">Pecho:</label>
                <input id="pecho" value="<?= old('pecho') ?>" class="form-control" type="number" name="pecho" min="0"
                    max="999" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>
            <div class="form-group">
                <label for="estomago">Estomago:</label>
                <input id="estomago" value="<?= old('estomago') ?>" class="form-control" type="number" name="estomago"
                    min="0" max="999" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>
            <div class="form-group">
                <label for="largoManga">LargoManga:</label>
                <input id="largoManga" value="<?= old('largoManga') ?>" class="form-control" type="number"
                    name="largoManga" min="0" max="999"
                    oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
            </div>

            <button id="BtnSuccess" class="btn btn-success btn-fw" type="submit">Guardar</button>
            <a href="<?= site_url('/datosTrajeMasculino') ?>" class="btn btn-danger btn-fw">Cancelar</a>

        </form>

        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clienteSelect = document.getElementById('idCliente'); // Seleccionar el campo de cliente
        if (clienteSelect) {
            clienteSelect.focus(); // Establecer el foco inicial en el campo de cliente
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