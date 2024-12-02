<?= $cabeceraEditar ?>

<?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
        <?= session('mensaje') ?>
    </div>
<?php } ?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">MODIFICAR DATOS DEL CLIENTE</h3>
            <p class="card-text">
            <form id="editarForm" method="post" action="<?= site_url('/actualizar') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $cliente['id'] ?>">

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" value="<?= $cliente['nombre'] ?>" class="form-control" type="text" name="nombre" tabindex="1" required>
                </div>

                <div class="form-group">
                    <label for="apellido">Primer Apellido:</label>
                    <input id="apellido" value="<?= $cliente['apellido'] ?>" class="form-control" type="text" name="apellido" tabindex="2" required>
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select id="sexo" class="form-control" name="sexo" tabindex="3" required>
                        <option value="">Seleccione</option>
                        <option value="M" <?= ($cliente['sexo'] === 'M') ? 'selected' : '' ?>>Masculino</option>
                        <option value="F" <?= ($cliente['sexo'] === 'F') ? 'selected' : '' ?>>Femenino</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input id="celular" value="<?= $cliente['celular'] ?>" class="form-control" type="text" name="celular" tabindex="4">
                </div>

                <button id="guardarBtn" class="btn btn-success btn-fw" type="submit" tabindex="5">Guardar</button>
                <a href="<?= site_url('/cliente') ?>" class="btn btn-danger btn-fw" tabindex="6">Cancelar</a>
            </form>
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('editarForm'); // Actualizado para usar el id correcto

        // Enfocar automáticamente el primer campo (Nombre)
        const firstInput = form.querySelector('input, select, button');
        if (firstInput) {
            firstInput.focus();
        }

        form.addEventListener('keydown', function (event) {
            const formElements = Array.from(form.querySelectorAll('input, select, button')); // Elementos interactivos
            const currentIndex = formElements.indexOf(event.target); // Índice del elemento actual

            if (event.key === 'Enter') {
                event.preventDefault(); // Evitar envío predeterminado
                if (currentIndex >= 0 && currentIndex < formElements.length - 1) {
                    formElements[currentIndex + 1].focus(); // Enfocar el siguiente elemento
                } else if (currentIndex === formElements.length - 1) {
                    formElements[currentIndex].click(); // Si es el último elemento, hacer clic
                }
            } else if (event.key === 'ArrowDown') {
                event.preventDefault(); // Prevenir scroll
                if (currentIndex >= 0 && currentIndex < formElements.length - 1) {
                    formElements[currentIndex + 1].focus(); // Enfocar el siguiente elemento
                }
            } else if (event.key === 'ArrowUp') {
                event.preventDefault(); // Prevenir scroll
                if (currentIndex > 0) {
                    formElements[currentIndex - 1].focus(); // Enfocar el elemento anterior
                }
            }
        });

        // Agregar estilo para resaltar el elemento en foco
        form.querySelectorAll('button, input, select').forEach(element => {
            element.addEventListener('focus', function () {
                this.style.outline = '2px solid #00ff00'; // Cambiar el borde al enfocar
            });
            element.addEventListener('blur', function () {
                this.style.outline = 'none'; // Quitar el borde al desenfocar
            });
        });
    });
</script>

<?= $pie ?>
