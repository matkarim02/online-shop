<?php

namespace Controllers;
use Model\Order;
use Model\UserProduct;
use Model\OrderProduct;
use Model\Product;

class OrderController extends BaseController
{

    private Order $orderModel;
    private UserProduct $userProductModel;
    private OrderProduct $orderProductModel;
    private Product $productModel;

    public function __construct() {
        parent::__construct();
        $this->orderModel = new Order();
        $this->userProductModel = new UserProduct();
        $this->orderProductModel = new OrderProduct();
        $this->productModel = new Product();
    }



    public function getCheckoutForm()
    {


        if(!$this->authService->check()) {
            header('Location: /login');
            exit();
        }

        $user = $this->authService->getUser();

        $userProducts = $this->userProductModel->getUserProductsById($user->getId());

        if($userProducts !== null) {
            $products = [];
            $total = 0;
            foreach($userProducts as $userProduct) {
                $product_id = $userProduct->getProductId();
                $product = $this->productModel->getProductById($product_id);
                if($product !== null && ($userProduct->getAmount()) !== null) {
                    $userProduct->setProduct($product);
                    $products[] = $userProduct;
                    $total += $product->getPrice()*$userProduct->getAmount();
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


        if(!$this->authService->check()) {
            header('Location: /login');
            exit();
        }

        $errors = $this->validateCheckoutForm($_POST);

        $user = $this->authService->getUser();

        $userProducts = $this->userProductModel->getUserProductsById($user->getId());

        if($userProducts !== null) {
            $products = [];
            $total = 0;
            foreach($userProducts as $userProduct) {
                $product_id = $userProduct->getProductId();
                $product = $this->productModel->getProductById($product_id);
                if($product !== null && ($userProduct->getAmount()) !== null) {
                    $userProduct->setProduct($product);
                    $products[] = $userProduct;
                    $total += $product->getPrice()*$userProduct->getAmount();
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
                $productId = $userProduct->getProductId();
                $amount = $userProduct->getAmount();
                $this->orderProductModel->createOrderProducts($orderId, $productId, $amount);
            }

            $this->userProductModel->deleteByUserId($user_id);



        }
        require_once "./../Views/order_form.php";

    }





    public function getAllOrders()
    {

        if(!$this->authService->check()){
            header('Location: /login');
            exit();
        }

        $user = $this->authService->getUser();

        $userOrders = $this->orderModel->getAllByUserId($user->getId());

        $newUserOrders = [];

        if($userOrders){
            foreach($userOrders as $userOrder){
                $orderId = $userOrder->getId();
                $orderProducts = $this->orderProductModel->getAllByOrderId($orderId);

                if($orderProducts !== null){
                    $orderProductDetails = [];
                    $sumAll = 0;

                    foreach ($orderProducts as $orderProduct){
                        $productId = $orderProduct->getProductId();
                        $product = $this->productModel->getProductById($productId);
                        $orderProduct->setProduct($product);
                        $orderProduct->setProductTotal($orderProduct->getProduct()->getPrice() * $orderProduct->getAmount());

                        $orderProductDetails[] = $orderProduct;
                        $sumAll += $orderProduct->getProductTotal();
                    }

                    $userOrder->setSumAll($sumAll);
                    $userOrder->setProductDetails($orderProductDetails);

                    $newUserOrders[] = $userOrder;

                }
            }
        } else {
            header('Location: /catalog');
        }
        require_once "./../Views/user_order_page.php";

    }



}

