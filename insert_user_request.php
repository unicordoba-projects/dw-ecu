<?php

include("config.inc.php");
include("connect.db.php");
include("commons/codes/usuarios_responses.php");
include("commons/format_response.php");


$rawBody = file_get_contents('php://input');
$data = json_decode($rawBody, true);

try {
    $connect = connect_db($dbname, $username, $password);

    $sql = "INSERT INTO users (username, password, first_name, last_name, email) 
        VALUES ( :username, :password, :first_name, :last_name, :email )";

    $statement = $connect->prepare($sql);

    $username = $data['username'];
    $password = $data['password'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);
    $statement->bindParam(':first_name', $first_name);
    $statement->bindParam(':last_name', $last_name);
    $statement->bindParam(':email', $email);

    $result = $statement->execute();


    if (!$result) {
        format_response($usuario_response['ERROR']);
    } else {
        format_response($usuario_response['CREATE'], $result);
    }


} catch (\Throwable $th) {
    format_response($usuario_response['ERROR'], $th->getMessage());
    // print();
}