<?php
class DB {
    private $host = 'localhost'; 
    private $dbname = 'pdo'; 
    private $username = 'root'; 
    private $password = ''; 
    public $pdo; 

    public function __construct() {
        try {
            
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Verbinding met de database mislukt: " . $e->getMessage();
        }
    }

    public function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM product WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>