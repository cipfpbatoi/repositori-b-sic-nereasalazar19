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
    include 'functions.php';

    $palabra = "programacion";

    $array = array_fill(0, strlen($palabra), '_');

    $correct_letters = [];
    $incorrect_letters = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['correct_letters'])) {
            $correct_letters = $_POST['correct_letters'];
        }
        if (isset($_POST['incorrect_letters'])) {
            $incorrect_letters = $_POST['incorrect_letters'];
        }

        if (isset($_POST['letra'])) {
            $letra = $_POST['letra'];

            if (strlen($letra) == 1 && ctype_alpha($letra)) {
                $letra = strtolower($letra);
                echo "<p>La letra introducida es: " . htmlspecialchars($letra) . "</p>";

                if (in_array($letra, array_map('strtolower', $correct_letters)) || in_array($letra, array_map('strtolower', $incorrect_letters))) {
                    echo "<p>Ya has introducido la letra '$letra'. Intenta con otra.</p>";
                } else {
                    $letraErronea = comprobarIntento($palabra, $letra, $array);

                    if ($letraErronea) {
                        echo "<p>La letra <span class='incorrect'>$letra</span> no está en la palabra.</p>";
                        $incorrect_letters[] = $letra;
                    } else {
                        echo "<p>¡Bien hecho! La letra <span class='correct'>$letra</span> está en la palabra.</p>";
                        $correct_letters[] = $letra;
                    }
                }
            } else {
                echo "<p>Por favor, introduce solo una letra válida.</p>";
            }
        } else {
            echo "<p>No se ha recibido ninguna letra.</p>";
        }
    }

    foreach ($correct_letters as $letra_correcta) {
        for ($i = 0; $i < strlen($palabra); $i++) {
            if (strtolower($palabra[$i]) === $letra_correcta) {
                $array[$i] = $palabra[$i];
            }
        }
    }

    echo "<h2>Progreso de la palabra:</h2>";
    imprimirArray($array);

    if (!empty($correct_letters) || !empty($incorrect_letters)) {
        echo "<h2>Letras introducidas:</h2>";
        imprimirLetrasIntroducidas($correct_letters, $incorrect_letters);
    }
    ?>

    <form action="index.php" method="post">
        <br>
        <label for="letra">Escribe una letra: </label>
        <br>
        <input type="text" id="letra" name="letra" maxlength="1" required>
        <br><br>
        <button type="submit">Enviar</button>

        <?php
        if (!empty($correct_letters)) {
            foreach ($correct_letters as $cl) {
                echo '<input type="hidden" name="correct_letters[]" value="' . htmlspecialchars($cl) . '">';
            }
        }

        if (!empty($incorrect_letters)) {
            foreach ($incorrect_letters as $icl) {
                echo '<input type="hidden" name="incorrect_letters[]" value="' . htmlspecialchars($icl) . '">';
            }
        }

        
        ?>
    </form>
</body>

</html>
