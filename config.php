<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "smart_wallet";

$connexion = mysqli_connect($host,$user,$pass,$db);

if(!$connexion){
    die ("Connexion Failed !". mysqli_connect_error());
}
?>