<?php
class DB {
    private $host = 'localhost'; 
    private $dbname = 'pdo'; 
    private $username = 'root'; 
    private $password = ''; 
    private $connection; // Maak de connectie private

    // Constructor
    public function __construct() {
        $this->connect(); // Verbind met de database bij het aanmaken van een object
    }

    // Verbindingsfunctie
    private function connect() {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    // Methode om de verbinding te krijgen
    public function getConnection() {
        return $this->connection;
    }

    // Uitvoeren van SQL-query's
    public function execute($sql, $params = []) {
        $stmt = $this->connection->prepare($sql); // Gebruik $this->connection
        $stmt->execute($params);
        return $stmt;
    }

    // Product verwijderen
    public function deleteProduct($id) {
        $sql = "DELETE FROM product WHERE id = :id";
        $stmt = $this->connection->prepare($sql); // Gebruik $this->connection
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
