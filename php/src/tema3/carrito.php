<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

$carrito = $_SESSION['carrito'];
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Carret de compra</title>
</head>
<body>
    <h1>Carret de compra</h1>
    <?php if (empty($carrito)): ?>
        <p>El carret està buit.</p>
    <?php else: ?>
        <ul>
        <?php foreach ($carrito as $producto => $cantidad): ?>
            <li><?php echo $producto . ': ' . $cantidad; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="ejercicio1.php">Tornar a la selecció de productes</a>
</body>
</html>

