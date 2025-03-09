<?php

namespace Core;
use Controllers\CartController;
use Controllers\CatalogController;
use Controllers\UserController;
class App
{
    private array $routes = [
            '/registration' => [
                'GET' => [
                    'class' => UserController::class,
                    'method' => 'getRegistrate'
                ],
                'POST' => [
                    'class' => UserController::class,
                    'method' => 'registrate'
                ]
            ],
            '/login' => [
                'GET' => [
                    'class' => UserController::class,
                    'method' => 'getLogin'
                ],
                'POST' => [
                    'class' => UserController::class,
                    'method' => 'login'
                ]
            ],
            '/catalog' => [
                'GET' => [
                    'class' => CatalogController::class,
                    'method' => 'getCatalog'
                ]
            ],
            '/profile' => [
                'GET' => [
                    'class' => UserController::class,
                    'method' => 'getProfile'
                ]
            ],
            '/editProfile' => [
                'GET' => [
                    'class' => UserController::class,
                    'method' => 'getEditProfile'
                ],
                'POST' => [
                    'class' => UserController::class,
                    'method' => 'editProfile'
                ]
            ],
            '/addProduct' => [
                'GET' => [
                    'class' => CartController::class,
                    'method' => 'getAddProduct'
                ],
                'POST' => [
                    'class' => CartController::class,
                    'method' => 'addProduct'
                ]
            ],
            '/cart' => [
                'GET' => [
                    'class' => CartController::class,
                    'method' => 'getCart'
                ]
            ],
            '/logout' => [
                'GET' => [
                    'class' => CartController::class,
                    'method' => 'logout'
                ]
            ]

        ];

    public function run(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];







        if(!empty($this->routes[$requestUri])){
            $routeMethods = $this->routes[$requestUri];
            if(!empty($routeMethods[$requestMethod])) {
                $handler = $routeMethods[$requestMethod];
                $class = $handler['class'];
                $method = $handler['method'];


                $controller = new $class();
                $controller->$method();

            } else {
                echo 'Invalid request method';
            }
        } else {
            http_response_code(404);
            require_once '../Views/404.php';
        }


//        if ($requestUri === '/registration') {
//            require_once '../Controllers/UserController.php';
//            $user = new UserController();
//
//            if ($requestMethod === 'GET') {
//                $user->getRegistrate();
//            } elseif ($requestMethod === 'POST') {
//                $user->registrate();
//            } else {
//                echo 'Invalid request method';
//            }
//
//        } elseif ($requestUri === '/login') {
//            require_once '../Controllers/UserController.php';
//            $user = new UserController();
//
//            if ($requestMethod === 'GET') {
//                $user->getLogin();
//            } elseif ($requestMethod === 'POST') {
//                $user->login();
//            } else {
//                echo 'Invalid request method';
//            }
//
//        } elseif ($requestUri === '/catalog') {
//            require_once '../Controllers/CatalogController.php';
//            $catalog = new CatalogController();
//
//            if ($requestMethod === 'GET') {
//                $catalog->getCatalog();
//            } else {
//                echo "Invalid request method";
//            }
//
//        } elseif($requestUri === "/profile") {
//            require_once '../Controllers/UserController.php';
//            $user = new UserController();
//
//            if ($requestMethod === "GET") {
//                $user->getProfile();
//            } else {
//                echo "Invalid request method";
//            }
//
//        } elseif ($requestUri === "/editProfile") {
//            require_once '../Controllers/UserController.php';
//            $user = new UserController();
//
//            if ($requestMethod === "GET") {
//                $user->getEditProfile();
//            } elseif ($requestMethod === "POST") {
//                $user->editProfile();
//            } else {
//                echo "Invalid request method";
//            }
//
//        } elseif ($requestUri === "/addProduct") {
//            require_once '../Controllers/CartController.php';
//            $cartProduct = new CartController();
//            if ($requestMethod === "GET") {
//                $cartProduct->getAddProduct();
//            } elseif ($requestMethod === "POST") {
//                $cartProduct->addProduct();
//            } else {
//                echo "Invalid request method";
//            }
//
//        } elseif($requestUri === "/cart") {
//            require_once '../Controllers/CartController.php';
//            $cart = new CartController();
//            if ($requestMethod === "GET") {
//                $cart->getCart();
//            } elseif ($requestMethod === "POST") {
//                require_once '../Views/cart.php'; //ASK?
//            } else {
//                echo "Invalid request method";
//            }
//
//        } else {
//            http_response_code(404);
//            require_once './404.php';
//
//        }
    }
}