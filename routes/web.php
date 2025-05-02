<?php

use Core\Router;

$router = new Router();

// Rutas para el CRUD de usuarios

$router->add('users', 'UserController', 'index', 'GET');
$router->add('users/create', 'UserController', 'create', 'GET');
$router->add('users', 'UserController', 'store', 'POST');
$router->add('users/{id}', 'UserController', 'show', 'GET');
$router->add('users/{id}/edit', 'UserController', 'edit', 'GET');
$router->add('users/{id}', 'UserController', 'update', 'PUT');
$router->add('users/{id}', 'UserController', 'delete', 'DELETE');

return $router;
