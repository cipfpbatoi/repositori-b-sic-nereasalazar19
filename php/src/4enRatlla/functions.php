<?php
function inicialitzarGraella() {
    $files = 6;
    $columnes = 7;
    $graella = [];

    for ($i = 0; $i < $files; $i++) {
        $graella[$i] = array_fill(0, $columnes, 0);
    }

    return $graella;
}

function pintarGraella($graella) {
    echo "<table>";

    foreach ($graella as $fila) {
        echo "<tr>";
        foreach ($fila as $celda) {
            if ($celda == 1) {
                echo "<td class='player1'></td>"; 
            } elseif ($celda == 2) {
                echo "<td class='player2'></td>";
            } else {
                echo "<td class='buid'></td>";
            }
        }
        echo "</tr>";
    }

    echo "</table>";
}

function ferMoviment(&$graella, $columna, $jugadorActual) {
    for ($i = count($graella) - 1; $i >= 0; $i--) {
        if ($graella[$i][$columna] == 0) {
            $graella[$i][$columna] = $jugadorActual;
            return true; 
        }
    }

    return false;
}

function comprovarGuanyador($graella, $jugadorActual) {
    $files = count($graella);
    $columnes = count($graella[0]);


    // Comprueba verticales
    for ($i = 0; $i < $files; $i++) {
        for ($j = 0; $j < $columnes - 3; $j++) {
            if ($graella[$i][$j] == $jugadorActual &&
                $graella[$i][$j+1] == $jugadorActual &&
                $graella[$i][$j+2] == $jugadorActual &&
                $graella[$i][$j+3] == $jugadorActual) {
                return true;
            }
        }
    }
    // Comprueba  horizontales
    for ($i = 0; $i < $files - 3; $i++) {
        for ($j = 0; $j < $columnes; $j++) {
            if ($graella[$i][$j] == $jugadorActual &&
                $graella[$i+1][$j] == $jugadorActual &&
                $graella[$i+2][$j] == $jugadorActual &&
                $graella[$i+3][$j] == $jugadorActual) {
                return true;
            }
        }
    }

    // Comprueba diagonales de derecha a izquierda
    for ($i = 0; $i < $files - 3; $i++) {
        for ($j = 0; $j < $columnes - 3; $j++) {
            if ($graella[$i][$j] == $jugadorActual &&
                $graella[$i+1][$j+1] == $jugadorActual &&
                $graella[$i+2][$j+2] == $jugadorActual &&
                $graella[$i+3][$j+3] == $jugadorActual) {
                return true;
            }
        }
    }

    // Comprueba diagonales de izquierda a derecha
    for ($i = 0; $i < $files - 3; $i++) {
        for ($j = 3; $j < $columnes; $j++) {
            if ($graella[$i][$j] == $jugadorActual &&
                $graella[$i+1][$j-1] == $jugadorActual &&
                $graella[$i+2][$j-2] == $jugadorActual &&
                $graella[$i+3][$j-3] == $jugadorActual) {
                return true;
            }
        }
    }

    return false;
}
