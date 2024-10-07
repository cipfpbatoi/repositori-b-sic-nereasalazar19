<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        // Si se presiona el botón de logout, redirigir a logout.php
        header("Location: logout.php");
        exit();
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="welcome.css">
</head>
<body>
    <h4>Benvingut: <?php echo htmlspecialchars($_SESSION['user'])?></h4>
    <h1>Páginas para visitar:</h1>

    <h3><a href="../tema2/ofegat/">L'Ofegat</a></h3>

    <h3><a href="../tema2/4enRatlla/">4 En Ratlla</a></h3>

    <h3><a href="ejercicio1.php">El carrito</a></h3>

    <form action="welcome.php" method="POST">
        <input type="submit" name="logout" value="Logout">
    </form>
    
</body>
</html>