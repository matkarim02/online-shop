<?php

use Controllers\CartController;
use Controllers\CatalogController;
use Controllers\OrderController;
use Controllers\UserController;

$autoloader = function (string $className){
    $path = "./../" . str_replace("\\", "/", $className) . ".php";
    if(file_exists($path)){
        require_once $path;
        return true;
    }
    return false;
};






spl_autoload_register($autoloader);



//require_once "../Core/App.php";
$app = new Core\App();

$app->addRoute('/registration', 'GET', UserController::class, 'getRegistrate');
$app->addRoute('/registration', 'POST', UserController::class, 'registrate');

$app->addRoute('/login', 'GET', UserController::class, 'getLogin');
$app->addRoute('/login', 'POST', UserController::class, 'login');

$app->addRoute('/catalog', 'GET', CatalogController::class, 'getCatalog');

$app->addRoute('/profile', 'GET', UserController::class, 'getProfile');

$app->addRoute('/editProfile', 'GET', UserController::class, 'getEditProfile');
$app->addRoute('/editProfile', 'POST', UserController::class, 'editProfile');

$app->addRoute('/cart', 'GET', CartController::class, 'getCart');
$app->addRoute('/cart', 'POST', CartController::class, 'addProduct');

$app->addRoute('/logout', 'GET', CartController::class, 'logout');

$app->addRoute('/create-order', 'GET', OrderController::class, 'getCheckoutForm');
$app->addRoute('/create-order', 'POST', OrderController::class, 'handleCheckout');

$app->addRoute('/user-order', 'GET', OrderController::class, 'getAllOrders');


$app->run();