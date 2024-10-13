<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "../Includes/db.php"; // Zorg ervoor dat dit het juiste pad is

class User {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db->getConnection(); // Zorg ervoor dat deze regel hier staat
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

// Maak een User-object aan
$userModel = new User(new DB());
$user = $userModel->getUserById($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikerspagina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welkom, <?php echo htmlspecialchars($user['username']); ?></h2>
        <nav>
            <ul>
                <li><a href="user.php">Home</a></li>
                <li><a href="logout.php">Uitloggen</a></li>
            </ul>
        </nav>
        <p>Dit is je gebruikerspagina. Hier kun je meer informatie over je account bekijken.</p>
    </div>
</body>
</html>
