<?php

$router->add('users',      'UsersController', 'index', 'GET');
$router->add('users/{id}',  'UsersController', 'show',  'GET');
$router->add('users',      'UsersController', 'store', 'POST');
