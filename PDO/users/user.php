<?php
require_once "../Includes/db.php"; 

class User {
    private $pdo;

    public function __construct(DB $db) {
        $this->pdo = $db->pdo;
    }

    
    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    
    public function login($usernameOrEmail, $password) {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true; 
        }
        
        return false; // 
    }

    // Uitloggen
    public function logout() {
        session_start();
        session_destroy();
    }
}
?>
