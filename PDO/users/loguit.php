<?php
require_once "user.php"; 

$userModel = new User(new DB());
$userModel->logout();

header("Location: login.php"); 
exit();
?>
<html>
    <link rel="stylesheet" href="style.css">
</html>