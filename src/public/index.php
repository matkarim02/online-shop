<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];


if ($requestUri === '/registration') {
    require_once './classes/User.php';
    $user = new User();

    if ($requestMethod === 'GET') {
        $user->getRegistrate();
    } elseif ($requestMethod === 'POST') {
        $user->registrate();
    } else {
        echo 'Invalid request method';
    }

} elseif ($requestUri === '/login') {
    require_once './classes/User.php';
    $user = new User();

    if ($requestMethod === 'GET') {
        $user->getLogin();
    } elseif ($requestMethod === 'POST') {
        $user->login();
    } else {
        echo 'Invalid request method';
    }

} elseif ($requestUri === '/catalog') {
    require_once './classes/Catalog.php';
    $catalog = new Catalog();

    if ($requestMethod === 'GET') {
        $catalog->getCatalog();
    } else {
        echo "Invalid request method";
    }

} elseif($requestUri === "/profile") {
    require_once './classes/User.php';
    $user = new User();

    if ($requestMethod === "GET") {
        $user->getProfile();
    }elseif($requestMethod === "POST"){
        $user->getProfile();
    } else {
        echo "Invalid request method";
    }

} elseif ($requestUri === "/editProfile") {
    require_once './classes/User.php';
    $user = new User();

    if ($requestMethod === "GET") {
        $user->getEditProfile();
    } elseif ($requestMethod === "POST") {
        $user->editProfile();
    } else {
        echo "Invalid request method";
    }

} elseif ($requestUri === "/addProduct") {
    require_once './classes/Cart.php';
    $cartProduct = new Cart();
    if ($requestMethod === "GET") {
        $cartProduct->getAddProduct();
    } elseif ($requestMethod === "POST") {
        $cartProduct->addProduct();
    } else {
        echo "Invalid request method";
    }

} elseif($requestUri === "/cart") {
    require_once './classes/Cart.php';
    $cart = new Cart();
    if ($requestMethod === "GET") {
        $cart->getCart();
    } elseif ($requestMethod === "POST") {
        require_once './pages/cart.php'; //ASK?
    } else {
        echo "Invalid request method";
    }

} else {
    http_response_code(404);
    require_once './404.php';

}