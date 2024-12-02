<?= $cabecera ?>
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
                                <h1 class="card-title mb-0">Análisis de Confecciones y Servicios</h1>
                                <button onclick="window.print()" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-printer"></i> Imprimir
                                </button>
                            </div>

                            <!-- Resumen en tarjetas -->
                            <div class="row mb-4">
                                <?php
                                $totalIngresos = array_sum(array_column($confecciones, 'ingresos_totales'));
                                $totalVentas = array_sum(array_column($confecciones, 'unidades_vendidas'));
                                $totalPendientes = array_sum(array_column($confecciones, 'trabajos_pendientes'));
                                ?>
                                <div class="col-xl-3 col-sm-6 mb-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body">
                                            <h5>Total Ingresos</h5>
                                            <h3><?= number_format($totalIngresos, 2) ?> Bs</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 mb-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <h5>Unidades Vendidas</h5>
                                            <h3><?= $totalVentas ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 mb-3">
                                    <div class="card bg-info text-white">
                                        <div class="card-body">
                                            <h5>Trabajos Pendientes</h5>
                                            <h3><?= $totalPendientes ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 mb-3">
                                    <div class="card bg-warning text-white">
                                        <div class="card-body">
                                            <h5>Promedio por Venta</h5>
                                            <h3><?= number_format($totalIngresos / $totalVentas, 2) ?> Bs</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabla detallada -->
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th>Confección/Servicio</th>
                                            <th>Categoría</th>
                                            <th>Unidades Vendidas</th>
                                            <th>Ingresos Totales</th>
                                            <th>Precio Promedio</th>
                                            <th>Clientes Únicos</th>
                                            <th>Completados</th>
                                            <th>Pendientes</th>
                                            <th>% del Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($confecciones as $conf): ?>
                                            <tr>
                                                <td><?= $conf['descripcion'] ?></td>
                                                <td>
                                                    <span class="badge <?= $conf['categoria'] == 'Confeccion' ? 'bg-success' : 'bg-info' ?>">
                                                        <?= $conf['categoria'] ?>
                                                    </span>
                                                </td>
                                                <td><?= $conf['unidades_vendidas'] ?></td>
                                                <td><?= number_format($conf['ingresos_totales'], 2) ?> Bs</td>
                                                <td><?= number_format($conf['precio_promedio'], 2) ?> Bs</td>
                                                <td><?= $conf['clientes_unicos'] ?></td>
                                                <td><?= $conf['trabajos_completados'] ?></td>
                                                <td><?= $conf['trabajos_pendientes'] ?></td>
                                                <td><?= number_format(($conf['ingresos_totales'] / $totalIngresos) * 100, 1) ?>%</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Gráfico de distribución -->
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="chart-container" style="position: relative; height:400px;">
                                        <canvas id="ingresosPorConfeccion"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="chart-container" style="position: relative; height:400px;">
                                        <canvas id="unidadesVendidas"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © Sastreria Jimenez</span>
            </div>
        </footer>
    </div>
</div>

<!-- Scripts para los gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos para los gráficos
    const confecciones = <?= json_encode($confecciones) ?>;
    
    // Gráfico de ingresos
    new Chart(document.getElementById('ingresosPorConfeccion'), {
        type: 'bar',
        data: {
            labels: confecciones.map(c => c.descripcion),
            datasets: [{
                label: 'Ingresos Totales (Bs)',
                data: confecciones.map(c => c.ingresos_totales),
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: { color: '#ffffff' }
                },
                title: {
                    display: true,
                    text: 'Ingresos por Confección/Servicio',
                    color: '#ffffff'
                }
            },
            scales: {
                y: {
                    ticks: { color: '#ffffff' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                },
                x: {
                    ticks: { color: '#ffffff' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                }
            }
        }
    });

    // Gráfico de unidades vendidas
    new Chart(document.getElementById('unidadesVendidas'), {
        type: 'pie',
        data: {
            labels: confecciones.map(c => c.descripcion),
            datasets: [{
                data: confecciones.map(c => c.unidades_vendidas),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: { color: '#ffffff' }
                },
                title: {
                    display: true,
                    text: 'Distribución de Unidades Vendidas',
                    color: '#ffffff'
                }
            }
        }
    });
});
</script>
<?= $pie ?>