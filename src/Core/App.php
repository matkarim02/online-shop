<?php

namespace Core;
use Controllers\CartController;
use Controllers\CatalogController;
use Controllers\UserController;
use Controllers\OrderController;
class App
{
    private array $routes = [];

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

    public function addRoute(string $route, string $routeMethod, string $className, string $method): void
    {
        $this->routes[$route][$routeMethod] = [
            'class' => $className,
            'method' => $method,
        ];
    }

    public function get(string $route, string $className, string $method): void
    {
        $this->routes[$route]['GET'] = [
            'class' => $className,
            'method' => $method,
        ];
    }

    public function post(string $route, string $className, string $method): void
    {
        $this->routes[$route]['POST'] = [
            'class' => $className,
            'method' => $method,
        ];
    }
}