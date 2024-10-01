<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Alta Llibre</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<?php

$modulos=[
    ['nombre'=>'Desplegamiento'],
    ['nombre'=>'Interfaces'],
    ['nombre'=>'Desarrollo Cliente']
];

$estados= [
    ['nombre'=>'Disponible'],
    ['nombre'=>'No disponible']
];



?>

<form action="ejercicio8.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="module">Mòdul:</label>
        <select id="module" name="module">
            <!-- Opcions del mòdul aquí -->
             <?php
foreach ($modulos as $modulo){
    echo "<option value=".$modulo['nombre'].">".$modulo['nombre']."</option";
    echo "<br>";
}
              
                ?>
             
        </select>
        <span class="error"><!-- Missatge d'error per al mòdul aquí --></span>
    </div>
    <div>
        <label for="publisher">Editorial:</label>
        <input type="text" id="publisher" name="publisher" value="">
        <span class="error"><!-- Missatge d'error per a l'editorial aquí --></span>
    </div>
    <div>
        <label for="price">Preu:</label>
        <input type="text" id="price" name="price" value="">
        <span class="error"><!-- Missatge d'error per al preu aquí --></span>
    </div>
    <div>
        <label for="pages">Pàgines:</label>
        <input type="text" id="pages" name="pages" value="">
        <span class="error"><!-- Missatge d'error per a les pàgines aquí --></span>
    </div>
    <div>
        <label for="status">Estat:</label>

        <?php
        foreach ($estados as $estado){
    echo "<input type=\"radio\" name=\"status\" value=".$estado['nombre'].">".$estado['nombre'];
    echo "<br>";
}
         
    ?>
    <span class="error"><!-- Missatge d'error per a l'estat aquí --></span>
         </div>
    <div>
        <label for="photo">Foto:</label>
        <input type="file" id="photo" name="photo">
    </div>
    <div>
        <label for="comments">Comentaris:</label>
        <textarea id="comments" name="comments"></textarea>
    </div>
    <div>
        <button type="submit">Donar d'alta</button>
    </div>
</form>
</body>
</html>

