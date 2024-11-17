<!DOCTYPE html>
<html lang="es">

<head>
    <title>Sastreria Jimenez</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets1/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/css/templatemo.css">
    <link rel="stylesheet" href="assets1/css/custom.css">
    <link rel="stylesheet" href="<?= base_url('css/miCuenta.css') ?>">




    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets1/css/fontawesome.min.css">
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-dark logo h2 align-self-center" href="index.html">
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
                            <a class="nav-link" href="index.html">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nosotros.html">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/telaTraje') ?>">Confección</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.html">Contactos</a>
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
    <!-- Close Header -->

    <div class="mi-cuenta-contenedor">
        <div class="container my-5">

            <h1 class="text-center">Mi Cuenta</h1>

            <!-- Mensajes de éxito o error -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- Información del usuario -->
            <div class="user-info mb-4 p-4 border rounded">
                <h2>Información del Usuario</h2>
                <p><strong>Nombre:</strong> <?= session()->get('user_name') ?></p>
                <p><strong>Correo:</strong> <?= session()->get('user_email') ?></p>
            </div>

            <!-- Botones para cambiar y olvidar contraseña -->
            <div class="d-flex justify-content-between mb-4">
                <button class="btn btn-primary" onclick="togglePasswordForm()">Cambiar Contraseña</button>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Cerrar Sesión</a>
            </div>

            <!-- Formulario para cambiar la contraseña -->
            <div id="passwordForm" class="password-form p-4 border rounded" style="display: none;">
                <h2>Cambiar Contraseña</h2>
                <form action="<?= base_url('mi-cuenta/cambiar-contrasena') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva Contraseña:</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Contraseña:</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" onclick="togglePasswordForm()">Cancelar</button>
                    </div>
                </form>
            </div>

            Listado de Reservas
            <div class="user-info mb-4 p-4 border rounded">
                <h2>Mis Reservas</h2>
                <?php if (empty($reservas)): ?>
                    <p>No tienes reservas realizadas.</p>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha de Reserva</th>
                                <th>Tela</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservas as $reserva): ?>
                                <tr>
                                    <td><?= $reserva['fechaReserva'] ?></td>
                                    <td><?= $reserva['nombreTela'] ?></td>
                                    <td><?= $reserva['precio'] ?></td>
                                    <td>
                                        <a href="<?= base_url('reservas/cancelar/' . $reserva['id']) ?>" class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de que deseas cancelar esta reserva?');">Cancelar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>



        </div>
    </div>

    <script>
        function togglePasswordForm() {
            const passwordForm = document.getElementById("passwordForm");
            passwordForm.style.display = (passwordForm.style.display === "none") ? "block" : "none";
        }
    </script>



    <!-- Start Footer -->
    <footer class="bg-dark text-light pt-5">
        <div class="container">
            <div class="row">
                <!-- Contact Section -->
                <div class="col-md-4 mb-3">
                    <h3 class="text-success">Contacta con Nosotros</h3>
                    <div>
                        <a href="https://wa.me/59177448360" class="text-success d-block mb-2" target="_blank">
                            <img src="https://img.icons8.com/?size=100&id=d5ntEsf0JRhM&format=png&color=000000"
                                height="35px" width="35px">
                            77448360
                        </a>
                        <a href="https://wa.me/59165741113" class="text-success d-block mb-2" target="_blank">
                            <img src="https://img.icons8.com/?size=100&id=d5ntEsf0JRhM&format=png&color=000000"
                                height="35px" width="35px">
                            65741113
                        </a>
                    </div>
                    <a href="https://www.facebook.com/profile.php?id=100054542077029" class="text-success d-block mb-2"
                        target="_blank">
                        <img src="https://img.icons8.com/?size=100&id=118497&format=png&color=000000" height="35px"
                            width="35px">
                        Sastreria Jimenez
                    </a>
                </div>

                <!-- Quick Links Section -->
                <div class="col-md-4 mb-3">
                    <h3 class="text-success">Enlaces Rápidos</h3>
                    <ul class="list-unstyled">
                        <li><a href="index.html" class="text-light text-decoration-none">Inicio</a></li>
                        <li><a href="nosotros.html" class="text-light text-decoration-none">Nosotros</a></li>
                        <li><a href="shop.html" class="text-light text-decoration-none">Confección</a></li>
                        <li><a href="contacto.html" class="text-light text-decoration-none">Contacto</a></li>
                    </ul>
                </div>

                <!-- About Section -->
                <div class="col-md-4 mb-3">
                    <h3 class="text-success">Sobre Nosotros</h3>
                    <p class="small">Sastrería Jimenez es su lugar de confianza para confecciones de alta calidad y un
                        servicio excepcional. Contáctenos para más información y servicios personalizados.</p>
                </div>
            </div>
        </div>

        <div class="bg-black py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="mb-0">Copyright &copy; | Sastreria Jimenez</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->


    <!-- Start Script -->
    <script src="assets1/js/jquery-1.11.0.min.js"></script>
    <script src="assets1/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets1/js/bootstrap.bundle.min.js"></script>
    <script src="assets1/js/templatemo.js"></script>
    <script src="assets1/js/custom.js"></script>
    <script src="js/custom.js"></script>
    <!-- End Script -->
</body>

</html>