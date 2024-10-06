<?php
require_once "../Includes/db.php";  
require_once "product.php";  

$db = new DB();  
$product = new Product($db);  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Overzicht</title>
</head>
<body>
<table>
  <tr>
    <th>Product Code</th>
    <th>Naam</th>
    <th>Prijs</th>
    <th colspan="2">Acties</th>
  </tr>
  
  <?php
  $producten = $product->selectAllProducts();
  foreach ($producten as $product) {
    echo "<tr>";
    echo "<td>" . (isset($product['id']) ? $product['id'] : 'N/A') . "</td>"; // Check of id bestaat
    echo "<td>" . (isset($product['naam']) ? $product['naam'] : 'N/A') . "</td>"; // Check of naam bestaat
    echo "<td>" . (isset($product['prijs']) ? $product['prijs'] : 'N/A') . "</td>"; // Check of prijs bestaat
    echo "<td><a href='product-delete.php?id=" . $product['id'] . "'>Verwijderen</a></td>";
    echo "<td><a href='product-edit.php?id=" . $product['id'] . "'>Bewerken</a></td>";
    echo "</tr>";
  }
  ?>
</table>
</body>
</html>
