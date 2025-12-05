<?php
    require_once('config.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM incomes WHERE id = $id";
    $result_edit = $pdo->query($sql);
    foreach($result_edit AS $rs){
    echo $rs['montant'];
}
?>


