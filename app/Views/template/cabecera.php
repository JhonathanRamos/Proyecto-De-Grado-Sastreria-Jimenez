<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sastreria Jimenez</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/ti-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jvectormap/jquery-jvectormap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/flag-icon-css/css/flag-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/owl-carousel-2/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/owl-carousel-2/owl.theme.default.min.css') ?>">

    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/estilo2.css') ?>">

    <!-- Select2 CSS -->
    <link href="<?= base_url('assets/vendors/select2/select2.min.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/vendors/select2/select2-bootstrap-theme.min.css'); ?>" rel="stylesheet" />

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('img/logo.png') ?>">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('public/css/estilo.css') ?>">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
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
                    <a class="nav-link" data-bs-toggle="collapse" href="#reporte" aria-expanded="false"
                        aria-controls="reporte">
                        <span class="menu-icon">
                            <i class="mdi mdi-hanger"></i>
                        </span>
                        <span class="menu-title">Reportes</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="reporte">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('reporte1') ?>">Tela Mas Reservada</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('reporte2') ?>">Venta Por Cliente</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('reporte3') ?>">Detalle De Venta</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('reporte4') ?>">Venta Metodo De Pago</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('reporte5') ?>">Analisis de servicios</a></li>
                        </ul>
                    </div>
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