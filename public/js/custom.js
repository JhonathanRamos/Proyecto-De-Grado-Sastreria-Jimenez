// Cambio de imágenes
function change1() { document.getElementById('tr1').src = 'img/tr1.png'; }
function change2() { document.getElementById('tr1').src = 'img/tr2.png'; }
function change3() { document.getElementById('tr1').src = 'img/tr3.png'; }
function change4() { document.getElementById('tr1').src = 'img/tr4.png'; }
function change5() { document.getElementById('tr1').src = 'img/tr5.png'; }
function change6() { document.getElementById('tr1').src = 'img/tr6.png'; }
function change7() { document.getElementById('tr1').src = 'img/tr7.png'; }
function change8() { document.getElementById('tr1').src = 'img/tr8.png'; }
function change9() { document.getElementById('tr1').src = 'img/tr9.png'; }
function change10() { document.getElementById('tr1').src = 'img/tr10.png'; }
function change11() { document.getElementById('tr1').src = 'img/tr11.png'; }
function change12() { document.getElementById('tr1').src = 'img/tr12.png'; }
function change13() { document.getElementById('tr1').src = 'img/tr13.png'; }
function change14() { document.getElementById('tr1').src = 'img/tr14.png'; }
function change15() { document.getElementById('tr1').src = 'img/tr15.png'; }

function cambiarTejido(ruta) {
    document.getElementById("preview-tejido").src = ruta;
}




//FECHA DE REGISTRO ORDEN 

document.addEventListener('DOMContentLoaded', function () {
    const table = document.querySelector('#clientesTable');
    if (table) {
        const idHeader = table.querySelector('th:nth-child(1)'); // Asume que el ID está en la primera columna
        const dateHeader = table.querySelector('#fechaRegistro');
        if (dateHeader) {
            let ascendingDate = false;

            function sortTable(col, ascending) {
                const rows = Array.from(table.querySelectorAll('tbody tr'));
                const sortedRows = rows.sort((a, b) => {
                    const aText = a.children[col].textContent.trim();
                    const bText = b.children[col].textContent.trim();

                    return ascending
                        ? aText.localeCompare(bText, undefined, { numeric: true })
                        : bText.localeCompare(aText, undefined, { numeric: true });
                });

                sortedRows.forEach(row => table.querySelector('tbody').appendChild(row));
            }

            function setInitialSort() {
                // Ordena por ID inicialmente
                sortTable(0, false); // 0 es el índice para la columna ID
            }

            function toggleDateSort() {
                ascendingDate = !ascendingDate;
                sortTable(6, ascendingDate); // 6 es el índice para la columna "Fecha Registro"
                dateHeader.classList.toggle('asc', ascendingDate);
                dateHeader.classList.toggle('desc', !ascendingDate);
            }

            dateHeader.addEventListener('click', toggleDateSort);

            // Establece el orden inicial por ID
            setInitialSort();
        }
    }
});



// sweetalert2 PARA CLIENTES
function confirmDelete(event, deleteUrl) {
    event.preventDefault(); // Previene la acción por defecto del enlace

    Swal.fire({
        title: '¿Estás seguro de eliminar al usuario?',
        text: "No podrás revertir esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, bórralo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        }
    });
}


// BORRAR PERO PARA LOS DEMAS CON SWWETALERT2
function confirmDeleteDatos(event, deleteUrl) {
    event.preventDefault(); // Previene la acción por defecto del enlace

    Swal.fire({
        title: '¿Estás seguro de eliminar esta falda?',
        text: "No podrás revertir esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, bórrala',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        }
    });
}

//EDITAR FUNCIONA PARA GUARDAR BTN -- CRUD -- P - F - TM -TF - C
document.addEventListener('DOMContentLoaded', function () {
    var guardarBtn = document.getElementById('guardarBtn');
    var form = document.querySelector('form');

    if (guardarBtn) {
        guardarBtn.addEventListener('click', function (event) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas guardar los cambios?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: '¡Éxito!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'Aceptar'
                                }).then(() => {
                                    window.location.href = data.redirectUrl;
                                });
                            } else {
                                // Muestra errores específicos en SweetAlert
                                let mensajeError = "Revise la información ingresada:\n";
                                for (const [campo, error] of Object.entries(data.errors)) {
                                    mensajeError += `${campo}: ${error}\n`;
                                }
                                Swal.fire({
                                    title: 'Error',
                                    text: mensajeError,
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                });
                            }
                        })
                        .catch(() => {
                            Swal.fire({
                                title: 'Error',
                                text: 'Hubo un problema con la solicitud.',
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        });
                }
            });
        });
    }
});





//CREAR CLIENTE
document.addEventListener('DOMContentLoaded', function () {
    var urlActual = window.location.href;

    if (urlActual.includes('crear')) {
        const form = document.querySelector('form');
        const guardarBtn = document.getElementById('guardarBtnUsuario');

        if (guardarBtn) {
            guardarBtn.addEventListener('click', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar los datos del cliente?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData(form);

                        fetch(form.action, {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: '¡Cliente creado!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonText: 'Aceptar'
                                    }).then(() => {
                                        window.location.href = data.redirectUrl;
                                    });
                                } else {
                                    // Procesar errores detallados y mostrarlos
                                    let errorMessages = '';
                                    if (data.errors) {
                                        for (const [field, message] of Object.entries(data.errors)) {
                                            errorMessages += `${message}<br>`;
                                        }
                                    } else {
                                        errorMessages = data.message;
                                    }

                                    Swal.fire({
                                        title: 'Error',
                                        html: errorMessages, // Muestra los mensajes de error en HTML
                                        icon: 'error',
                                        confirmButtonText: 'Aceptar'
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Hubo un problema con la solicitud.',
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                });
                            });
                    }
                });
            });
        }
    }
});


//CREAR F - P - TM - TF
document.addEventListener('DOMContentLoaded', function () {
    var urlActual = window.location.href;

    if (urlActual.includes('falda') ||
        urlActual.includes('pantalon') ||
        urlActual.includes('trajeFemenino') ||
        urlActual.includes('trajeMasculino')) {

        var BtnSuccess = document.getElementById('BtnSuccess');
        var form = document.querySelector('form');

        if (BtnSuccess) {
            BtnSuccess.addEventListener('click', function (event) {
                event.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: '¡Éxito!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                window.location.href = data.redirectUrl;
                            });
                        } else {
                            // Mostrar errores específicos
                            let mensajeError = "Revise la información ingresada:\n";
                            for (const [campo, error] of Object.entries(data.errors)) {
                                mensajeError += `${campo}: ${error}\n`;
                            }

                            Swal.fire({
                                title: 'Error',
                                text: mensajeError,
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema con la solicitud.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    });
            });
        }
    }
});




$(document).ready(function () {
    // Inicializar Select2 en el campo de cliente sin tema Bootstrap
    $('#idCliente').select2({
        placeholder: "Seleccione un cliente",
        allowClear: true  // Permite borrar la selección
    });
});

document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#fechaRecoleccion", {
        enableTime: true,           // Habilitar la selección de tiempo
        dateFormat: "Y-m-d H:i",    // Formato de fecha y hora
        time_24hr: true,            // Usar formato de 24 horas
        locale: "es",               // Cambiar el idioma a español
        minuteIncrement: 1          // Incremento de minutos
    });
});



//PAGO

// Verifica si la URL actual coincide con la página "crearVenta"
if (window.location.href.includes('/crearVenta')) {
    // PAGO
    document.addEventListener('DOMContentLoaded', function () {
        const metodoPagoSelect = document.getElementById('metodoPago');
        const modalQR = document.getElementById('modalQR');
        const pagoRealizadoSelect = document.getElementById('pagado');
        const estadoSelect = document.getElementById('estado');

        // Mostrar el modal si se selecciona QR como método de pago
        metodoPagoSelect.addEventListener('change', function () {
            if (metodoPagoSelect.value === 'QR') {
                modalQR.style.display = 'block';
            } else {
                modalQR.style.display = 'none';
            }
        });

        // Cambiar el estado basado en el pago realizado
        pagoRealizadoSelect.addEventListener('change', function () {
            if (pagoRealizadoSelect.value === '1') {
                estadoSelect.value = '1'; // Completado
            } else {
                estadoSelect.value = '0'; // Pendiente
            }
        });
    });

    // Función para cerrar el modal QR
    function cerrarModal() {
        document.getElementById('modalQR').style.display = 'none';
        document.getElementById("metodoPago").value = "Contado"; // Restablece a "Contado" si se cierra el modal
    }
}
function togglePasswordForm() {
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm.style.display === 'none' || passwordForm.style.display === '') {
        passwordForm.style.display = 'block';
    } else {
        passwordForm.style.display = 'none';
    }
}



//TELA IMAGEN
document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname === '/code4/public/telas') {
        // Función para abrir el modal de imagen
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').style.display = 'flex';
        }

        // Función para cerrar el modal de imagen
        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Asigna las funciones a la ventana global si es necesario
        window.openModal = openModal;
        window.closeModal = closeModal;
    }
});









