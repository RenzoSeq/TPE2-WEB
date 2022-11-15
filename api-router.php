<?php
require_once './libs/Router.php';
require_once './app/controllers/shoes-api.controller.php';
require_once './app/controllers/auth.api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo

$router->addRoute('shoes', 'GET', 'ShoesController', 'getShoes');
$router->addRoute('shoes/:ID', 'GET', 'ShoesController', 'getShoe');
$router->addRoute('shoes/:ID', 'DELETE', 'ShoesController', 'deleteShoe');
$router->addRoute('shoes', 'POST', 'ShoesController', 'insertShoe'); 
$router->addRoute('shoes/:ID', 'PUT', 'ShoesController', 'editShoe'); 

$router->addRoute('auth/token', 'GET', 'AuthApiController', 'getToken'); 



// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);