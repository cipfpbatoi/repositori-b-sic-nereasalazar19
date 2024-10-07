<html>
    <body>
        
        
<?php

//Crea un fitxer que utilitze la instrucció match per categoritzar una variable $nota segons el següent criteri: - Si la nota és 10, imprimir "Excel·lent". - Si la nota és 8 o 9, imprimir "Molt bé". - Si la nota és 5, 6 o 7, imprimir "Bé". - Per qualsevol altra nota, imprimir "Insuficient".

$nota = 9;

$resultat = match (true) {
    $nota == 10 => 'Excel·lent',
    $nota == 9 || $nota == 8 => 'Molt bé',
    $nota == 7 || $nota == 6 || $nota == 5 => 'Bé',

    default => 'Insuficient',
};

echo $resultat;


?>


</body>
</html>
