<?php

class CartController
{
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

        require_once '../Model/UserProduct.php';
        $userProductModel = new UserProduct();
        $userProducts = $userProductModel->getUserProductsById($userId);


        if ($userProducts) {
            $products = [];
            foreach ($userProducts as $userProduct) {
                $user_productId = $userProduct['product_id'];

                require_once '../Model/Product.php';
                $productModel = new Product();
                $product = $productModel->getProductById($user_productId);

                if ($product && !empty($userProduct['amount'])) {
                    $products[] = array_merge($userProduct, $product);

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

            require_once '../Model/Product.php';
            $productModel = new Product();
            $product = $productModel->getProductById($product_id);

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

            require_once '../Model/UserProduct.php';
            $userProductModel = new UserProduct();
            $user_product = $userProductModel->getById($user_id, $product_id);

            if ($user_product) {
                $amount = $user_product['amount'] + $amount;

                $userProductModel->updateAmountById($user_id, $product_id, $amount);

            } else {

                $userProductModel->setUserProduct($user_id, $product_id, $amount);

            }
        }
        header('location: /catalog');
//        require_once './pages/add_product.php';
    }
}