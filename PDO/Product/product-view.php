<?php
require_once "../Includes/db.php";  
require_once "../Includes/Product.php";  

$db = new DB();  
$productModel = new Product($db);  
$producten = $productModel->selectAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
</head>
<body>
<table>
    <tr>
        <th>Product Code</th>
        <th>Naam</th>
        <th>Prijs</th>
        <th colspan="2">Acties</th>
    </tr>
    <?php foreach ($producten as $product): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['id']); ?></td>
            <td><?php echo htmlspecialchars($product['omschrijving']); ?></td>
            <td><?php echo htmlspecialchars($product['prijs']); ?></td>
            <td><a href='product-delete.php?id=<?php echo $product['id']; ?>'>Verwijderen</a></td>
            <td><a href='product-edit.php?id=<?php echo $product['id']; ?>'>Bewerken</a></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
