<?php

namespace Core;

class Autoloader
{
    public static function register(string $dir){


        $autoload = function (string $className) use ($dir)
        {
            $path = $dir . "/" . str_replace("\\", "/", $className) . ".php";
            if(file_exists($path)){
                require_once $path;
                return true;
            }
            return false;
        };


        spl_autoload_register($autoload);

    }
}