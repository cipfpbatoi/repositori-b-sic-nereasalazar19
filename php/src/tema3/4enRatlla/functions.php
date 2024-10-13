<?php

define('COLUMNES', 7);

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

    foreach ($graella as $i => $fila) {
        echo "<tr>";
        foreach ($fila as $j => $celda) {
            $clase = $celda == 1 ? 'player1' : ($celda == 2 ? 'player2' : 'buid');
            echo "<td class='$clase' onclick='hacerMovimiento($j)'></td>"; 
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

function esTableroLleno($graella) {
    foreach ($graella[0] as $celda) {
        if ($celda == 0) {
            return false; // Si hay al menos una celda vacía, el tablero no está lleno
        }
    }
    return true; // Si no hay celdas vacías, el tablero está lleno
}

function jugar(&$graella, $jugadorActual) {
    $opponent = $jugadorActual === 1 ? 2 : 1;
    $columnes = count($graella[0]); // Número de columnas

    // Comprobar si puede ganar en el siguiente movimiento
    for ($col = 0; $col < $columnes; $col++) {
        if (isValidMove($graella, $col)) {
            $tempBoard = $graella;
            ferMoviment($tempBoard, $col, $jugadorActual);
            if (comprovarGuanyador($tempBoard, $jugadorActual)) {
                return ferMoviment($graella, $col, $jugadorActual); // Ganar
            }
        }
    }

    // Comprobar si el oponente puede ganar y bloquearlo
    for ($col = 0; $col < $columnes; $col++) {
        if (isValidMove($graella, $col)) {
            $tempBoard = $graella;
            ferMoviment($tempBoard, $col, $opponent);
            if (comprovarGuanyador($tempBoard, $opponent)) {
                return ferMoviment($graella, $col, $jugadorActual); // Bloquear
            }
        }
    }

    // Estrategia: elegir un movimiento aleatorio entre las columnas disponibles
    $possibles = array();
    for ($col = 0; $col < $columnes; $col++) {
        if (isValidMove($graella, $col)) {
            $possibles[] = $col;
        }
    }

    // Si hay columnas disponibles, elige una al azar
    if (count($possibles) > 0) {
        $randomIndex = rand(0, count($possibles) - 1);
        return ferMoviment($graella, $possibles[$randomIndex], $jugadorActual);
    }

    return -1; // Todas las columnas están llenas
}
// Función para obtener la fila más baja de una columna específica
function obtenerFila($graella, $columna) {
    for ($i = count($graella) - 1; $i >= 0; $i--) {
        if ($graella[$i][$columna] == 0) {
            return $i; // Retorna la fila donde se puede colocar la ficha
        }
    }
    return -1; // No hay espacio
}


function findRow($graella, $col) {
    // Encuentra la fila más baja disponible en la columna dada
    for ($row = count($graella) - 1; $row >= 0; $row--) {
        if ($graella[$row][$col] == 0) {
            return $row; // Retorna la fila disponible
        }
    }
    return -1; // No hay fila disponible
}




function isValidMove($graella, $columna) {
    // Verifica si hay espacio en la columna especificada
    return $graella[0][$columna] == 0; // Solo se puede mover si la parte superior de la columna está vacía
}

function fi_joc($graella, $coord) {
    $row = $coord[1];  // Obtener la fila del movimiento
    $col = $coord[0];  // Obtener la columna del movimiento
    $jugadorActual = $graella[$row][$col]; // Obtener quién jugó

    // Comprobar si hay un ganador (puedes reutilizar la lógica de `comprovarGuanyador`)
    if (comprovarGuanyador($graella, $jugadorActual)) {
        return true; // Hay un ganador
    }

    // Comprobar si el tablero está lleno
    foreach ($graella[0] as $celda) {
        if ($celda == 0) {
            return false; // Hay espacio, el juego sigue
        }
    }

    // Tablero lleno sin ganador
    echo "<p>El juego ha terminado en empate.</p>";
    return true; // El juego ha terminado
}
