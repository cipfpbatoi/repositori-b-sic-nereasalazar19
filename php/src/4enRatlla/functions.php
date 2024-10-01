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