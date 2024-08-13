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

// Lateral - Menu

document.addEventListener("DOMContentLoaded", () => {
    // Código para manejar la barra lateral y el menú
    const cloud = document.getElementById("cloud");
    const barraLateral = document.querySelector(".barra-lateral");
    const spans = document.querySelectorAll("span");
    const menu = document.querySelector(".menu");
    const main = document.querySelector("main");

    menu?.addEventListener("click", () => {
        barraLateral.classList.toggle("max-barra-lateral");
        if (barraLateral.classList.contains("max-barra-lateral")) {
            menu.children[0].style.display = "none";
            menu.children[1].style.display = "block";
        } else {
            menu.children[0].style.display = "block";
            menu.children[1].style.display = "none";
        }
        if (window.innerWidth <= 320) {
            barraLateral.classList.add("mini-barra-lateral");
            main.classList.add("min-main");
            spans.forEach((span) => {
                span.classList.add("oculto");
            });
        }
    });

    cloud?.addEventListener("click", () => {
        barraLateral.classList.toggle("mini-barra-lateral");
        main.classList.toggle("min-main");
        spans.forEach((span) => {
            span.classList.toggle("oculto");
        });
    });
});


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




// /*Habilita la opcion de poner cuanto pago el cliente
// REVISAR*/
// document.addEventListener("DOMContentLoaded", function() {
//     var pagoSelect = document.getElementById("pago");
//     var montoDiv = document.getElementById("montoDiv");
//     var montoInput = document.getElementById("monto");

//     pagoSelect.addEventListener("change", function() {
//         if (pagoSelect.value === "1") {
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
        const idHeader = table.querySelector('th:nth-child(1)'); // Assumes ID is the first column
        const dateHeader = table.querySelector('#fechaRegistro');
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
            // Sort by ID initially
            sortTable(0, false); // 0 is the index for the ID column
        }

        function toggleDateSort() {
            ascendingDate = !ascendingDate;
            sortTable(6, ascendingDate); // 6 is the index for the "Fecha Registro" column
            dateHeader.classList.toggle('asc', ascendingDate);
            dateHeader.classList.toggle('desc', !ascendingDate);
        }

        dateHeader.addEventListener('click', toggleDateSort);

        // Set initial sort by ID
        setInitialSort();
    });




    // sweetalert2

    function confirmDelete(event, id) {
        event.preventDefault(); // Previene la acción por defecto del enlace

        Swal.fire({
            title: '¿Estás seguro en eliminar al usuario?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, bórralo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('borrar/') ?>" + id;
            }
        });
    }
