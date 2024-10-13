<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../Includes/db.php"; // Zorg ervoor dat dit het juiste pad is

class User {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db->getConnection();
    }

    public function login($usernameOrEmail, $password) {
        $query = "SELECT * FROM users WHERE (username = :usernameOrEmail OR email = :usernameOrEmail)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usernameOrEmail', $usernameOrEmail);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Gebruiker gevonden en wachtwoord is correct
        }
        return false; // Inloggen mislukt
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
        $usernameOrEmail = $_POST['usernameOrEmail'];
        $password = $_POST['password'];

        $userModel = new User(new DB());

        // Verifieer de gebruiker
        $user = $userModel->login($usernameOrEmail, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: user.php");
            exit();
        } else {
            echo "Inloggen mislukt.";
        }
    } else {
        echo "Vul alstublieft alle velden in.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Inloggen</h2>
        <form action="login.php" method="POST">
            <label for="usernameOrEmail">Gebruikersnaam of E-mail:</label>
            <input type="text" id="usernameOrEmail" name="usernameOrEmail" required>
            
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Inloggen">
        </form>
        <p>Geen account? <a href="register.php">Registreer hier</a></p>
    </div>
</body>
</html>
