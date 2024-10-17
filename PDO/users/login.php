<?php
require_once "user.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = $_POST['usernameOrEmail'];
    $password = $_POST['password'];

    $db = new DB();
    $userModel = new User($db);

    if ($userModel->login($usernameOrEmail, $password)) {
        echo "Inloggen geslaagd!";
        
    } else {
        echo "Inloggen mislukt.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
</head>
<body>
<form action="" method="POST">
    <label for="usernameOrEmail">Gebruikersnaam of E-mail:</label>
    <input type="text" id="usernameOrEmail" name="usernameOrEmail" required><br>

    <label for="password">Wachtwoord:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Inloggen">
</form>
</body>
</html>
