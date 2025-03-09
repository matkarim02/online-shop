<?php

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
$app->run();