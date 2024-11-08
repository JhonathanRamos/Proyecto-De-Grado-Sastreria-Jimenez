<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="<?= base_url('css/olvidar.css') ?>">
</head>
<body>
    <div class="container">
        <h2>Restablecer Contraseña</h2>

        <!-- Mostrar mensajes de éxito o error -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('auth/olvido_contrasenia') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" placeholder="Ingresa tu correo" required>
            </div>

            <button type="submit" class="btn btn-primary">Enviar Nueva Contraseña</button>
            <a href="<?= base_url('/login') ?>" class="btn btn-secondary">Volver al Inicio de Sesión</a>
        </form>
    </div>
</body>
</html>
