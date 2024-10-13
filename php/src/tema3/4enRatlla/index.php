<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

// Se ejecuta cuando se presiona al botón del formulario de reiniciar el juego
if (isset($_POST['reiniciar'])) {
    unset($_SESSION['graella']);
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        // Si se presiona el botón de logout, redirigir a logout.php
        header("Location: ../logout.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>4 en Ratlla</title>
    <link rel="stylesheet" href="styles.css">
    <script>
    function hacerMovimiento(columna) {
        // Crear un formulario temporal para enviar el movimiento
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "index.php";

        // Crear un campo oculto para la columna seleccionada
        var inputColumna = document.createElement("input");
        inputColumna.type = "hidden";
        inputColumna.name = "columna";
        inputColumna.value = columna;

        form.appendChild(inputColumna);

        // Agregar el formulario al body y enviarlo
        document.body.appendChild(form);
        form.submit();
    }
    </script>
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

    // Se comprueba que se envían datos por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['reiniciar'])) {
        // Se verifica que desde el formulario se ha pasado un número y lo guarda en una variable
        $columna = intval($_POST['columna']);

        // Si se hace un movimiento se comprobarán los ángulos verticales, horizontales y diagonales
        if (ferMoviment($graella, $columna, $jugadorActual)) {
            echo "<p>Moviment realitzat pel jugador $jugadorActual " . $_SESSION['nombre'] . ".</p>";

            // Comprobar si hay un ganador
            if (comprovarGuanyador($graella, $jugadorActual)) {
                echo "<p>El jugador $jugadorActual ( " . $_SESSION['nombre'] ." ) ha guanyat!</p>";
                $_SESSION['graella'] = $graella; // Guardar el estado final
            } elseif (esTableroLleno($graella)) {
                echo "<p>El joc ha acabat en empat!</p>";
                $_SESSION['graella'] = $graella; // Guardar el estado final
            } else {
                // Cambiar al siguiente jugador
                $jugadorActual = 2; // La máquina hace su movimiento
                $_SESSION['jugadorActual'] = $jugadorActual;

                // Hacer el movimiento de la máquina
                jugar($graella, $jugadorActual);

                // Comprobar si la máquina ha ganado
                if (comprovarGuanyador($graella, $jugadorActual)) {
                    echo "<p>El jugador $jugadorActual (la máquina) ha guanyat!</p>";
                } elseif (esTableroLleno($graella)) {
                    echo "<p>El joc ha acabat en empat!</p>";
                } else {
                    // Volver al jugador 1
                    $jugadorActual = 1;
                    $_SESSION['jugadorActual'] = $jugadorActual;
                }
            }

            // Guardar el estado de la graella en la sesión
            $_SESSION['graella'] = $graella;
        } else {
            echo "<p>Columna plena! Intenta amb una altra columna.</p>";
        }
    }

    // Cuando se realiza el movimiento se pinta la graella
    pintarGraella($graella);
    ?>

    <form method="post" action="index.php">
        <button type="submit" name="reiniciar">Reiniciar Joc</button>
        <button type="submit" name="logout">Logout</button>
    </form>

</body>
</html>
