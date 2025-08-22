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
$app->post('/registration', UserController::class, 'registrate', \Request\RegistrateRequest::class);

// Авторизация
$app->get('/login', UserController::class, 'getLogin');
$app->post('/login', UserController::class, 'login', \Request\LoginRequest::class);

// Каталог
$app->get('/catalog', CatalogController::class, 'getCatalog');

// Профиль
$app->get('/profile', UserController::class, 'getProfile');

// отзыв продукта
$app->post('/product', CatalogController::class, 'getProduct', \Request\GetProductRequest::class);
$app->post('/add-review', CatalogController::class, 'addReview', \Request\AddReviewRequest::class);

// Редактирование профиля
$app->get('/editProfile', UserController::class, 'getEditProfile');
$app->post('/editProfile', UserController::class, 'editProfile', \Request\EditProfileRequest::class);

// Корзина
$app->get('/cart', CartController::class, 'getCart');
$app->post('/cart-increase', CartController::class, 'addProduct', \Request\AddProductRequest::class);
$app->post('/cart-decrease', CartController::class, 'decreaseProduct', \Request\DecreaseProductRequest::class);

// Выход
$app->get('/logout', UserController::class, 'logout');

// Заказ
$app->get('/create-order', OrderController::class, 'getCheckoutForm');
$app->post('/create-order', OrderController::class, 'handleCheckout', \Request\HandleCheckoutRequest::class);

// Заказы пользователя
$app->get('/user-order', OrderController::class, 'getAllOrders');


$app->run();