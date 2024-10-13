<?php
require_once "../Includes/db.php";  
require_once "product.php";  

$db = new DB();  
$productModel = new Product($db);  

// Controleer of de ID is opgegeven
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = $productModel->selectProductById($id); 
    
    // Controleer of het product bestaat
    if (!$product) {
        die("Product niet gevonden.");
    }
} else {
    die("Product ID niet opgegeven.");
}

// Verwerk het formulier als het is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $omschrijving = $_POST['omschrijving'];
    $prijs = $_POST['prijs'];
    $foto = $_FILES['foto']['name'] ? $_FILES['foto']['name'] : $product['foto']; 
    
    // Controleer of er een bestand is geüpload
    if ($_FILES['foto']['error'] == 0) {
        $uploadMap = 'uploads/';
        
        // Maak de uploadmap aan als deze nog niet bestaat
        if (!file_exists($uploadMap)) {
            mkdir($uploadMap, 0777, true);
        }
        
        // Verplaats het geüploade bestand
        move_uploaded_file($_FILES['foto']['tmp_name'], $uploadMap . $foto);
    }
    
    // Update het product in de database
    if ($productModel->updateProduct($id, $omschrijving, $prijs, $foto)) {
        echo "Product succesvol bijgewerkt!";
        // Optioneel: redirect naar product-overzicht of een andere pagina
        header("Location: product-view.php");
        exit();
    } else {
        echo "Fout bij het bijwerken van het product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Bewerken</title>
</head>
<body>
<h2>Bewerken van product: <?php echo htmlspecialchars($product['omschrijving']); ?></h2>
<form action="product-edit.php?id=<?php echo urlencode($id); ?>" method="POST" enctype="multipart/form-data">
    <label for="omschrijving">Omschrijving:</label>
    <input type="text" id="omschrijving" name="omschrijving" value="<?php echo htmlspecialchars($product['omschrijving']); ?>" required><br>

    <label for="prijs">Prijs:</label>
    <input type="text" id="prijs" name="prijs" value="<?php echo isset($product['prijs']) ? htmlspecialchars($product['prijs']) : ''; ?>" required><br>

    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto"><br>
    <span><?php echo isset($product['foto']) ? htmlspecialchars($product['foto']) : 'Geen bestand gekozen'; ?></span><br>

    <input type="submit" value="Bijwerken">
</form>
</body>
</html>

