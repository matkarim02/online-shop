<?php

namespace Controllers;
use DTO\AddCartDTO;
use Model\Product;
use Model\UserProduct;
use Request\AddProductRequest;
use Request\DecreaseProductRequest;
use Service\CartService;

class CartController extends BaseController
{
    private  UserProduct $userProductModel;
    private Product $productModel;
    private CartService $cartService;

    public function __construct()
    {
        parent::__construct();
        $this->userProductModel = new UserProduct();
        $this->productModel = new Product();
        $this->cartService = new CartService();
    }

    public function getCart()
    {

        if (!$this->authService->check()) {
            header('location: /login');
            exit();
        }


        $user = $this->authService->getUser();



        $userProducts = $this->userProductModel->getUserProductsById($user->getId());


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





    public function addProduct(AddProductRequest $request)
    {


        if (!$this->authService->check()) {
            header("Location: /login");
            exit();
        }


        $errors = $request->validateAddProduct();

        if (empty($errors)) {
            $user = $this->authService->getUser();

            $dto = new AddCartDTO($request->getProductId(), $request->getAmount(), $user);

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
            $user = $this->authService->getUser();

            $dto = new AddCartDTO($request->getProductId(), $request->getAmount(), $user);

            $this->cartService->decreaseProduct($dto);
        }


        header("Location: /catalog");

    }
}