<html>
    <body>
        <h2>Bucle For: </h2>
<?php

//Utilitza un bucle for per imprimir els números parells del 0 al 20. Fes-ho també amb un bucle while.

$numeroFor = 0;
for ($i=0; $i < 21; $i++) { 
    if($numeroFor%2==0)
    { 
      
      echo $numeroFor;
}

$numeroFor = $numeroFor+1;
}
?>

<br>
 <h2> Bucle While: </h2>
<br>
<?php
$numeroWhile=0; #Bucle
$contador=0; #Contador de PARES

while($contador<11)
{
    if($numeroWhile%2==0)
    { 
      $contador = $contador+1;
      echo $numeroWhile;
}

$numeroWhile= $numeroWhile+1;
}


?>





</body>
</html>
