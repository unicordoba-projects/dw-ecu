<?php

include("config.inc.php");
include("connect.db.php");

$connect = connect_db($dbname, $username, $password);

$sql = "SELECT * FROM users";

$statement = $connect->prepare($sql);
$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

$connect = null;
?>
