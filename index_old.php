<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


$class = ucfirst($_GET['controller']).'Controller';
$file = $class.'.php';
$path = 'controllers/'.$file;

$action = $_GET['action'];



require_once $path;


$controller = new $class();

if (isset($_GET['id'])) {
    $controller->$action($_GET['id']);
}else{
    $controller->$action();
}

// POST






