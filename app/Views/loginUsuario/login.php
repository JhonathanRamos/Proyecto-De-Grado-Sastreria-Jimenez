<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión o Registrarse</title>
    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/login.css') ?>">
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Formulario de Inicio de Sesión -->
                <form action="<?= site_url('auth/login') ?>" method="post" class="sign-in-form">
                    <?= csrf_field() ?>
                    <h2 class="title">Iniciar Sesión</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" placeholder="Correo Electrónico" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Contraseña" id="id_password" required>
                        <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </div>
                    <button type="submit" class="btn solid">Iniciar Sesión</button>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="error-message"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                </form>

                <!-- Formulario de Registro -->
                <form action="<?= site_url('auth/register') ?>" method="post" class="sign-up-form">
                    <?= csrf_field() ?>
                    <h2 class="title">Registrarse</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nombres" placeholder="Nombre" required >
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="apellidos" placeholder="Apellido" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Correo Electrónico" required >
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="celular" placeholder="Celular" required>
                    </div>
                    <button type="submit" class="btn solid">Registrarse</button>
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="success-message"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="error-message"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>¿No tienes una cuenta?</h3>
                    <p>Crea tu cuenta ahora para seguir a otras personas y dar "me gusta" a publicaciones.</p>
                    <button class="btn transparent" id="sign-up-btn">Registrarse</button>
                </div>
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para ver tus notificaciones y publicar tus fotos favoritas.</p>
                    <button class="btn transparent" id="sign-in-btn">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/login.js"></script>
</body>

</html>
