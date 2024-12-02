<?= $cabecera ?>
<style>
    /* Estilos para la tabla */
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.075);
    }

    .sortable th {
        cursor: pointer;
        position: relative;
    }

    .sortable th:after {
        content: '↕';
        position: absolute;
        right: 8px;
        color: #fff;
    }

    .sortable th.asc:after {
        content: '↑';
    }

    .sortable th.desc:after {
        content: '↓';
    }

    /* Estilos para impresión */
    @media print {
        .no-print {
            display: none !important;
        }
        
        body {
            background: white !important;
            color: black !important;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, 
        .table td {
            border: 1px solid black !important;
            color: black !important;
            background: white !important;
            padding: 8px;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
        }

        .content-wrapper {
            margin: 0 !important;
            padding: 0 !important;
        }

        .container-fluid {
            padding: 0 !important;
        }
    }
</style>

<div class="container-fluid page-body-wrapper">
<nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="<?= base_url('cliente') ?>">
                <img src="img/logo.png" alt="logo" />
            </a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
            </ul>

            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown border-left">
                    <a class="nav-link count-indicator dropdown-toggle" href="<?= base_url('crear') ?>">
                        <i class="mdi mdi-account-plus"></i>
                    </a>
                </li>

                <li class="nav-item dropdown border-left">
                    <a class="nav-link count-indicator dropdown-toggle" id="confeccionDropdown" href="#" data-bs-toggle="dropdown">
                        <i class="mdi mdi-hanger"></i>
                        <span class="count bg-success"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="confeccionDropdown">
                        <h6 class="p-3 mb-0">Medidas Cliente</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="<?= base_url('trajeMasculino') ?>">
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1">Traje Masculino</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="<?= base_url('trajeFemenino') ?>">
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1">Traje Femenino</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="<?= base_url('pantalon') ?>">
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1">Pantalón</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="<?= base_url('falda') ?>">
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1">Falda</p>
                            </div>
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                        <div class="navbar-profile">
                            <img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg" alt="">
                            <div class="d-none d-sm-block">
                                <?php if (session()->has('user_id')): ?>
                                    <p class="mb-0 navbar-profile-name"><?= session()->get('user_name') ?></p>
                                <?php else: ?>
                                    <p>No estás logueado.</p>
                                <?php endif; ?>
                            </div>
                            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                        <h6 class="p-3 mb-0">Perfil</h6>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('auth/logout') ?>" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-logout text-danger"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Cerrar Sesión</p>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-format-line-spacing"></span>
            </button>
        </div>
    </nav>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h1 class="card-title mb-0">Reporte: Ventas por Cliente</h1>
                                <button onclick="handlePrint()" class="btn btn-primary btn-sm">
    <i class="mdi mdi-printer"></i> Imprimir
</button>
                            </div>

                            <!-- Controles de búsqueda y paginación -->
                            <div class="row mb-3 no-print">
                                <div class="col-md-3">
                                    <select class="form-control form-control-sm" id="perPage">
                                        <option value="5">5 por página</option>
                                        <option value="10" selected>10 por página</option>
                                        <option value="25">25 por página</option>
                                        <option value="50">50 por página</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm" id="searchInput" 
                                           placeholder="Buscar...">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-dark table-hover sortable" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Total Ventas</th>
                                            <th>Monto Total</th>
                                            <th>Promedio por Venta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($ventasPorCliente) && !empty($ventasPorCliente)): ?>
                                            <?php foreach ($ventasPorCliente as $venta): ?>
                                                <tr>
                                                    <td><?= $venta['nombre'] . ' ' . $venta['apellido'] ?></td>
                                                    <td><?= $venta['total_ventas'] ?></td>
                                                    <td><?= number_format($venta['total_monto'], 2) ?> Bs</td>
                                                    <td><?= number_format($venta['total_monto'] / $venta['total_ventas'], 2) ?> Bs</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No hay datos disponibles</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginación -->
                            <div class="d-flex justify-content-between align-items-center mt-3 no-print">
                                <div>
                                    Mostrando <span id="startRange">1</span> - <span id="endRange">10</span> de 
                                    <span id="totalRows">0</span> registros
                                </div>
                                <nav>
                                    <ul class="pagination pagination-sm" id="pagination"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer no-print">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                    Copyright © Sastreria Jimenez
                </span>
            </div>
        </footer>
    </div>
</div>

<script>
let currentPage = 1;
let rowsPerPage = 10;
let tableData = [];
let filteredData = [];

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    initializeTable();
    setupEventListeners();
});

function initializeTable() {
    const table = document.getElementById('dataTable');
    const rows = Array.from(table.getElementsByTagName('tbody')[0].getElementsByTagName('tr'));
    
    tableData = rows.map(row => ({
        element: row,
        data: Array.from(row.getElementsByTagName('td')).map(cell => cell.textContent.trim())
    }));
    
    filteredData = [...tableData];
    updateTable();
}

function setupEventListeners() {
    document.getElementById('perPage').addEventListener('change', function(e) {
        rowsPerPage = parseInt(e.target.value);
        currentPage = 1;
        updateTable();
    });

    document.getElementById('searchInput').addEventListener('keyup', function(e) {
        currentPage = 1;
        filterTable(e.target.value.toLowerCase());
    });

    document.querySelectorAll('.sortable th').forEach((header, index) => {
        header.addEventListener('click', () => sortTable(index));
    });
}

function filterTable(searchTerm) {
    if (!searchTerm) {
        filteredData = [...tableData];
    } else {
        filteredData = tableData.filter(row => 
            row.data.some(cell => cell.toLowerCase().includes(searchTerm))
        );
    }
    updateTable();
}

function sortTable(columnIndex) {
    const th = document.querySelectorAll('.sortable th')[columnIndex];
    const isAsc = !th.classList.contains('asc');
    
    document.querySelectorAll('.sortable th').forEach(header => {
        header.classList.remove('asc', 'desc');
    });
    th.classList.add(isAsc ? 'asc' : 'desc');

    filteredData.sort((a, b) => {
        let valueA = a.data[columnIndex];
        let valueB = b.data[columnIndex];

        // Convertir a números si es posible
        if (!isNaN(valueA) && !isNaN(valueB)) {
            valueA = parseFloat(valueA);
            valueB = parseFloat(valueB);
        }

        if (valueA < valueB) return isAsc ? -1 : 1;
        if (valueA > valueB) return isAsc ? 1 : -1;
        return 0;
    });

    updateTable();
}

function updateTable() {
    const tbody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    
    tbody.innerHTML = '';
    
    filteredData.slice(start, end).forEach(row => {
        tbody.appendChild(row.element.cloneNode(true));
    });

    updatePagination();
    updatePaginationInfo();
}

function updatePaginationInfo() {
    const total = filteredData.length;
    const start = Math.min((currentPage - 1) * rowsPerPage + 1, total);
    const end = Math.min(start + rowsPerPage - 1, total);
    
    document.getElementById('startRange').textContent = start;
    document.getElementById('endRange').textContent = end;
    document.getElementById('totalRows').textContent = total;
}

function updatePagination() {
    const pagination = document.getElementById('pagination');
    const totalPages = Math.ceil(filteredData.length / rowsPerPage);
    
    let html = `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(1)">«</a>
        </li>
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">‹</a>
        </li>
    `;

    for (let i = Math.max(1, currentPage - 2); i <= Math.min(totalPages, currentPage + 2); i++) {
        html += `
            <li class="page-item ${currentPage === i ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
            </li>
        `;
    }

    html += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">›</a>
        </li>
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${totalPages})">»</a>
        </li>
    `;

    pagination.innerHTML = html;
}

function changePage(page) {
    const totalPages = Math.ceil(filteredData.length / rowsPerPage);
    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        updateTable();
    }
}

function handlePrint() {
    // Preparar vista de impresión
    const printContent = document.createElement('div');
    printContent.innerHTML = `
        <div class="print-header">
            <img src="${base_url}/assets/images/logo.png" alt="Logo">
            <h2>Sastrería Jimenez</h2>
            <h3>Reporte de Ventas por Cliente</h3>
            <p>Fecha: ${new Date().toLocaleString()}</p>
        </div>
    `;

    // Clonar tabla actual
    const table = document.getElementById('dataTable').cloneNode(true);
    
    // Remover columnas de acciones si existen
    const actionCells = table.querySelectorAll('.action-column');
    actionCells.forEach(cell => cell.remove());

    // Agregar tabla al contenido de impresión
    printContent.appendChild(table);

    // Agregar pie de página
    printContent.innerHTML += `
        <div class="print-footer">
            <p>Generado el ${new Date().toLocaleString()}</p>
            <p>Página 1 de 1</p>
        </div>
    `;

    // Crear iframe para impresión
    const printFrame = document.createElement('iframe');
    printFrame.style.display = 'none';
    document.body.appendChild(printFrame);

    // Escribir contenido en el iframe
    printFrame.contentDocument.write(`
        <html>
            <head>
                <title>Reporte de Ventas por Cliente - Sastrería Jimenez</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                    th { background-color: #f0f0f0; }
                    .print-header { text-align: center; margin-bottom: 30px; }
                    .print-header img { height: 60px; }
                    .print-footer { text-align: center; margin-top: 30px; font-size: 12px; }
                    td:nth-child(2), td:nth-child(3), td:nth-child(4) { 
                        text-align: right; 
                    }
                    @media print {
                        .print-footer { position: fixed; bottom: 0; width: 100%; }
                    }
                </style>
            </head>
            <body>
                ${printContent.innerHTML}
            </body>
        </html>
    `);

    // Imprimir y limpiar
    printFrame.contentWindow.focus();
    printFrame.contentWindow.print();
    setTimeout(() => {
        document.body.removeChild(printFrame);
    }, 500);
}

// Agregar esta variable si no existe
const base_url = '<?= base_url() ?>';
</script>

<?= $pie ?>