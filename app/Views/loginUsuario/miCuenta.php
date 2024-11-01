<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/miCuenta.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Mi Cuenta</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <img src="img/logo.png" alt="Descripción de la imagen" id="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nosotros.html">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="diseno.html">Confección</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('mi-cuenta') ?>">Mi Cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.html">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                <button class="btn btn-outline-danger" onclick="sendResetRequest()">¿Olvidaste tu contraseña?</button>
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
        </div>
    </div>

    <footer class="bg-dark text-white p-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h3>Contacta con Nosotros</h3>
                    <a href="https://www.facebook.com/profile.php?id=100054542077029" class="text-white me-2"
                        target="_blank">
                        <img src="img/facebook.png" height="35px" width="35px"> Sastrería Jimenez
                    </a><br>
                    <a href="https://wa.me/59177448360" class="text-white" target="_blank">
                        <img src="img/whatsapp.png" height="35px" width="35px"> 77448360
                    </a>
                    <a href="https://wa.me/59165741113" class="text-white" target="_blank">
                        <img src="img/whatsapp.png" height="35px" width="35px"> 65741113
                    </a>
                </div>
                <div class="col-lg-4">
                    <h3>Información de Contacto</h3>
                    <address>
                        <strong>Sastrería Jimenez</strong><br>
                        Dirección: San Lorenzo - Av-D'Orbigny, Cochabamba<br>
                        Correo Electrónico: lauraximena@gmail.com
                    </address>
                </div>
                <div class="col-lg-3">
                    <h3>Detalles Adicionales</h3>
                    <ul>
                        <li><a href="#" class="text-white">Términos y Condiciones</a></li>
                        <li><a href="#" class="text-white">Detalles de Entrega</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function togglePasswordForm() {
            const form = document.getElementById('passwordForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function sendResetRequest() {
            if (confirm("¿Quieres recibir una nueva contraseña en tu correo?")) {
                window.location.href = "<?= base_url('mi-cuenta/olvidaste-tu-contrasena') ?>";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
</body>

</html>