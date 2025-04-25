
<?php


include("config.inc.php");
include("connect.db.php");
include("commons/codes/usuarios_responses.php");
include("commons/format_response.php");

$connect = connect_db($dbname, $username, $password);

$username = $_GET['username'];
$sql = "SELECT * FROM users WHERE username = :username";
$statement = $connect->prepare($sql);
$statement->bindParam(':username', $username);

$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    format_response($usuario_response['READ_ERROR']);
}else{
    format_response($usuario_response['READ'], $result) ;
}


$connect = null;
?>