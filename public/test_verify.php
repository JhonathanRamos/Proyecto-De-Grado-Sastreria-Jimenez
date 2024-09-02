<?php
$password = '000000'; // Contraseña que deseas hashear
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Hash generado: " . $hash;
?>
