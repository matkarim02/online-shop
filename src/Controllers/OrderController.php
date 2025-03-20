<?php

namespace Controllers;
use Model\Order;
use Model\UserProduct;
use Model\OrderProduct;
use Model\Product;

class OrderController
{

    private Order $orderModel;
    private UserProduct $userProductModel;
    private OrderProduct $orderProductModel;
    private Product $productModel;

    public function __construct() {
        $this->orderModel = new Order();
        $this->userProductModel = new UserProduct();
        $this->orderProductModel = new OrderProduct();
        $this->productModel = new Product();
    }



    public function getCheckoutForm()
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if(empty($_SESSION['userId'])) {
            header('Location: /login');
            exit();
        }

        $user_id = $_SESSION['userId'];

        $userProducts = $this->userProductModel->getUserProductsById($user_id);

        if($userProducts) {
            $products = [];
            $total = 0;
            foreach($userProducts as $userProduct) {
                $product_id = $userProduct['product_id'];
                $product = $this->productModel->getProductById($product_id);
                if($product && !empty($userProduct['amount'])) {
                    $products[] = array_merge($userProduct, $product);
                    $total += $product['price']*$userProduct['amount'];
                }

            }
        } else {
            header('location: /catalog');
            exit();
        }


        require_once "./../Views/order_form.php";
    }




    private function validateCheckoutForm(array $data): array
    {
        $errors = [];

        if(!empty($data['name'])) {
            $contactName = $data['name'];

            if(strlen($contactName) < 2) {
                $errors['name'] = "Имя должно содержать не менее 2 символов";
            }
        } else {
            $errors['name'] = "Заполните поле";
        }

        if(!empty($data['phone'])) {
            $contactPhone = $data['phone'];

//            if(!is_numeric($contactPhone)) {
//                $errors['phone'] = "Поле должно содержать номер";
//            }
        } else {
            $errors['phone'] = "Заполните поле";
        }

        return $errors;
    }




    public function handleCheckout()
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if(empty($_SESSION['userId'])) {
            header('Location: /login');
            exit();
        }

        $errors = $this->validateCheckoutForm($_POST);
        $user_id = $_SESSION['userId'];

        $userProducts = $this->userProductModel->getUserProductsById($user_id);

        if($userProducts) {
            $products = [];
            $total = 0;
            foreach($userProducts as $userProduct) {
                $product_id = $userProduct['product_id'];
                $product = $this->productModel->getProductById($product_id);
                if($product && !empty($userProduct['amount'])) {
                    $products[] = array_merge($userProduct, $product);
                    $total += $product['price']*$userProduct['amount'];
                }

            }
        } else {
            header('location: /catalog');
            exit();
        }

        if(empty($errors)) {
            $contactName = $_POST['name'];
            $contactPhone = $_POST['phone'];
            $comments = $_POST['comments'];
            $address = $_POST['address'];
            $user_id = $_SESSION['userId'];

            $orderId = $this->orderModel->createOrder($contactName, $contactPhone, $address, $comments, $user_id);

            $userProducts = $this->userProductModel->getUserProductsById($user_id);

            foreach ($userProducts as $userProduct) {
                $productId = $userProduct['product_id'];
                $amount = $userProduct['amount'];
                $this->orderProductModel->createOrderProducts($orderId, $productId, $amount);
            }

            $this->userProductModel->deleteByUserId($user_id);



        }
        require_once "./../Views/order_form.php";

    }





    public function getAllOrders()
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        if(!isset($_SESSION['userId'])){
            header('Location: /login');
            exit();
        }

        $userId = $_SESSION['userId'];

        $userOrders = $this->orderModel->getAllByUserId($userId);

        $newUserOrders = [];

        if(!empty($userOrders)){
            foreach($userOrders as $userOrder){
                $orderId = $userOrder['id'];
                $orderProducts = $this->orderProductModel->getAllByOrderId($orderId);

                if(!empty($orderProducts)){
                    $orderProductDetails = [];
                    $sumAll = 0;

                    foreach ($orderProducts as $orderProduct){
                        $productId = $orderProduct['product_id'];
                        $product = $this->productModel->getProductById($productId);
                        $orderProduct['name'] = $product['name'];
                        $orderProduct['description'] = $product['description'];
                        $orderProduct['price'] = $product['price'];
                        $orderProduct['image_url'] = $product['image_url'];

                        $orderProduct['productTotal'] = $orderProduct['price'] * $orderProduct['amount'];
                        $orderProductDetails[] = $orderProduct;
                        $sumAll += $orderProduct['productTotal'];
                    }

                    $userOrder['sum_all'] = $sumAll;
                    $userOrder['productDetails'] = $orderProductDetails;

                    $newUserOrders[] = $userOrder;

                }
            }
        }
        require_once "./../Views/user_order_page.php";

    }



}

