<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <h1>Cambiar Contraseña</h1>
    <form action="<?= base_url('auth/changePassword') ?>" method="post">
        <?= csrf_field() ?>
        <label>Nueva Contraseña:</label>
        <input type="password" name="new_password" required>
        
        <label>Confirmar Contraseña:</label>
        <input type="password" name="confirm_password" required>
        
        <button type="submit">Cambiar Contraseña</button>
    </form>
</body>
</html>
