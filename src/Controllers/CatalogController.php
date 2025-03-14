<?php

namespace Controllers;
use Model\Product;

class CatalogController
{
    public function getCatalog()
    {
        session_start();

//if(!isset($_COOKIE['user_id'])) {
//    header("Location: /login_form.php");
//}

        if (isset($_SESSION['userId'])) {

            $productModel = new Product();
            $products = $productModel->getAllProduct();


            require_once '../Views/catalog_page.php';

        } else {
            header("Location: /login");
        }
    }
}