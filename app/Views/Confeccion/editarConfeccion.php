<?= $cabeceraEditar ?>

<?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo session('mensaje');
        ?>
    </div>
<?php } ?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Modificar Confección</h2>
            <p class="card-text">

            <form method="post" action="<?= site_url('/confeccion/actualizar/' . $confeccion['id']) ?>" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $confeccion['id'] ?>">

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input id="descripcion" value="<?= $confeccion['descripcion'] ?>" class="form-control" type="text" name="descripcion" required>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input id="precio" value="<?= $confeccion['precio'] ?>" class="form-control" type="text" name="precio" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Unidad de Medida:</label>
                    <select id="categoria" class="form-control" name="categoria" required>
                        <option value="Confeccion" <?= ($confeccion['categoria'] === 'Confeccion') ? 'selected' : '' ?>>Confección</option>
                        <option value="Arreglo" <?= ($confeccion['categoria'] === 'Arreglo') ? 'selected' : '' ?>>Arreglo</option>
                    </select>
                </div>

                <button id="guardarBtnConfeccion" class="btn btn-success btn-fw" type="submit">Guardar</button>
                <a href="<?= site_url('/confeccion') ?>" class="btn btn-danger btn-fw">Cancelar</a>

                <div class="form-group">
                    <input id="fechaActualizacion" class="form-control" type="hidden" name="fechaActualizacion"
                        value="<?= date('Y-m-d H:i:s'); ?>">
                </div>
            </form>

            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Selecciona el formulario
    const focusableElements = Array.from(form.querySelectorAll('input, select, button')); // Todos los campos interactivos

    form.addEventListener('keydown', function (event) {
        const currentIndex = focusableElements.indexOf(document.activeElement); // Índice del campo actual

        if (event.key === 'Enter') {
            // Mover al siguiente campo al presionar Enter
            event.preventDefault();
            if (currentIndex >= 0 && currentIndex < focusableElements.length - 1) {
                focusableElements[currentIndex + 1].focus(); // Ir al siguiente
            } else if (currentIndex === focusableElements.length - 1) {
                // Si es el último, envía el formulario
                form.submit(); // Enviar el formulario directamente
            }
        } else if (event.key === 'ArrowDown') {
            // Mover al siguiente campo con ArrowDown
            event.preventDefault();
            if (currentIndex >= 0 && currentIndex < focusableElements.length - 1) {
                focusableElements[currentIndex + 1].focus();
            }
        } else if (event.key === 'ArrowUp') {
            // Mover al campo anterior con ArrowUp
            event.preventDefault();
            if (currentIndex > 0) {
                focusableElements[currentIndex - 1].focus();
            }
        }
    });

    // Deshabilitar flechas para campos numéricos (para evitar que suban/bajen el valor)
    form.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowUp' || event.key === 'ArrowDown') {
                event.preventDefault();
            }
        });
    });

    // Resaltar el campo actualmente enfocado
    form.querySelectorAll('input, select, button').forEach(element => {
        element.addEventListener('focus', function () {
            this.style.outline = '2px solid #00ff00'; // Agrega un borde verde al enfocar
        });
        element.addEventListener('blur', function () {
            this.style.outline = 'none'; // Elimina el borde al desenfocar
        });
    });
});
</script>


<?= $pie ?>
