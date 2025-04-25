
<?php


include("config.inc.php");
include("connect.db.php");

$connect = connect_db($dbname, $username, $password);

$username = $_GET['username'];

$sql = "SELECT * FROM users WHERE username = :username";

$statement = $connect->prepare($sql);
$statement->bindParam(':username', $username);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

$connect = null;
?>