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

    $graella = inicialitzarGraella();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $columna = intval($_POST['columna']);
        $jugadorActual = $_POST['jugadorActual'];

        if (ferMoviment($graella, $columna, $jugadorActual)) {
            echo "<p>Moviment realitzat pel jugador $jugadorActual.</p>";
        } else {
            echo "<p>Columna plena! Intenta amb una altra columna.</p>";
        }

        $jugadorActual = ($jugadorActual == 1) ? 2 : 1;
    } else {
        $jugadorActual = 1;
    }

    pintarGraella($graella);
    ?>

    <form method="post" action="index.php">
        <label for="columna">Escull una columna (0-6):</label>
        <input type="number" id="columna" name="columna" min="0" max="6" required>

        <input type="hidden" name="jugadorActual" value="<?php echo $jugadorActual; ?>">

        <button type="submit">Fer Moviment</button>
    </form>
</body>
</html>
