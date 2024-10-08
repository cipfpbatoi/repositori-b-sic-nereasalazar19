<?php
session_start();

// Inicialitzar la llista de pàgines visitades si no existeix
if (!isset($_SESSION['pages'])) {
    $_SESSION['pages'] = [];
}

// Afegir la pàgina actual a la llista de pàgines visitades
$_SESSION['pages'][] = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producte']) && isset($_POST['cantidad'])) {
    $producto = $_POST['producte'];
    $cantidad = intval($_POST['cantidad']); // Convertir a entero para seguridad

    if (isset($_SESSION['carrito'][$producto])) {
        $_SESSION['carrito'][$producto] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto] = $cantidad;
    }
}

// Procesar logout si se ha enviado
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php'); // Redirigir a la página de login
    exit();
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Selecció de productes</title>
</head>
<body>
    <?php if (isset($_SESSION['user'])): ?>
        <h4>Benvingut: <?php echo htmlspecialchars($_SESSION['user'])?></h4>
    <?php endif; ?>
    <h1>Afegir productes al carret</h1>
    <form action="ejercicio1.php" method="POST">
        <label for="producte">Tria un producte:</label>
        <select name="producte" id="producte">
            <option value="Poma">Poma</option>
            <option value="Plàtan">Plàtan</option>
            <option value="Taronja">Taronja</option>
        </select>
        <br>
        <label for="cantidad">Cantidad: </label>
        <input name="cantidad" id="cantidad" type="number" min="1" value="1">
        <br>
        <input type="submit" value="Afegir al carret">
    </form>
    <a href="carrito.php">Veure carret</a>
    <form action="ejercicio1.php" method="POST">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>