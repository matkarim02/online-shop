<?php

namespace Controllers;
use Model\Product;
use Model\UserProduct;

class CatalogController
{
    private Product $productModel;
    private UserProduct $userProductModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->userProductModel = new UserProduct();
    }

    public function getCatalog()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['userId'])) {
            header('location: /login');
            exit();
        }
        $user_id = $_SESSION['userId'];
        $products = $this->productModel->getAllProduct();


        if($products !== null){
            $newProducts = [];
            foreach ($products as $product)
            {
                $user_product = $this->userProductModel->getById($user_id, $product->getId());
                if($user_product === null) {
                    $user_product = new UserProduct();
                    $user_product->setAmount(0);
                }
                $product->setUserProduct($user_product);
                $newProducts[] = $product;
            }
        }
        require_once '../Views/catalog_page.php';

    }
}