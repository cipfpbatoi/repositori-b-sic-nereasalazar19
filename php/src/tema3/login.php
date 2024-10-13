<?php
session_start();

// Inicialitzar la llista de pàgines visitades si no existeix
if (!isset($_SESSION['pages'])) {
    $_SESSION['pages'] = [];
}

// Afegir la pàgina actual a la llista de pàgines visitades
$_SESSION['pages'][] = $_SERVER['REQUEST_URI'];

// Llista d'usuaris predefinits amb contrasenyes en text pla
$users = [
    'salazarricharte@gmail.com' => 'nerea191204',
    'user2@example.com' => 'password2',
];

// Convertir les contrasenyes a un format encriptat
foreach ($users as $email => $password) {
    $users[$email] = password_hash($password, PASSWORD_BCRYPT);
}

// Formulari d'autenticació
if (isset($_POST['login'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(isset($_POST['nombre'])) {
        $_SESSION['nombre'] = $nombre;
    }

    if (isset($users[$email]) && password_verify($password, $users[$email])) {
        // L'usuari està autenticat
        $_SESSION['user'] = $email;


        // Comprovar si l'usuari vol que el recordem
        if (isset($_POST['recuerdame'])) {
            setcookie('nombre_de_usuario', $email, [
                'expires' => time() + 3600, // 1 hora
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
        }

        header("Location: welcome.php");
        exit();
        
    } else {
        // Credencials incorrectes
        echo "Invalid email or password.";
    }
}

// Comprovar si ja tenim una cookie de recordatori
if (isset($_COOKIE['nombre_de_usuario'])) {
    $_SESSION['user'] = $_COOKIE['nombre_de_usuario'];
}

?>

<h1>Iniciar sessió</h1>
<form method="post">
    Nombre: <input type="text" name="nombre" required>
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <label for="recuerdame">Recordar'me</label>
    <input type="checkbox" name="recuerdame">
    <button type="submit" name="login">Login</button>
</form>
