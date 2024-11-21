<?= $cabecera ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Registrar Nueva Venta</h3>
            <p class="card-text">
            <form id="formVenta" method="post" action="<?= site_url('/ventas/guardarVenta') ?>"
                enctype="multipart/form-data">

                <!-- Campo oculto para los detalles -->
                <input type="hidden" id="detallesVenta" name="detalles">

                <!-- Selección del Cliente -->
                <div class="form-group">
                    <label for="idCliente">Cliente:</label>
                    <select id="idCliente" class="form-control" name="idCliente" required>
                        <option value="">Seleccione un cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= esc($cliente['id']); ?>">
                                <?= esc($cliente['nombre']) . ' ' . esc($cliente['apellido']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Selección de Confección -->
                <div class="form-group">
                    <label for="idConfeccion">Confección:</label>
                    <select id="idConfeccion" class="form-control" name="idConfeccion" onchange="verificarConfeccion()"
                        required>
                        <option value="">Seleccione una confección</option>

                        <!-- Opciones para categoría Confección -->
                        <optgroup label="Confección">
                            <?php foreach ($confecciones as $confeccion): ?>
                                <?php if ($confeccion['categoria'] === 'Confeccion'): ?>
                                    <option value="<?= esc($confeccion['id']); ?>"
                                        data-categoria="<?= esc($confeccion['categoria']); ?>"
                                        data-precio="<?= esc($confeccion['precio']); ?>">
                                        <?= esc($confeccion['descripcion']); ?> (<?= esc($confeccion['precio']) . ' Bs'; ?>)
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </optgroup>

                        <!-- Opciones para categoría Arreglo -->
                        <optgroup label="Arreglo">
                            <?php foreach ($confecciones as $confeccion): ?>
                                <?php if ($confeccion['categoria'] === 'Arreglo'): ?>
                                    <option value="<?= esc($confeccion['id']); ?>"
                                        data-categoria="<?= esc($confeccion['categoria']); ?>"
                                        data-precio="<?= esc($confeccion['precio']); ?>">
                                        <?= esc($confeccion['descripcion']); ?> (<?= esc($confeccion['precio']) . ' Bs'; ?>)
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>


                <!-- Selección de Tela (opcional para confección) -->
                <div class="form-group" id="telaOpciones" style="display: none;">
                    <label for="idTela">Tela:</label>
                    <select id="idTela" class="form-control" name="idTela">
                        <option value="">Seleccione una tela</option>
                        <?php foreach ($telas as $tela): ?>
                            <option value="<?= esc($tela['id']); ?>" data-precio="<?= esc($tela['precio']); ?>">
                                <?= esc($tela['nombre']) . ' (' . esc($tela['precio']) . ' Bs por metro)'; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="metrosTela">Metros de Tela:</label>
                    <input type="number" step="0.01" id="metrosTela" name="metrosTela" class="form-control">
                </div>

                <!-- Campo para Cantidad -->
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" required>
                </div>

                <!-- Adelanto -->
                <div class="form-group">
                    <label for="adelanto">Adelanto:</label>
                    <input type="number" id="adelanto" name="adelanto" class="form-control" required>
                </div>

                <!-- Fecha de Prueba (para trajes) -->
                <div class="form-group" id="fechaPruebaOpciones" style="display: none;">
                    <label for="fechaPrueba">Fecha de Prueba:</label>
                    <input type="datetime-local" id="fechaPrueba" name="fechaPrueba" class="form-control">
                </div>

                <!-- Fecha de Entrega -->
                <div class="form-group">
                    <label for="fechaEntrega">Fecha de Entrega:</label>
                    <input type="datetime-local" id="fechaEntrega" name="fechaEntrega" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="descuentoProducto">Descuento por Producto:</label>
                    <input type="number" id="descuentoProducto" name="descuentoProducto" class="form-control"
                        step="0.01" placeholder="0">
                </div>

                <div class="form-group">
                    <label for="metodoPago">Método de Pago:</label>
                    <select id="metodoPago" name="metodoPago" class="form-control" required>
                        <option value="">Seleccione un método</option>
                        <option value="QR">QR</option>
                        <option value="Contado">Contado</option>
                    </select>
                </div>




                <button type="button" id="btnAgregarDetalle" class="btn btn-success">Agregar Detalle</button>
                <button type="submit" id="btnGuardarVenta" class="btn btn-primary">Guardar Venta</button>
                <a href="<?= site_url('/venta') ?>" class="btn btn-danger">Cancelar</a>


            </form>

            <!-- Tabla para mostrar los detalles de la venta -->
            <h4 class="mt-4">Detalles de la Venta</h4>
            <table id="tablaDetalles" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Confección</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Adelanto</th>
                        <th>Descuento</th>
                        <th>Falta Pagar</th>
                        <th>Fecha Prueba</th>
                        <th>Fecha Entrega</th>
                        <th>Tela</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Detalles se agregarán dinámicamente aquí -->
                </tbody>
            </table>
            </p>
        </div>
    </div>
</div>

<script>
    function verificarConfeccion() {
        const idConfeccion = document.getElementById('idConfeccion');
        const categoria = idConfeccion.options[idConfeccion.selectedIndex]?.getAttribute('data-categoria');
        const descripcion = idConfeccion.options[idConfeccion.selectedIndex]?.text || '';

        document.getElementById('telaOpciones').style.display = (categoria === 'Confeccion') ? 'block' : 'none';
        document.getElementById('fechaPruebaOpciones').style.display =
            (descripcion.includes('Traje Masculino') || descripcion.includes('Traje Femenino')) ? 'block' : 'none';
    }


    function limpiarCampos() {
        document.getElementById('idConfeccion').selectedIndex = 0; // Restablecer el select a la opción predeterminada
        document.getElementById('idTela').selectedIndex = 0; // Restablecer el select de tela
        document.getElementById('metrosTela').value = "";
        document.getElementById('cantidad').value = "";
        document.getElementById('adelanto').value = "";
        document.getElementById('descuentoProducto').value = "";
        document.getElementById('fechaPrueba').value = "";
        document.getElementById('fechaEntrega').value = "";

        document.getElementById('telaOpciones').style.display = "none";
        document.getElementById('fechaPruebaOpciones').style.display = "none";
    }

    document.getElementById('btnAgregarDetalle').addEventListener('click', () => {
        const idConfeccion = document.getElementById('idConfeccion');
        const cantidad = parseInt(document.getElementById('cantidad').value || 0);
        const adelanto = parseFloat(document.getElementById('adelanto').value || 0);
        const fechaPrueba = document.getElementById('fechaPrueba').value || null;
        const fechaEntrega = document.getElementById('fechaEntrega').value || null;
        const precioUnitario = parseFloat(idConfeccion.options[idConfeccion.selectedIndex].getAttribute('data-precio'));
        const descuentoProducto = parseFloat(document.getElementById('descuentoProducto').value || 0);

        // Validar los valores básicos
        if (!cantidad || cantidad <= 0) {
            alert("La cantidad debe ser mayor a 0.");
            return;
        }

        if (precioUnitario <= 0) {
            alert("El precio unitario debe ser válido.");
            return;
        }

        // Calcular subtotal
        let subtotal = precioUnitario * cantidad;

        const idTela = document.getElementById('idTela');
        const metrosTela = parseFloat(document.getElementById('metrosTela').value || 0);
        let idTelaValue = null;
        let textoTela = "N/A";
        let costoTela = 0;

        // Si hay tela seleccionada, calcular el costo de la tela
        if (idTela && idTela.value) {
            const precioTela = parseFloat(idTela.options[idTela.selectedIndex].getAttribute('data-precio'));
            costoTela = precioTela * metrosTela;
            subtotal += costoTela;
            idTelaValue = idTela.value;

            // Formatear la descripción de la tela
            textoTela = `${idTela.options[idTela.selectedIndex].text.split(' ')[0]} (${metrosTela.toFixed(2)} metros x ${precioTela.toFixed(2)} Bs = ${costoTela.toFixed(2)} Bs)`;
        }

        // Validaciones relacionadas con descuento
        if (descuentoProducto > subtotal) {
            alert("El descuento no puede ser mayor que el subtotal.");
            return;
        }

        const subtotalConDescuento = subtotal - descuentoProducto;
        const restante = subtotalConDescuento - adelanto;

        // Validar que el restante no sea negativo
        if (restante < 0) {
            alert("El adelanto y el descuento no pueden superar el subtotal.");
            return;
        }

        // Agregar la fila a la tabla de detalles
        const tabla = document.getElementById('tablaDetalles').querySelector('tbody');
        const fila = tabla.insertRow();

        fila.innerHTML = `
            <td data-id-confeccion="${idConfeccion.value}">${idConfeccion.options[idConfeccion.selectedIndex].text}</td>
            <td>${cantidad}</td>
            <td>${precioUnitario.toFixed(2)} Bs</td>
            <td>${subtotal.toFixed(2)} Bs</td>
            <td>${adelanto.toFixed(2)} Bs</td>
            <td>${descuentoProducto.toFixed(2)} Bs</td>
            <td>${restante.toFixed(2)} Bs</td>
            <td>${fechaPrueba || 'N/A'}</td>
            <td>${fechaEntrega || 'N/A'}</td>
            <td data-id-tela="${idTelaValue || ''}" data-metros-tela="${metrosTela}">${textoTela}</td>
            <td>
                <button type="button" class="btn btn-warning btnEditar">Editar</button>
                <button type="button" class="btn btn-danger btnEliminar">Eliminar</button>
            </td>
        `;


        limpiarCampos();
    });


    document.getElementById('tablaDetalles').addEventListener('click', (e) => {
        if (e.target.classList.contains('btnEditar')) {
            const fila = e.target.closest('tr');
            const celdas = fila.querySelectorAll('td');

            // Restaurar los valores en los campos del formulario
            document.getElementById('idConfeccion').value = celdas[0].getAttribute('data-id-confeccion');
            document.getElementById('cantidad').value = celdas[1].innerText;
            document.getElementById('adelanto').value = celdas[4].innerText;
            document.getElementById('descuentoProducto').value = celdas[5].innerText;
            document.getElementById('fechaPrueba').value = celdas[7].innerText !== 'N/A' ? celdas[7].innerText : '';
            document.getElementById('fechaEntrega').value = celdas[8].innerText;

            // Restaurar el select de tela y sus valores
            const idTela = celdas[9].getAttribute('data-id-tela');
            if (idTela) {
                document.getElementById('idTela').value = idTela;
                const metros = celdas[9].getAttribute('data-metros-tela');
                document.getElementById('metrosTela').value = metros || '';
            } else {
                document.getElementById('idTela').selectedIndex = 0;
                document.getElementById('metrosTela').value = '';
            }

            // Mostrar los elementos relevantes según la categoría
            verificarConfeccion();

            // Eliminar la fila de la tabla para que no se duplique
            fila.remove();
        }
    });


    document.getElementById('btnGuardarVenta').addEventListener('click', () => {
        const detalles = [];
        const tabla = document.getElementById('tablaDetalles').querySelector('tbody');

        if (tabla.rows.length === 0) {
            alert("Debe agregar al menos un detalle a la venta.");
            return;
        }

        let total = 0;

        tabla.querySelectorAll('tr').forEach((fila) => {
            const celdas = fila.querySelectorAll('td');
            const subtotal = parseFloat(celdas[3].innerText);
            const descuento = parseFloat(celdas[5].innerText);
            const adelanto = parseFloat(celdas[4].innerText);
            const restante = parseFloat(celdas[6].innerText);

            total += subtotal - descuento;

            detalles.push({
                idConfeccion: celdas[0].getAttribute('data-id-confeccion'),
                cantidad: parseInt(celdas[1].innerText),
                precio_unitario: parseFloat(celdas[2].innerText),
                subtotal: subtotal,
                descuento: descuento,
                adelanto: adelanto,
                restante: restante,
                fechaPrueba: celdas[7].innerText !== 'N/A' ? celdas[7].innerText : null,
                fechaEntrega: celdas[8].innerText,
                idTela: celdas[9].getAttribute('data-id-tela') || null,
                metrosTela: parseFloat(celdas[9].getAttribute('data-metros-tela')) || 0
            });
        });

        if (total <= 0) {
            alert("El total no puede ser negativo o cero.");
            return;
        }

        document.getElementById('detallesVenta').value = JSON.stringify(detalles);
        document.getElementById('formVenta').submit();
    });

</script>

<?= $pie ?>