<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión y Registro</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/login.css') ?>">
</head>
<body>

<div class="form-structor">
    <!-- Formulario de Registro -->
    <div class="signup slide-up"> 
        <h2 class="form-title" id="signup"><span>o</span>Registrarse</h2>
        <form action="<?= site_url('auth/register') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-holder">
                <input type="text" class="input" name="nombres" placeholder="Nombre" required />
                <input type="text" class="input" name="apellidos" placeholder="Apellido" required />
                <input type="email" class="input" name="email" placeholder="Correo Electrónico" required />
                <input type="password" class="input" name="password" placeholder="Contraseña" required />
                <input type="text" class="input" name="celular" placeholder="Celular" required />
            </div>
            <button type="submit" class="submit-btn">Registrarse</button>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="success-message"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="error-message"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
        </form>
    </div>
    
    <!-- Formulario de Inicio de Sesión -->
    <div class="login"> 
        <div class="center">
            <h2 class="form-title" id="login"><span>o</span>Iniciar Sesión</h2>
            <form action="<?= site_url('auth/login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-holder">
                <input type="email" class="input" name="email" placeholder="Correo Electrónico" required />
                    <input type="password" class="input" name="password" placeholder="Contraseña" required />
                </div>
                <button type="submit" class="submit-btn">Iniciar Sesión</button>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="error-message"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('js/login.js') ?>"></script>
</body>
</html>
