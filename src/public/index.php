<?php


$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];


if ($requestUri === '/registration') {
    require_once '../Controllers/UserController.php';
    $user = new UserController();

    if ($requestMethod === 'GET') {
        $user->getRegistrate();
    } elseif ($requestMethod === 'POST') {
        $user->registrate();
    } else {
        echo 'Invalid request method';
    }

} elseif ($requestUri === '/login') {
    require_once '../Controllers/UserController.php';
    $user = new UserController();

    if ($requestMethod === 'GET') {
        $user->getLogin();
    } elseif ($requestMethod === 'POST') {
        $user->login();
    } else {
        echo 'Invalid request method';
    }

} elseif ($requestUri === '/catalog') {
    require_once '../Controllers/CatalogController.php';
    $catalog = new CatalogController();

    if ($requestMethod === 'GET') {
        $catalog->getCatalog();
    } else {
        echo "Invalid request method";
    }

} elseif($requestUri === "/profile") {
    require_once '../Controllers/UserController.php';
    $user = new UserController();

    if ($requestMethod === "GET") {
        $user->getProfile();
    }elseif($requestMethod === "POST"){
        $user->getProfile();
    } else {
        echo "Invalid request method";
    }

} elseif ($requestUri === "/editProfile") {
    require_once '../Controllers/UserController.php';
    $user = new UserController();

    if ($requestMethod === "GET") {
        $user->getEditProfile();
    } elseif ($requestMethod === "POST") {
        $user->editProfile();
    } else {
        echo "Invalid request method";
    }

} elseif ($requestUri === "/addProduct") {
    require_once '../Controllers/CartController.php';
    $cartProduct = new CartController();
    if ($requestMethod === "GET") {
        $cartProduct->getAddProduct();
    } elseif ($requestMethod === "POST") {
        $cartProduct->addProduct();
    } else {
        echo "Invalid request method";
    }

} elseif($requestUri === "/cart") {
    require_once '../Controllers/CartController.php';
    $cart = new CartController();
    if ($requestMethod === "GET") {
        $cart->getCart();
    } elseif ($requestMethod === "POST") {
        require_once '../Views/cart.php'; //ASK?
    } else {
        echo "Invalid request method";
    }

} else {
    http_response_code(404);
    require_once './404.php';

}