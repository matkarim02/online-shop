<?php


class CatalogController
{
    public function getCatalog()
    {
        session_start();

//if(!isset($_COOKIE['user_id'])) {
//    header("Location: /login_form.php");
//}

        if (isset($_SESSION['userId'])) {

            require_once '../Model/Product.php';
            $productModel = new Product();
            $products = $productModel->getProduct();


            require_once '../Views/catalog_page.php';

        } else {
            header("Location: /login");
        }
    }
}