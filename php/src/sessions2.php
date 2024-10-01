<?php
// Iniciar sessió
session_start();

if (isset($_SESSION['nom'])){
    echo 'Benvingut, ' . $_SESSION['nom'] . '<br>';
    echo 'Rol: ' . $_SESSION['rol'] . '<br>';
}



session_unset();
?>