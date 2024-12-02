<?=$cabeceraEditar?>


<?php if(session('mensaje')){?>

<div class="alert alert-danger" role="alert">
<?php
echo session('mensaje')
?>
</div>

<?php } ?>

<div class="card">
    <div class="card-body">
    <h3 class="card-title">
    Modificar Datos Del Pantalon De: <span style="font-weight: bold;"><?=$cliente['nombre'] . ' ' . $cliente['apellido']?></span>
    </h3>
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
                focusableElements[currentIndex].click(); // Si es el último, ejecuta el clic
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



<?=$pie?>

