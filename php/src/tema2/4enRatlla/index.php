<?php
session_start();

// Se ejecuta cuando se presiona al botón del formulario de reiniciar el juego
// Destruye la session para comenzar de nuevo el juego

if (isset($_POST['reiniciar'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>4 en Ratlla</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>4 en Ratlla</h1>

    <?php


include 'functions.php';

// Se comprueba que se haya creado la session y si se ha creado crea la graella

if (!isset($_SESSION['graella'])) {
    $_SESSION['graella'] = inicialitzarGraella();
    // Por defecto comienza el jugador 1
    $_SESSION['jugadorActual'] = 1;
}
// Se recogen las variables de session en variables normales
$graella = $_SESSION['graella'];
$jugadorActual = $_SESSION['jugadorActual'];

//Se comprueba que se envian datos por POST

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['reiniciar'])) {

    // Se verifica que desde el formulario se ha pasado un número y lo guarda en una variable
    $columna = intval($_POST['columna']);

    // Si se hace un movimiento se comprobarán los ángulos verticales, horizontales y diagonales
    if (ferMoviment($graella, $columna, $jugadorActual)) {
        echo "<p>Moviment realitzat pel jugador $jugadorActual.</p>";
        if (comprovarGuanyador($graella, $jugadorActual)) {
            echo "<p>El jugador $jugadorActual ha guanyat!</p>";

        } else {
            $jugadorActual = ($jugadorActual == 1) ? 2 : 1;

            $_SESSION['graella'] = $graella;
            $_SESSION['jugadorActual'] = $jugadorActual;
        }
    } else {
        echo "<p>Columna plena! Intenta amb una altra columna.</p>";
    }

    
}

// Cuando se realiza el movimiento se pinta la graella
pintarGraella($graella);
?>



    <form method="post" action="index.php">
        <label for="columna">Escull una columna (0-6):</label>
        <input type="number" id="columna" name="columna" min="0" max="6" required>

        <input type="hidden" name="jugadorActual" value="<?php echo $jugadorActual; ?>">

        <button type="submit">Fer Moviment</button>
    </form>

    <form method="post" action="index.php">
        <button type="submit" name="reiniciar">Reiniciar Joc</button>
    </form>

</body>
</html>
