<?= $cabeceraEditar ?>

<?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
        <?= session('mensaje'); ?>
    </div>
<?php } ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Ingresar Detalles de Confección</h3>
            <p class="card-text">
            <form method="post" action="<?= site_url('/confeccion/guardar') ?>" enctype="multipart/form-data">
                <!-- Cambié la acción para que use la URL correcta -->

                <!-- Campo para Descripción (Entrada libre) -->
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input id="descripcion" value="<?= old('descripcion') ?>" class="form-control" type="text"
                        name="descripcion" placeholder="Ingrese descripción" required>
                </div>

                <!-- Campo para Precio (Entrada libre) -->
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input id="precio" value="<?= old('precio') ?>" class="form-control" type="text" name="precio"
                        placeholder="Ingrese precio" required>
                </div>

                <!-- Campo para Unidad de Medida  -->
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" class="form-control" name="categoria" required>
                        <option value="Confeccion" <?= old('categoria') == 'Confeccion' ? 'selected' : '' ?>>Confección
                        </option>
                        <option value="Arreglo" <?= old('categoria') == 'Arreglo' ? 'selected' : '' ?>>Arreglo</option>
                    </select>
                </div>

                <!-- Botones de Guardar/Cancelar -->
                <button id="guardarBtnConfeccion" class="btn btn-success btn-fw" type="submit">Guardar</button>
                <!-- Cambié la URL del botón de Cancelar para redirigir a la lista de confecciones -->
                <a href="<?= site_url('/confeccion') ?>" class="btn btn-danger btn-fw">Cancelar</a>
            </form>
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form'); // Seleccionar el formulario
        const inputs = Array.from(form.querySelectorAll('input, select, button')); // Todos los campos interactivos

        // Enfocar automáticamente el primer campo del formulario
        const firstInput = inputs.find(input => input.tagName === 'INPUT' || input.tagName === 'SELECT');
        if (firstInput) {
            firstInput.focus();
        }

        // Agregar eventos para manejar la movilidad con flechas y Enter
        form.addEventListener('keydown', function (event) {
            const currentIndex = inputs.indexOf(document.activeElement); // Índice del campo actualmente enfocado

            if (event.key === 'Enter') {
                // Prevenir el comportamiento por defecto del Enter (enviar formulario)
                event.preventDefault();
                if (currentIndex >= 0 && currentIndex < inputs.length - 1) {
                    inputs[currentIndex + 1].focus(); // Enfocar el siguiente campo
                } else if (currentIndex === inputs.length - 1) {
                    inputs[currentIndex].click(); // Si es el último campo (botón), hacer clic
                }
            } else if (event.key === 'ArrowDown') {
                // Mover al siguiente campo con flecha abajo
                event.preventDefault();
                if (currentIndex >= 0 && currentIndex < inputs.length - 1) {
                    inputs[currentIndex + 1].focus();
                }
            } else if (event.key === 'ArrowUp') {
                // Mover al campo anterior con flecha arriba
                event.preventDefault();
                if (currentIndex > 0) {
                    inputs[currentIndex - 1].focus();
                }
            }
        });

        // Opcional: Agregar un resaltado visual para el campo enfocado
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.style.outline = '2px solid #00ff00'; // Agregar borde verde al enfocar
            });
            input.addEventListener('blur', function () {
                this.style.outline = 'none'; // Quitar el borde al desenfocar
            });
        });
    });
</script>


<?= $pie ?>