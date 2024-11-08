<!DOCTYPE html>
<html lang="es">

<head>
    <title>Sastreria Jimenez</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?= base_url('assets1/img/apple-icon.png') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.ico') ?>">

    <link rel="stylesheet" href="<?= base_url('assets1/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/css/templatemo.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/css/custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/tela.css') ?>">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="<?= base_url('assets1/css/fontawesome.min.css') ?>">

</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-dark logo h2 align-self-center" href="<?= base_url('index.html') ?>">
                Sastreria Jimenez
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('index.html') ?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('nosotros.html') ?>">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/telaTraje') ?>">Confección</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('contacto.html') ?>">Contactos</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <a class="nav-icon position-relative text-decoration-none" href="<?= base_url('mi-cuenta') ?>">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span
                            class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark ">Login</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->


    <div class="container mt-5">
        <h1 class="text-center">Reserva de Tela</h1>

        <?php if (session('mensaje')): ?>
            <div class="alert alert-success" role="alert">
                <?= session('mensaje') ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <h3><?= esc($tela['nombre']) ?></h3>
                <p><strong>Descripción:</strong> <?= esc($tela['descripcion']) ?></p>
                <p><strong>Precio:</strong> <?= esc($tela['precio']) ?>Bs</p>

                <form action="<?= site_url('/reservas/guardar') ?>" method="post">
                    <?= csrf_field() ?>

                    <input type="hidden" name="idTela" value="<?= esc($tela['id']) ?>">

                    <div class="form-group">
                        <label for="fechaReserva">Fecha de Reserva</label>
                        <input type="date" id="fechaReserva" name="fechaReserva" class="form-control" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
                        <a href="<?= site_url('/sastreria/telaTraje') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark mt-5" id="tempaltemo_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-5">
                    <h3 class="text-success">Contacta con Nosotros</h3>
                    <div>
                        <a id="whatsapp-link" href="https://wa.me/59177448360" class="text-success" target="_blank">
                            <img src="https://img.icons8.com/?size=100&id=d5ntEsf0JRhM&format=png&color=000000"
                                height="35px" width="35px">77448360
                        </a> &nbsp;&nbsp;
                        <a id="whatsapp-link" href="https://wa.me/59165741113" class="text-success" target="_blank">
                            <img src="https://img.icons8.com/?size=100&id=d5ntEsf0JRhM&format=png&color=000000"
                                height="35px" width="35px">65741113
                        </a> <br>
                        <a id="facebook-link" href="https://www.facebook.com/profile.php?id=100054542077029"
                            class="text-success" target="_blank">
                            <img src="https://img.icons8.com/?size=100&id=118497&format=png&color=000000" height="35px"
                                width="35px"> Sastreria Jimenez
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-center text-light">
                            Copyright &copy; | Sastreria Jimenez
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?= base_url('assets1/js/jquery-1.11.0.min.js') ?>"></script>
    <script src="<?= base_url('assets1/js/jquery-migrate-1.2.1.min.js') ?>"></script>
    <script src="<?= base_url('assets1/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets1/js/templatemo.js') ?>"></script>
    <script src="<?= base_url('assets1/js/custom.js') ?>"></script>
</body>

</html>