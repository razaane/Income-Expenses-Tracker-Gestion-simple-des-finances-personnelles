<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "smart_wallet";
try{
$pdo = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
}catch(PDOException $erreur){
    die("erreur de connexion:" . $erreur->getMessage());
}

