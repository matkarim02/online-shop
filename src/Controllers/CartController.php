<?php

namespace Controllers;
use Model\Product;
use Model\UserProduct;

class CartController
{
    private  UserProduct $userProductModel;
    private Product $productModel;

    public function __construct()
    {
        $this->userProductModel = new UserProduct();
        $this->productModel = new Product();
    }

    public function getCart()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['userId'])) {
            header('location: /login');
            exit();
        }


        $userId = $_SESSION['userId'];



        $userProducts = $this->userProductModel->getUserProductsById($userId);


        if ($userProducts !== null) {
            $products = [];
            $total = 0;
            foreach ($userProducts as $userProduct) {
                $user_productId = $userProduct->getProductId();


                $product = $this->productModel->getProductById($user_productId);

                if ($product !== null && ($userProduct->getAmount()) !== null) {
                    $userProduct->setProduct($product);
                    $products[] = $userProduct;

                }
            }
            require_once '../Views/cart.php';
        } else {
            header('location: /catalog');
        }
    }


    //---------ADD_PRODUCT----------

    public function getAddProduct()
    {
        require_once '../Views/add_product.php';
    }


    private function validateAddProduct(array $data): array
    {

        $errors = [];

        if (!empty($data['product_id'])) {
            $product_id = (int)$data['product_id'];


            $product = $this->productModel->getProductById($product_id);

            if ($product === false) {
                $errors['product_id'] = "Product does not exist";
            }
        } else {
            $errors['product_id'] = "Product ID is required";
        }


        if (empty($data['amount'])) {
            $errors['amount'] = 'Amount is required';
        } elseif (!is_numeric($data['amount'])) {
            $errors['amount'] = 'Amount must be numeric';
        }

        return $errors;
    }


    public function addProduct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['userId'])) {
            header("Location: /login");
            exit();
        }


        $errors = $this->validateAddProduct($_POST);

        if (empty($errors)) {
            $user_id = $_SESSION['userId'];
            $product_id = $_POST['product_id'];
            $amount = $_POST['amount'];


            $user_product = $this->userProductModel->getById($user_id, $product_id);

            if ($user_product !== null) {
                $amount = $user_product->getAmount() + $amount;

                $this->userProductModel->updateAmountById($user_id, $product_id, $amount);

            } else {

                $this->userProductModel->setUserProduct($user_id, $product_id, $amount);

            }
        }
        header('location: /catalog');

    }


    public function decreaseProduct()
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        if(!isset($_SESSION['userId'])){
            header("Location: /login");
            exit();
        }

        $user_id = $_SESSION['userId'];
        $product_id = $_POST['product_id'];
        $amount = $_POST['amount'];

        $user_product = $this->userProductModel->getById($user_id, $product_id);

        if($user_product !== null){
            if($user_product->getAmount() == 1){
                $this->userProductModel->deleteByUserIdProductId($user_id, $product_id);
            }
            $amount = $user_product->getAmount() - $amount;

            $this->userProductModel->updateAmountById($user_id, $product_id, $amount);
        }

        header("Location: /catalog");

    }
}