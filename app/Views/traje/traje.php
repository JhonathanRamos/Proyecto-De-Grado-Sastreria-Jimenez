<?= $cabecera ?>

<h1>Personaliza tu Traje - Selecciona el Tejido</h1>
<div class="tejido-selector">
    <div class="tejidos">
        <?php
        // Lista de tejidos
        $tejidos = [
            "img/t1.png", "img/t2.png", "img/t3.png",
            "img/t4.png", "img/t5.png", "img/t6.png",
            "img/t7.png", "img/t8.png", "img/t9.png",
            "img/t10.png", "img/t11.png", "img/t12.png"
        ];
        
         // Generar miniaturas de tejidos
         foreach ($tejidos as $tejido) {
            echo "<img src='$tejido' class='tejido-thumbnail' onclick='cambiarTejido(\"$tejido\")' alt='Tejido del Traje'>";
        }
        ?>
    </div>
    <div class="preview">
        <img id="preview-tejido" src="img/default.png" alt="Tejido del Traje">
    </div>
</div>

<?= $pie ?>
