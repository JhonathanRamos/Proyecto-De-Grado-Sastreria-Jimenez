// Verificar si estamos en la página correcta antes de ejecutar el código
if (window.location.href.includes('cliente') || window.location.href.includes('datosFalda') || window.location.href.includes('datosPantalon') || window.location.href.includes('datosTrajeFemenino') || window.location.href.includes('datosTrajeMasculino')) {

    function filterTable() {
        var input = document.getElementById('search');
        var filter = input.value.toLowerCase();
        var table = document.getElementById('clientesTable');
        var tr = table.getElementsByTagName('tr');
        
        for (var i = 1; i < tr.length; i++) {  // Empieza desde 1 para omitir el encabezado
            var td = tr[i].getElementsByTagName('td');
            var found = false;
            
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    var txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;  // Salir del bucle si encuentra coincidencia
                    }
                }
            }
            
            if (found) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }

    // Agregar el evento input para la búsqueda en tiempo real
    document.getElementById('search').addEventListener('input', filterTable);

    // Agregar el evento keydown para la tecla Enter
    document.getElementById('search').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            filterTable();
        }
    });
}


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

// // Lateral - Menu

// document.addEventListener("DOMContentLoaded", () => {
//     // Código para manejar la barra lateral y el menú
//     const cloud = document.getElementById("cloud");
//     const barraLateral = document.querySelector(".barra-lateral");
//     const spans = document.querySelectorAll("span");
//     const menu = document.querySelector(".menu");
//     const main = document.querySelector("main");

//     menu?.addEventListener("click", () => {
//         barraLateral.classList.toggle("max-barra-lateral");
//         if (barraLateral.classList.contains("max-barra-lateral")) {
//             menu.children[0].style.display = "none";
//             menu.children[1].style.display = "block";
//         } else {
//             menu.children[0].style.display = "block";
//             menu.children[1].style.display = "none";
//         }
//         if (window.innerWidth <= 320) {
//             barraLateral.classList.add("mini-barra-lateral");
//             main.classList.add("min-main");
//             spans.forEach((span) => {
//                 span.classList.add("oculto");
//             });
//         }
//     });

//     cloud?.addEventListener("click", () => {
//         barraLateral.classList.toggle("mini-barra-lateral");
//         main.classList.toggle("min-main");
//         spans.forEach((span) => {
//             span.classList.toggle("oculto");
//         });
//     });
// });


// document.addEventListener("DOMContentLoaded", () => {
//     // Aplica el modo oscuro por defecto
//     document.body.classList.add("dark-mode");

//     // Código para manejar la barra lateral y el menú
//     if (window.location.href.includes('cliente') || 
//         window.location.href.includes('datosFalda') || 
//         window.location.href.includes('datosPantalon') || 
//         window.location.href.includes('datosTrajeFemenino') || 
//         window.location.href.includes('datosTrajeMasculino')) {

//         const cloud = document.getElementById("cloud");
//         const barraLateral = document.querySelector(".barra-lateral");
//         const spans = document.querySelectorAll("span");
//         const palanca = document.querySelector(".switch");
//         const circulo = document.querySelector(".circulo");
//         const menu = document.querySelector(".menu");
//         const main = document.querySelector("main");

//         menu?.addEventListener("click", () => {
//             barraLateral.classList.toggle("max-barra-lateral");
//             if (barraLateral.classList.contains("max-barra-lateral")) {
//                 menu.children[0].style.display = "none";
//                 menu.children[1].style.display = "block";
//             } else {
//                 menu.children[0].style.display = "block";
//                 menu.children[1].style.display = "none";
//             }
//             if (window.innerWidth <= 320) {
//                 barraLateral.classList.add("mini-barra-lateral");
//                 main.classList.add("min-main");
//                 spans.forEach((span) => {
//                     span.classList.add("oculto");
//                 });
//             }
//         });

//         palanca?.addEventListener("click", () => {
//             document.body.classList.toggle("dark-mode");
//             circulo.classList.toggle("prendido");
//         });

//         cloud?.addEventListener("click", () => {
//             barraLateral.classList.toggle("mini-barra-lateral");
//             main.classList.toggle("min-main");
//             spans.forEach((span) => {
//                 span.classList.toggle("oculto");
//             });
//         });
//     }
// });




// /*Habilita la opcion de poner cuanto adelanto el cliente
// REVISAR*/
// document.addEventListener("DOMContentLoaded", function() {
//     var adelantoSelect = document.getElementById("adelanto");
//     var montoDiv = document.getElementById("montoDiv");
//     var montoInput = document.getElementById("monto");

//     adelantoSelect.addEventListener("change", function() {
//         if (adelantoSelect.value === "1") {
//             montoDiv.style.display = "block";
//             montoInput.setAttribute("required", "required");
//         } else {
//             montoDiv.style.display = "none";
//             montoInput.removeAttribute("required");
//         }
//     });
// });


//FECHA DE REGISTRO ORDEN 

document.addEventListener('DOMContentLoaded', function() {
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

    


    //PARA GUARDAR CON SWETALERT2
    // document.getElementById('guardarBtn').addEventListener('click', function() {
    //     Swal.fire({
    //         title: '¿Estás seguro?',
    //         text: "¡Asegúrate de que todos los datos son correctos antes de guardar!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Guardar',
    //         cancelButtonText: 'Cancelar'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // Envía el formulario si el usuario confirma
    //             document.getElementById('miFormulario').submit();
    //         }
    //     });
    // });
    
    //GUARDAR EDITANDO
    document.addEventListener('DOMContentLoaded', function() {
        // Obtén la URL actual
        var urlActual = window.location.href;
        console.log(urlActual);
    
        var guardarBtn = document.getElementById('guardarBtn');
        var form = document.querySelector('form');
    
        if (guardarBtn) {
            guardarBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto del botón
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
                        // Muestra mensaje de carga
                        Swal.fire({
                            title: 'Guardando...',
                            text: 'Por favor, espera mientras se guardan los cambios.',
                            icon: 'info',
                            allowOutsideClick: false,
                            showConfirmButton: false
                        });
    
                        // Envía el formulario mediante una solicitud fetch
                        fetch(form.action, {
                            method: 'POST',
                            body: new FormData(form)
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire({
                                    title: '¡Éxito!',
                                    text: 'Los cambios se han guardado correctamente.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Aceptar'
                                }).then(() => {
                                    // Redirige según la URL actual
                                    if (urlActual.includes('editartrajeFemenino')) {
                                        window.location.href = 'http://localhost/code4/public/datosTrajeFemenino'; // URL para editar traje femenino
                                    } else if (urlActual.includes('editartrajeMasculino')) {
                                        window.location.href = 'http://localhost/code4/public/datosTrajeMasculino'; // URL para editar traje masculino
                                    } else if (urlActual.includes('editarFalda')) {
                                        window.location.href = 'http://localhost/code4/public/datosFalda'; // URL para editar falda
                                    } else if (urlActual.includes('editarPantalon')) {
                                        window.location.href = 'http://localhost/code4/public/datosPantalon'; // URL para editar pantalón
                                    } else {
                                        window.location.href = 'http://localhost/code4/public/cliente'; // URL para editar cliente
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Hubo un problema al guardar los cambios. Inténtalo de nuevo.',
                                    icon: 'error',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Aceptar'
                                });
                            }
                        }).catch(() => {
                            Swal.fire({
                                title: 'Error',
                                text: 'Hubo un problema al conectar con el servidor. Inténtalo de nuevo.',
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Aceptar'
                            });
                        });
                    }
                });
            });
        }
    
        // Permite que 'Enter' funcione como tabulador y en el botón "Guardar"
        if (urlActual.includes('editar') || 
            urlActual.includes('editarFalda') || 
            urlActual.includes('editarPantalon') || 
            urlActual.includes('editarTrajeFemenino') || 
            urlActual.includes('editarTrajeMasculino')) {
    
            if (form) {
                form.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        // Si el foco está en el botón "Guardar"
                        if (document.activeElement === guardarBtn) {
                            guardarBtn.click(); // Simula un clic en el botón
                            event.preventDefault(); // Previene el comportamiento por defecto del 'Enter'
                        } else {
                            // Deja que 'Enter' funcione normalmente para campos de formulario
                            const focusableElements = Array.from(form.querySelectorAll('input, select, textarea, button')).filter(el => !el.disabled);
                            const currentIndex = focusableElements.indexOf(event.target);
                            if (currentIndex > -1 && currentIndex < focusableElements.length - 1) {
                                focusableElements[currentIndex + 1].focus();
                                event.preventDefault(); // Previene el comportamiento por defecto del 'Enter'
                            }
                        }
                    }
                });
            }
        }
    });

    
    
    
    
    
    document.addEventListener('DOMContentLoaded', function() {
        // Obtén la URL actual
        var urlActual = window.location.href;
    
        // Verifica si la URL contiene 'crear'
        if (urlActual.includes('crear')) {
            const form = document.querySelector('form');
            const guardarBtn = document.getElementById('guardarBtnUsuario');
    
            if (guardarBtn) {
                guardarBtn.addEventListener('click', function(event) {
                    event.preventDefault(); // Previene el comportamiento por defecto del botón
    
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
                                        window.location.href = data.redirectUrl; // Redirige a la página deseada
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: data.message,
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
    
                // Permite que 'Enter' funcione como tabulador y en el botón "Guardar"
                form.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        // Si el foco está en el botón "Guardar"
                        if (document.activeElement === guardarBtn) {
                            guardarBtn.click(); // Simula un clic en el botón
                            event.preventDefault(); // Previene el envío del formulario
                        } else {
                            // Deja que 'Enter' funcione normalmente para campos de formulario
                            const focusableElements = Array.from(form.querySelectorAll('input, select, textarea, button')).filter(el => !el.disabled);
                            const currentIndex = focusableElements.indexOf(event.target);
                            if (currentIndex > -1 && currentIndex < focusableElements.length - 1) {
                                focusableElements[currentIndex + 1].focus();
                                event.preventDefault(); // Previene el envío del formulario
                            }
                        }
                    }
                });
            }
        }
    });
    
    
    
    //Crear falda , pantalon , trajeFemenino , TrajeMasculino
    document.addEventListener('DOMContentLoaded', function() {
        // Obtén la URL actual
        var urlActual = window.location.href;
    
        // Verifica si la URL contiene alguna de las cadenas especificadas
        if (urlActual.includes('falda') || 
            urlActual.includes('pantalon') || 
            urlActual.includes('trajeFemenino') || 
            urlActual.includes('trajeMasculino')) {
    
            // Solo añade el event listener si la URL es válida
            var BtnSuccess = document.getElementById('BtnSuccess');
            var form = document.querySelector('form');
    
            if (BtnSuccess) {
                // Maneja el clic en el botón "Guardar"
                BtnSuccess.addEventListener('click', function(event) {
                    event.preventDefault(); // Previene el comportamiento por defecto del botón
                    Swal.fire({
                        title: '¡Éxito!',
                        text: "Medidas guardadas con éxito.",
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Envía el formulario si el usuario confirma
                            form.submit();
                        }
                    });
                });
            }
    
            if (form) {
                // Permite que 'Enter' funcione como tabulador y en el botón "Guardar"
                form.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        // Si el foco está en el botón "Guardar"
                        if (document.activeElement === BtnSuccess) {
                            BtnSuccess.click(); // Simula un clic en el botón
                            event.preventDefault(); // Previene el envío del formulario
                        } else {
                            // Deja que 'Enter' funcione normalmente para campos de formulario
                            const focusableElements = Array.from(form.querySelectorAll('input, select, textarea, button')).filter(el => !el.disabled);
                            const currentIndex = focusableElements.indexOf(event.target);
                            if (currentIndex > -1 && currentIndex < focusableElements.length - 1) {
                                focusableElements[currentIndex + 1].focus();
                                event.preventDefault(); // Previene el envío del formulario
                            }
                        }
                    }
                });
            }
        }
    });
    
    
    
    