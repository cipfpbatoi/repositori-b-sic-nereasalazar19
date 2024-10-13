<?php
session_start();
session_destroy();

// Eliminar la cookie
if (isset($_COOKIE['nombre_de_usuario'])) {
    setcookie('nombre_de_usuario', '', time() - 3600, '/'); // Eliminar la cookie
}

// Redirigir a la página de login
header("Location: login.php");
exit();
?>
