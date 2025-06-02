<?php

namespace Controllers;
use Model\Product;
use Model\UserProduct;

class CatalogController extends BaseController
{
    private Product $productModel;
    private UserProduct $userProductModel;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = new Product();
        $this->userProductModel = new UserProduct();
    }

    public function getCatalog()
    {


        if (!$this->authService->check()) {
            header('location: /login');
            exit();
        }
        $user = $this->authService->getUser();
        $products = $this->productModel->getAllProduct();


        if($products !== null){
            $newProducts = [];
            foreach ($products as $product)
            {
                $user_product = $this->userProductModel->getById($user->getId(), $product->getId());
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