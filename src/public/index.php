<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];


if ($requestUri === '/registration') {

    if ($requestMethod === 'GET') {
        require_once './registration_form.php';
    } elseif ($requestMethod === 'POST') {
        require_once './handle_registration_form.php';
    } else {
        echo 'Invalid request method';
    }

} elseif ($requestUri === '/login') {

    if ($requestMethod === 'GET') {
        require_once './login_form.php';
    } elseif ($requestMethod === 'POST') {
        require_once './login_handle.php';
    } else {
        echo 'Invalid request method';
    }

} elseif ($requestUri === '/catalog') {

    if ($requestMethod === 'GET') {
        require_once './catalog.php';
    } else {
        echo "Invalid request method";
    }

} elseif($requestUri === "/profile") {

    if ($requestMethod === "GET") {
        require_once "./profile_handle.php";
    } else {
        echo "Invalid request method";
    }

} elseif ($requestUri === "/editProfile") {

    if ($requestMethod === "GET") {
        require_once './edit_profile_page.php';
    } elseif ($requestMethod === "POST") {
        require_once './edit_profile_handle.php';
    } else {
        echo "Invalid request method";
    }

} elseif ($requestUri === "/addProduct") {

    if ($requestMethod === "GET") {
        require_once './add_product.php';
    } elseif ($requestMethod === "POST") {
        require_once './handle_add_product.php';
    } else {
        echo "Invalid request method";
    }

} elseif($requestUri === "/cart") {

    if ($requestMethod === "GET") {
        require_once './cart_handle.php';
    } else {
        echo "Invalid request method";
    }

} else {
    http_response_code(404);
    require_once './404.php';

}