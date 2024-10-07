<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7</title>
</head>
<body>

<h1>Formulario</h1>

<?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            if (empty($_POST['name'])) {
                $errors['name'] = "El campo nombre es obligatorio";
            }

            if (empty($_POST['email'])) {
                $errors['email'] = "El campo email es obligatorio";

            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "El formato del email es inválido";
            }

            if (empty($_POST['password'])) {
                $errors['password'] = "El campo contraseña es obligatorio";
            }

            if ($_POST['password'] != $_POST['password2']){
                $errors['password2'] = "No coinciden los passwords";
            }

            $name = $_POST['name'];
            $email = $_POST['email'];
                
            if (empty($errors)) {
                $password = $_POST['password'];
                echo "Todos los campos estan correctos $name, $email i $password";
            }
        }

        

    ?>

<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name">Nombre: </label>
    <input type="text" id="name" name="name" value="<?= $name??'' ?>" >
    <?= $errors['name'] ?? '' ?>    
    <br><br>
    <label for="email">Correo electrónico: </label>
    <input type="email" id="email" name="email" value="<?= $email??'' ?>" >
    <?= $errors['email'] ?? '' ?>  <br><br>
    <label for="password">Contraseña: </label>
    <input type="text" id="password" name="password" ><?= $errors['password'] ?? '' ?>  <br><br>
    <label for="password">Confirmar contraseña: </label>
    <input type="text" id="password2" name="password2" ><?= $errors['password2'] ?? '' ?>  <br><br>

    <input type="submit" value="Enviar">
    
</form>
</body>
</html>