<?php
require __DIR__ . '/../vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer

// Hash de la contraseña almacenada
$hashedPassword = '$2y$10$ZgBx5S7EyJnQ48sghTtM6uKXdLtv2LAmdKBkQn'; // Reemplaza con el hash de la contraseña de tu base de datos
$plainPassword = '123456'; // Cambia esto a la contraseña que intentas verificar

if (password_verify($plainPassword, $hashedPassword)) {
    echo "La contraseña es válida.";
} else {
    echo "La contraseña no es válida.";
}
