<?php
//     require_once('config.php');
//     $id = $_GET['id'];
//     $sql = "SELECT * FROM incomes WHERE id = $id";
//     $result_edit = $pdo->query($sql);
//     foreach($result_edit AS $rs){

// }
require_once('config.php');

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM incomes WHERE id = ?");
$stmt->execute([$id]);

$rs = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$rs) {
    die("Revenu introuvable !");
}
?>



