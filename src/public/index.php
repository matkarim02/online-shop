<?php

use Controllers\CartController;
use Controllers\CatalogController;
use Controllers\OrderController;
use Controllers\UserController;

require_once './../Core/Autoloader.php';
$path = dirname(__DIR__);
\Core\Autoloader::register($path);



//require_once "../Core/App.php";
$app = new Core\App();

// Регистрация
$app->get('/registration', UserController::class, 'getRegistrate');
$app->post('/registration', UserController::class, 'registrate');

// Авторизация
$app->get('/login', UserController::class, 'getLogin');
$app->post('/login', UserController::class, 'login');

// Каталог
$app->get('/catalog', CatalogController::class, 'getCatalog');

// Профиль
$app->get('/profile', UserController::class, 'getProfile');

// Редактирование профиля
$app->get('/editProfile', UserController::class, 'getEditProfile');
$app->post('/editProfile', UserController::class, 'editProfile');

// Корзина
$app->get('/cart', CartController::class, 'getCart');
$app->post('/cart-increase', CartController::class, 'addProduct');
$app->post('/cart-decrease', CartController::class, 'decreaseProduct');

// Выход
$app->get('/logout', CartController::class, 'logout');

// Заказ
$app->get('/create-order', OrderController::class, 'getCheckoutForm');
$app->post('/create-order', OrderController::class, 'handleCheckout');

// Заказы пользователя
$app->get('/user-order', OrderController::class, 'getAllOrders');


$app->run();