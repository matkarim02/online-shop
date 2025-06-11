<?php

namespace Controllers;
use DTO\AddCartDTO;
use Request\AddProductRequest;
use Request\DecreaseProductRequest;
use Service\CartService;

class CartController extends BaseController
{

    private CartService $cartService;

    public function __construct()
    {
        parent::__construct();
        $this->cartService = new CartService();
    }

    public function getCart()
    {

        if (!$this->authService->check()) {
            header('location: /login');
            exit();
        }


        $userProducts = $this->cartService->getUserProduct();



        if (empty($userProducts)) {
            header('location: /catalog');
            exit();
        }

        $total = $this->cartService->getTotal();
        require_once '../Views/cart.php';
    }


    //---------ADD_PRODUCT----------

    public function getAddProduct()
    {
        require_once '../Views/add_product.php';
    }





    public function addProduct(AddProductRequest $request)
    {


        if (!$this->authService->check()) {
            header("Location: /login");
            exit();
        }


        $errors = $request->validateAddProduct();

        if (empty($errors)) {

            $dto = new AddCartDTO($request->getProductId(), $request->getAmount());

            $this->cartService->addProduct($dto);


        }
        header('location: /catalog');

    }


    public function decreaseProduct(DecreaseProductRequest $request)
    {


        if(!$this->authService->check()){
            header("Location: /login");
            exit();
        }

        $errors = $request->validateAddProduct();

        if(empty($errors)) {

            $dto = new AddCartDTO($request->getProductId(), $request->getAmount());

            $this->cartService->decreaseProduct($dto);
        }


        header("Location: /catalog");

    }
}