<html>
    <body>
<?php

//Assigna múltiples variables i utilitza operadors aritmètics i lògics. Mostra el resultat de cada operació.

$numero1 = 5;
$numero2 = 13;
$numero3 = 20;
$numero4 = 2;
$numero5 = 10;

$suma = $numero2 + $numero4;
$resta = $numero3 - $numero5;
$multiplicacion = $numero1 * $numero2;
$division = $numero3 / $numero4;

?>

<h2>Operadores aritméticos</h2>
<p>Resultado de una suma: </p>
<li><?php echo $suma; ?></li>


<br>
<p>Resultado de una resta: </p>
<li><?php echo $resta; ?></li>

<br>
<p>Resultado de una multiplicación: </p>
<li><?php echo $multiplicacion; ?></li>

<br>
<p>Resultado de una división: </p>
<li><?php echo $division; ?></li>


<h2>Operadores lógicos</h2>



</body>
</html>
