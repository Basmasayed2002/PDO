<?php
require_once "../Includes/db.php";

class Product
{
    private $db; // Zorg ervoor dat dit overeenkomt met wat in DB wordt verwacht

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function insertProduct($omschrijving, $prijs, $fileToUpload)
    {
        $sql = "INSERT INTO product (omschrijving, prijs, fileToUpload) VALUES (?,?,?)";
        return $this->db->execute($sql, [$omschrijving, $prijs, $fileToUpload]);
    }

    public function selectProducts()
    {
        $sql = "SELECT id, omschrijving, prijs FROM product";
        return $this->db->execute($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editProduct($id, $omschrijving, $prijs, $fileToUpload = null)
    {
        $sql = "UPDATE product SET omschrijving = ?, prijs = ?, fileToUpload = ? WHERE id = ?";
        return $this->db->execute($sql, [$omschrijving, $prijs, $fileToUpload, $id]);
    }

    public function selectProductById($id)
    {
        $sql = "SELECT * FROM product WHERE id = ?";
        return $this->db->execute($sql, [$id])->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM product WHERE id = ?";
        return $this->db->execute($sql, [$id]);
    }
}
?>
