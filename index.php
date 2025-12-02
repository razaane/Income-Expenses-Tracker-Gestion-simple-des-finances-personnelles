<?php 
include'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Wallet</title>
</head>
<body>
    <form action ="traitement.php" method="POST" >
        <label>Montant :</label>
        <input type="number" name="montant" step="0.01" required><br>
        <label>Descreption:</label>
        <input type="text" name="descreption" required><br>
        <button>Submit</button>
    </form>
    
</body>
</html>