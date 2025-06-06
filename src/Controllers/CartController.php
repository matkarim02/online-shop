<?php

namespace Controllers;
use DTO\AddCartDTO;
use Model\Product;
use Model\UserProduct;
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


        if (!$this->authService->check()) {
            header("Location: /login");
            exit();
        }


        $errors = $this->validateAddProduct($_POST);

        if (empty($errors)) {
            $user = $this->authService->getUser();

            $dto = new AddCartDTO($_POST['product_id'], $_POST['amount'], $user);

            $this->cartService->addProduct($dto);


        }
        header('location: /catalog');

    }


    public function decreaseProduct()
    {


        if(!$this->authService->check()){
            header("Location: /login");
            exit();
        }

        $errors = $this->validateAddProduct($_POST);

        if(empty($errors)) {
            $user = $this->authService->getUser();

            $dto = new AddCartDTO($_POST['product_id'], $_POST['amount'], $user);

            $this->cartService->decreaseProduct($dto);
        }


        header("Location: /catalog");

    }
}