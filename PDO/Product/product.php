<?php
require_once "../Includes/db.php"; 

class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function selectAllProducts() {
        $stmt = $this->db->execute("SELECT id, naam, foto, prijs FROM product"); // Voeg 'id' toe
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function addProduct($omschrijving, $foto, $prijs) {
        $sql = "INSERT INTO product (naam, foto, prijs) VALUES (:naam, :foto, :prijs)";
        return $this->db->execute($sql, [
            ':naam' => $omschrijving,
            ':foto' => $foto,
            ':prijs' => $prijs
        ]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $omschrijving = $_POST['omschrijving'];
    $prijsPerStuk = $_POST['prijsPerStuk'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto']['name'];
        $fotoTemp = $_FILES['foto']['tmp_name'];
        $uploadMap = 'uploads/';

        if (!file_exists($uploadMap)) {
            mkdir($uploadMap, 0777, true);
        }

        if (move_uploaded_file($fotoTemp, $uploadMap . $foto)) {
            $productModel = new Product($db);
            if ($productModel->addProduct($omschrijving, $foto, $prijsPerStuk)) {
                echo "Product succesvol toegevoegd!";
            } else {
                echo "Fout bij het toevoegen van het product.";
            }
        } else {
            echo "Fout bij het uploaden van de foto.";
        }
    } else {
        echo "Selecteer een foto.";
    }
}
?>
