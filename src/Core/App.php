<?php

namespace Core;
use Controllers\CartController;
use Controllers\CatalogController;
use Controllers\UserController;
use Controllers\OrderController;
use Model\ErrorLogs;
use Request\AddProductRequest;
use Service\Logger\LoggerDbService;
use Service\Logger\LoggerFileService;
use Service\Logger\LoggerInterface;


class App
{
    private array $routes = [];
    private LoggerInterface $loggerDbService;
    //private LoggerInterface $loggerFileService;


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
                $requestClass = $handler['request'];

                $controller = new $class();

                try {
                    if($requestClass !== null){
                        $request = new $requestClass($_POST);
                        $controller->$method($request);
                    } else {
                        $controller->$method();
                    }
                } catch (\Throwable $exception) {

                    $this->loggerDbService = new LoggerDbService();
                    $this->loggerDbService->createLogs($exception);


                    //$this->loggerFileService = new LoggerFileService();
                    //$this->loggerFileService->createLogs($exception);


                    require_once "./../Views/500.php";
                }





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

    public function get(string $route, string $className, string $method, string $requestClass = null): void
    {
        $this->routes[$route]['GET'] = [
            'class' => $className,
            'method' => $method,
            'request' => $requestClass,

        ];
    }

    public function post(string $route, string $className, string $method, string $requestClass = null): void
    {
        $this->routes[$route]['POST'] = [
            'class' => $className,
            'method' => $method,
            'request' => $requestClass,
        ];
    }
}