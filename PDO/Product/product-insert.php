<?php
require '../Includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['naam'];  
    $prijsPerStuk = $_POST['prijsPerStuk'];
    
    // Foto uploaden
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true); 
        }

        $foto = 'uploads/' . basename($_FILES['foto']['name']);
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
            echo "Foto succesvol geüpload.<br>";
        } else {
            die("Fout bij het uploaden van de foto.<br>");
        }
    } else {
        $foto = null;
    }

    // SQL query aanpassen naar 'naam' in plaats van 'omschrijving'
    $sql = "INSERT INTO product (naam, foto, prijs) VALUES (:naam, :foto, :prijsPerStuk)";
    
    // Gebruik de execute methode van de DB klasse
    try {
        $db->execute($sql, [
            ':naam' => $naam,
            ':foto' => $foto,
            ':prijsPerStuk' => $prijsPerStuk
        ]);

        echo "Product succesvol toegevoegd!";
    } catch (PDOException $e) {
        echo "SQL Error: " . $e->getMessage();
    }
}
?>
<form action="product-insert.php" method="POST" enctype="multipart/form-data">
    <label for="name">Naam:</label>
    <input type="text" id="name" name="naam" required><br>

    <label for="price">Prijs per stuk:</label>
    <input type="text" id="price" name="prijsPerStuk" required><br>

    <label for="photo">Foto:</label>
    <input type="file" id="photo" name="foto"><br>

    <input type="submit" value="Toevoegen">
</form>
