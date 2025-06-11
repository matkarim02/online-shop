<?php

namespace Controllers;
use DTO\OrderCreateDTO;
use Request\HandleCheckoutRequest;
use Service\CartService;
use Service\OrderService;

class OrderController extends BaseController
{


    private OrderService $orderService;
    private  CartService $cartService;

    public function __construct() {
        parent::__construct();
        $this->orderService = new OrderService();
        $this->cartService = new CartService();
    }



    public function getCheckoutForm()
    {


        if(!$this->authService->check()) {
            header('Location: /login');
            exit();
        }

        $userProducts = $this->cartService->getUserProduct();

        if(empty($userProducts)){
            header('location: /catalog');
            exit();
        }

        $total = $this->cartService->getTotal();
        require_once "./../Views/order_form.php";
    }








    public function handleCheckout(HandleCheckoutRequest $request)
    {


        if(!$this->authService->check()) {
            header('Location: /login');
            exit();
        }

        $errors = $request->validateCheckoutForm();




        if(empty($errors)) {

            $dto = new OrderCreateDTO(
                $request->getName(),
                $request->getPhone(),
                $request->getComment(),
                $request->getAddress(),
            );

            $this->orderService->createOrder($dto);
            header('Location: /user-order');
            exit();



        } else {
            $userProducts = $this->cartService->getUserProduct();

            if(empty($userProducts)){
                header('location: /catalog');
                exit();
            }
            $total = $this->cartService->getTotal();
            require_once "./../Views/order_form.php";
        }


    }





    public function getAllOrders()
    {

        if(!$this->authService->check()){
            header('Location: /login');
            exit();
        }

        $userOrders = $this->orderService->getAll();

        require_once "./../Views/user_order_page.php";

    }



}

