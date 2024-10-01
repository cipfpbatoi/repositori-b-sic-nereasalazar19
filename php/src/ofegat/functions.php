<?php

function imprimirArray($array){
    foreach ($array as $letra){
        echo $letra . " ";
    }
    echo "<br>";
}

function comprobarIntento($palabraAdivinar, $letraUsuario, &$arrayAdivinadas) {
    $letraErronea = true;
    $letraUsuario = strtolower($letraUsuario);

    for ($i = 0; $i < strlen($palabraAdivinar); $i++) {
        if (strtolower($palabraAdivinar[$i]) === $letraUsuario) {
            $arrayAdivinadas[$i] = $palabraAdivinar[$i];
            $letraErronea = false;
        }
    }

    return $letraErronea;
}

function imprimirLetrasIntroducidas($letras_correctas, $letras_incorrectas) {
    echo "<div>";
    foreach ($letras_correctas as $letra) {
        echo "<span class='correct'>" . htmlspecialchars($letra) . " </span>";
    }
    foreach ($letras_incorrectas as $letra) {
        echo "<span class='incorrect'>" . htmlspecialchars($letra) . " </span>";
    }
    echo "</div>";
}
?>
