<?php

namespace Core;
use Controllers\CartController;
use Controllers\CatalogController;
use Controllers\UserController;
use Controllers\OrderController;
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
            '/cart' => [
                'GET' => [
                    'class' => CartController::class,
                    'method' => 'getCart'
                ],
                'POST' => [
                    'class' => CartController::class,
                    'method' => 'addProduct'
                ]

            ],
            '/logout' => [
                'GET' => [
                    'class' => CartController::class,
                    'method' => 'logout'
                ]
            ],
            '/create-order' => [
                'GET' => [
                    'class' => OrderController::class,
                    'method' => 'getCheckoutForm'
                ],
                'POST' => [
                    'class' => OrderController::class,
                    'method' => 'handleCheckout'
                ]
            ],
            '/user-order' => [
                'GET' => [
                    'class' => OrderController::class,
                    'method' => 'getAllOrders'
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

    }
}