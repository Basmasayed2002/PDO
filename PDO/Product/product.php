<?php
require_once "../Includes/db.php";

class Product
{
    private $pdo;

    public function __construct(DB $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertProduct($omschrijving, $prijs, $fileToUpload)
    {
        return $this->pdo->execute("INSERT INTO product (omschrijving, prijs, fileToUpload) VALUES (?,?,?)", [$omschrijving, $prijs, $fileToUpload]);
    }

    public function selectProducts()
    {
        return $this->pdo->execute("SELECT * FROM product")->fetchAll();
    }

    public function editProduct($id, $omschrijving, $prijs, $fileToUpload = null)
    {
        return $this->pdo->editProduct($id, $omschrijving, $prijs, $fileToUpload);
    }

    public function selectProductById($id)
    {
        $sql = "SELECT * FROM product WHERE id = ?";
        return $this->pdo->execute($sql, [$id])->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($id)
    {
        return $this->pdo->deleteProduct($id);
    }
    
}