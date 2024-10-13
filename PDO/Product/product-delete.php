<?php
require_once "../Includes/db.php";

// Controleer of de ID is opgegeven via de URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Maak een nieuwe DB-object aan
    $db = new DB();

    // Probeer het product te verwijderen
    if ($db->deleteProduct($id)) {
        echo "Product met ID $id is succesvol verwijderd.";
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van het product.";
    }
} else {
    echo "Product ID niet opgegeven.";
}
?>