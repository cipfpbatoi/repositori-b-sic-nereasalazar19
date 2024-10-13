<?php
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        // Si se presiona el botón de logout, redirigir a logout.php
        header("Location: ../logout.php");
        exit();
    }

}



include 'functions.php';

// Inicializar las variables de sesión solo si no existen
if (!isset($_SESSION['palabra'])) {
    $_SESSION['palabra'] = generarPalabraAleatoriamente();
    $_SESSION['array'] = array_fill(0, strlen($_SESSION['palabra']), '_');
    $_SESSION['correct_letters'] = [];
    $_SESSION['incorrect_letters'] = [];
    $_SESSION['intentos_restantes'] = 6; // Establece el número de intentos permitidos
}

if (!isset($_SESSION['intentos_restantes'])) {
    $_SESSION['intentos_restantes'] = 6;
}

// Verificar si el juego ha terminado
function juegoTerminado() {
    return !in_array('_', $_SESSION['array']) || $_SESSION['intentos_restantes'] <= 0;
}

// Procesar la entrada del usuario
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['letra'])) {
        $letra = strtolower($_POST['letra']);

        if (strlen($letra) == 1 && ctype_alpha($letra)) {
            if (!in_array($letra, $_SESSION['correct_letters']) && !in_array($letra, $_SESSION['incorrect_letters'])) {
                $letraErronea = comprobarIntento($_SESSION['palabra'], $letra, $_SESSION['array']);
                if ($letraErronea) {
                    $_SESSION['incorrect_letters'][] = $letra;
                    $_SESSION['intentos_restantes']--; // Restar un intento
                } else {
                    $_SESSION['correct_letters'][] = $letra;
                }
            } else {
                $_SESSION['mensaje'] = "Ya has introducido la letra '$letra'. Intenta con otra.";
            }
        }
    } elseif (isset($_POST['palabraUsuario'])) {
        $palabraUsuario = strtolower($_POST['palabraUsuario']);
        if ($palabraUsuario === strtolower($_SESSION['palabra'])) {
            $_SESSION['mensaje'] = "¡Felicidades! Has adivinado la palabra correctamente: " . $_SESSION['palabra'];
            $_SESSION['array'] = str_split($_SESSION['palabra']);
        } else {
            $_SESSION['mensaje'] = "Lo siento, esa no es la palabra correcta. Sigue intentando.";
        }
    } elseif (isset($_POST['reiniciar'])) {
        // Reiniciar juego
        $_SESSION['palabra'] = generarPalabraAleatoriamente();
        $_SESSION['array'] = array_fill(0, strlen($_SESSION['palabra']), '_');
        $_SESSION['correct_letters'] = [];
        $_SESSION['incorrect_letters'] = [];
        $_SESSION['intentos_restantes'] = 6; // Reiniciar intentos
    }
}

// Verificar si el juego ha terminado
if (juegoTerminado()) {
    if ($_SESSION['intentos_restantes'] <= 0) {
        $_SESSION['mensaje'] = "Has perdido. La palabra era: " . $_SESSION['palabra'];
    } else {
        $_SESSION['mensaje'] = "¡Felicidades! Has adivinado la palabra: " . $_SESSION['palabra'];
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto Ofegat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Proyecto Ofegat</h1>

    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<h2>" . $_SESSION['mensaje'] . "</h2>";
        unset($_SESSION['mensaje']);
    }

    echo "<h2>Progreso de la palabra:</h2>";
    imprimirArray($_SESSION['array']);

    // Mostrar intentos restantes
    echo "<h3>Intentos restantes: " . $_SESSION['intentos_restantes'] . "</h3>";

    if (!empty($_SESSION['correct_letters']) || !empty($_SESSION['incorrect_letters'])) {
        echo "<h2>Letras introducidas:</h2>";
        imprimirLetrasIntroducidas($_SESSION['correct_letters'], $_SESSION['incorrect_letters']);
    }
    ?>

    <form action="index.php" method="post">
        <br>
        <label for="letra">Escribe una letra: </label>
        <br><br>
        <input type="text" id="letra" name="letra" maxlength="1">
        <br><br>
        <button type="submit">Enviar Letra</button>
        
    </form>
    <br>
    <form action="index.php" method="post">
        <label for="palabraUsuario">¿Crees que ya sabes la palabra? Escríbela aquí abajo</label>
        <br><br>
        <input type="text" name="palabraUsuario">
        <br><br>
        <button type="submit">Enviar Palabra</button>
    </form>

    <br>
    <form action="index.php" method="post">
        <button type="submit" name="reiniciar">Reiniciar Juego Y Adivinar Otra Palabra</button>
    </form>
    <br>
    <form action="index.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
