<?php

$router = new \App\Core\Route();

$router->get('api/v1/users', ['UserController', 'index']);
$router->get('api/v1/users/{id}', ['UserController', 'show']);
$router->post('api/v1/users', ['UserController', 'store']);
$router->put('api/v1/users/{id}', ['UserController', 'update']);
$router->delete('api/v1/users/{id}', ['UserController', 'destroy']);

$router->get('api/v1/addresses', ['AddressController', 'index']);
$router->get('api/v1/addresses/{id}', ['AddressController', 'show']);

$router->get('api/v1/cities', ['CityController', 'index']);
$router->get('api/v1/cities/{id}', ['CityController', 'show']);

$router->get('api/v1/states', ['StateController', 'index']);
$router->get('api/v1/states/{id}', ['StateController', 'show']);
