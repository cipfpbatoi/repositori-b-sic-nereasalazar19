<?php



if (isset($_SESSION['paginas_visitadas'])) {
    $_SESSION['paginas_visitadas'] = array();
}

$paginas_a_registrar = ['ejercicio1.php', 'ejercicio4.php', 'login.php', 'welcome.php'];

function registrar_pagina($pagina) {
    global $paginas_a_registrar;
    
    if (in_array($pagina, $paginas_a_registrar)) {
        $_SESSION['pagines_visitades'][] = $pagina;
        
        if (count($_SESSION['pagines_visitades']) > 10) {
            array_shift($_SESSION['pagines_visitades']);
        }
    }
}

?>