<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar el token CSRF
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || 
        $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Error: Token CSRF no valido o inexistente.");
    }

    // Procesar los datos del formulario
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $missatge = htmlspecialchars($_POST['missatge']);


    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

    // Mostrar mensaje de confirmación
    echo "<h1>Mensaje Enviado</h1>";
    echo "<p>Ha ido todo bien, $nom.</p>";
    echo "<a href='ejercicio4.php'>Volver al formulario</a>";
} else {
    // Si se accede directamente a esta página sin enviar el formulario
    header("Location: ejercicio4.php");
    exit();
}
?>