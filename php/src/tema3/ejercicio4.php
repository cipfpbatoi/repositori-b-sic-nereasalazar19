<?php
session_start();
// Inicialitzar la llista de pàgines visitades si no existeix
if (!isset($_SESSION['pages'])) {
    $_SESSION['pages'] = [];
}

// Afegir la pàgina actual a la llista de pàgines visitades
$_SESSION['pages'][] = $_SERVER['REQUEST_URI'];

// Generar y almacenar el token CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Contacto</title>
</head>
<body>
    <h1>Formulario de Contacto</h1>
    <form action="procesar_token.php" method="POST">
        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" required><br><br>
        
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="missatge">Mensaje:</label><br>
        <textarea id="missatge" name="missatge" rows="4" cols="50" required></textarea><br><br>
        
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>