<?php

include("config.inc.php");
include("connect.db.php");

$connect = connect_db($dbname, $username, $password);

$sql = "SELECT * FROM users";
$res = $connect->query($sql);

$respuesta = [];
foreach ($res as $fila) {
    $respuesta[] = $fila;
}

// echo "<pre>";
// print_r($respuesta);
// echo "</pre>";

header('Content-type:application/json;charset=utf-8');
echo json_encode($respuesta);

$connect = null;
?>
