<?php
// Llegir el valor de la cookie
if (isset($_COOKIE['nom_usuari'])) {
    $nomUsuari = $_COOKIE['nom_usuari'];
    $salutacio = 'Hola, ' . $nomUsuari;
    setcookie('nom_usuari', $salutacio, time() + 3600, '/');
   
    echo 'Hola, ' . $nomUsuari;

    // Modificar el valor de la cookie
    
} else {
    echo 'Cookie not found.';
}