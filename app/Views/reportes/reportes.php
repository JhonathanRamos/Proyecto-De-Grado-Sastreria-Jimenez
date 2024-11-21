<?= $cabecera ?>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="index.html"><img src="img/logo.png" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="img/miniLogo.png" alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">

                        <div class="profile-pic">
                            <?php if (session()->has('user_id')): ?>
                                <div class="count-indicator">
                                    <img class="img-xs rounded-circle " src="assets/images/faces/face15.jpg" alt="">
                                    <span class="count bg-success"></span>
                                </div>
                                <div class="profile-name">
                                    <h5 class="mb-0 font-weight-normal"> <?= session()->get('user_name') ?></h5>
                                    <span class="nombre">
                                        <?php if (session()->get('user_role') == 1): ?>
                                            Administrador:
                                        <?php else: ?>
                                            <?= session()->get('user_name') ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            <?php else: ?>
                                <p>No estás logueado.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navegación</span>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('usuarios') ?>">
                        <span class="menu-icon">
                            <i class="mdi mdi-account-box-multiple"></i>
                        </span>
                        <span class="menu-title">Usuarios</span>
                    </a>
                </li>


                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('cliente') ?>">
                        <span class="menu-icon">
                            <i class="mdi mdi-account"></i>
                        </span>
                        <span class="menu-title">Datos Cliente</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                        aria-controls="auth">
                        <span class="menu-icon">
                            <i class="mdi mdi-hanger"></i>
                        </span>
                        <span class="menu-title">Datos Medidas</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="<?= base_url('datosTrajeMasculino') ?>">Traje
                                    Masculino</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('datosTrajeFemenino') ?>">Traje
                                    Femenino</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="<?= base_url('datosPantalon') ?>">Pantalon</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('datosFalda') ?>">Falda</a>
                            </li>
                        </ul>
                    </div>
                </li>






                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('confeccion') ?>">
                        <span class="menu-icon">
                            <i class="mdi mdi-invoice-text-edit"></i>
                        </span>
                        <span class="menu-title"> Confeccion</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('venta') ?>">
                        <span class="menu-icon">
                            <i class="mdi mdi-cash-register"></i>
                        </span>
                        <span class="menu-title"> Venta</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('reportes') ?>">
                        <span class="menu-icon">
                            <i class="mdi mdi-database-search"></i>
                        </span>
                        <span class="menu-title"> Reportes</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('telas') ?>">
                        <span class="menu-icon">
                            <i class="mdi mdi-view-dashboard-edit"></i>
                        </span>
                        <span class="menu-title"> Telas Traje</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="<?= base_url('cliente') ?>"><img src="img/logo.png"
                            alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100">
                        <!-- <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li> -->
                    </ul>

                    <ul class="navbar-nav navbar-nav-right">

                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" href="<?= base_url('crear') ?>">
                                <i class="mdi mdi-account-plus"></i>
                                <!-- <span class="count bg-success"></span> -->
                            </a>

                        </li>

                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" href="<?= base_url('crearVenta') ?>">
                                <i class="mdi mdi-cash"></i>
                                <!-- <span class="count bg-success"></span> -->
                            </a>

                        </li>


                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="confeccionDropdown" href="#"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-hanger"></i>
                                <span class="count bg-success"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                                aria-labelledby="confeccionDropdown">
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
                                            <small>
                                                <?php if (session()->get('user_role') == 1): ?>
                                                <?php else: ?>
                                                <?php endif; ?>
                                            </small>
                                        <?php else: ?>
                                            <p>No estás logueado.</p>
                                        <?php endif; ?>
                                    </div>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Ajuste</h6>
                                <div class="dropdown-divider"></div>
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
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">





                        <div class="container">
                            <h1 class="card-title">Reportes Generales</h1>
                            <div class="mb-3">
                                <!-- Botones para Exportar Clientes Activos e Inactivos -->
                                <a href="<?= site_url('/exportarPDF/estadoClientes/activos') ?>" class="btn btn-primary"
                                    target="_blank">Exportar Clientes Activos</a>
                                <a href="<?= site_url('/exportarPDF/estadoClientes/inactivos') ?>"
                                    class="btn btn-secondary" target="_blank">Exportar Clientes Inactivos</a>

                                <!-- Botón para Exportar Deudores -->
                                <a href="<?= site_url('/exportarPDF/deudores') ?>" class="btn btn-warning"
                                    target="_blank">Exportar Deudores</a>

                                <!-- Botón para Exportar Deuda por Cliente -->
                                <a href="<?= site_url('/exportarPDF/deudaPorCliente') ?>" class="btn btn-primary"
                                    target="_blank">Exportar Deuda por Cliente</a>
                            </div>

                            <div class="table-responsive">
                                <!-- Aquí puedes incluir tablas similares a las de ventas, con los datos correspondientes a cada reporte -->
                            </div>
                        </div>









                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                            Sastreria Jimenez</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <?= $pie ?>