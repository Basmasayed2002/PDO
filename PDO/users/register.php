<?php
require_once "user.php"; // Zorg ervoor dat het pad correct is

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
    <title>Registreren</title>
</head>
<body>
<form action="" method="POST">
    <label for="username">Gebruikersnaam:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Wachtwoord:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Registreren">
</form>
</body>
</html>
