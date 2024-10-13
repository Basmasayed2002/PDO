<?php
require_once "../Includes/db.php";
require_once "product.php";

$db = new DB(); // Maak de DB-verbinding
$product = new Product($db); // Geef de DB-instantie door aan de Product-klasse

$producten = $product->selectProducts(); // Haal alle producten op
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten Overzicht</title>
</head>
<body>

<h1>Producten Overzicht</h1>
<table border="1">
    <tr>
        <th>Product Code</th>
        <th>Naam</th>
        <th>Prijs</th>
        <th colspan="2">Acties</th>
    </tr>

    <?php foreach ($producten as $product): ?>
    <tr>
        <td><?php echo isset($product['id']) ? $product['id'] : 'N/A'; ?></td>
        <td><?php echo isset($product['omschrijving']) ? $product['omschrijving'] : 'N/A'; ?></td>
        <td><?php echo isset($product['prijs']) ? $product['prijs'] : 'N/A'; ?></td>
        <td><a href="product-edit.php?id=<?php echo isset($product['id']) ? $product['id'] : '#'; ?>">Bewerken</a></td>
        <td><a href="product-delete.php?id=<?php echo isset($product['id']) ? $product['id'] : '#'; ?>">Verwijderen</a></td>
    </tr>
<?php endforeach; ?>

</table>

</body>
</html>
