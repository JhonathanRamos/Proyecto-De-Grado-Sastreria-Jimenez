<?= $cabecera ?>

<div class="container">
    <h1>Confirmación de Pago</h1>
    <form action="<?= base_url('venta/confirmarPago'); ?>" method="post">
        <div class="form-group">
            <label for="metodo_pago">Método de Pago:</label>
            <select name="metodo_pago" id="metodo_pago" class="form-control" onchange="mostrarQR(this.value)">
                <option value="Contado">Contado</option>
                <option value="QR">QR</option>
            </select>
        </div>

        <div id="qr_container" style="display: none;">
            <h3>Escanea el siguiente código QR para realizar el pago:</h3>
            <img src="<?= base_url('path_a_tu_imagen_qr'); ?>" alt="Código QR" style="max-width: 250px;">
        </div>

        <div class="form-group">
            <label for="confirmacion_pago">¿Se ha recibido el pago?</label>
            <select name="confirmacion_pago" id="confirmacion_pago" class="form-control">
                <option value="No">No</option>
                <option value="Sí">Sí</option>
            </select>
        </div>

        <input type="hidden" name="idVenta" value="<?= $idVenta; ?>">

        <button type="submit" class="btn btn-success">Confirmar Pago</button>
        <a href="<?= base_url('venta'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    // Función para mostrar el contenedor del QR si se selecciona el método de pago "QR"
    function mostrarQR(metodo) {
        var qrContainer = document.getElementById('qr_container');
        if (metodo === 'QR') {
            qrContainer.style.display = 'block';
        } else {
            qrContainer.style.display = 'none';
        }
    }
</script>

<?= $pie ?>