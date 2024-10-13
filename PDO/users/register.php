<?php
require_once "user.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new DB();
    $userModel = new User($db);

    if ($userModel->register($username, $email, $password)) {
        echo "Registratie succesvol!";
    } else {
        echo "Registratie mislukt.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Registreren</h2>
    <form action="register.php" method="POST">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Registreren">
    </form>
    
    <p>Al een account? <a href="login.php">Inloggen hier</a>.</p>
</div>
</body>
</html>

