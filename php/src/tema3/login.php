<?php
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
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($users[$email]) && password_verify($password, $users[$email])) {
        // L'usuari està autenticat
        session_start();
        $_SESSION['user'] = $email;
        header("Location: welcome.php");
        exit();
        
    } else {
        // Credencials incorrectes
        echo "Invalid email or password.";
    }

   
    
}

if (isset($_POST['recuerdame'])) {
    setcookie(
        'nombre_de_usuario',
        $_SESSION['user'],
        [
            'expires' => time() + 3600,
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]

        );
}
?>

<h1>Iniciar sessió</h1>
<form method="post">
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <label for="recuerdame">Recordar'me</label>
    <input type="checkbox" name="recuerdame">
    <button type="submit" name="login">Login</button>
</form>