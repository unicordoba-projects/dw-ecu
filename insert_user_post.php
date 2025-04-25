<?php

include("config.inc.php");
include("connect.db.php");
include("commons/codes/usuarios_responses.php");
include("commons/format_response.php");

try {
    //code...


    $connect = connect_db($dbname, $username, $password);

    $sql = "INSERT INTO usershggggg (username, password, first_name, last_name, email) 
        VALUES ( :username, :password, :first_name, :last_name, :email )";

    $statement = $connect->prepare($sql);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
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
    format_response($usuario_response['ERROR']);
    // print($th->getMessage());
}