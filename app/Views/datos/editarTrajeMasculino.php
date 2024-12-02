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

