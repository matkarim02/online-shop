<?php

namespace Service;

use DTO\AddCartDTO;
use Model\Product;
use Model\UserProduct;

class CartService
{
    private UserProduct $userProductModel;
    private Product $productModel;
    private AuthService $authService;

    public function __construct()
    {
        $this->userProductModel = new UserProduct();
        $this->productModel = new Product();
        $this->authService = new AuthService();
    }



    public function addProduct(AddCartDTO $data):void
    {
        $user = $this->authService->getUser();

        $user_product = $this->userProductModel->getById($user->getId(), $data->getProductId());

        if ($user_product !== null) {
            $amount = $user_product->getAmount() + $data->getAmount();
            $this->userProductModel->updateAmountById($user->getId(),$data->getProductId(),  $amount);
        } else {
            $this->userProductModel->setUserProduct($user->getId(),$data->getProductId(),  $data->getAmount());
        }

    }



    public function decreaseProduct(AddCartDTO $data):void
    {
        $user = $this->authService->getUser();
        $user_product = $this->userProductModel->getById($user->getId(),$data->getProductId());

        if($user_product !== null){
            if($user_product->getAmount() == 1){
                $this->userProductModel->deleteByUserIdProductId($user->getId(),$data->getProductId());
            }
            $amount = $user_product->getAmount() - $data->getAmount();
            $this->userProductModel->updateAmountById($user->getId(),$data->getProductId(), $amount);
        }

    }

    public function getUserProduct(): array
    {

        $user = $this->authService->getUser();

        if($user === null) {
            return [];
        }

        $userProducts = $this->userProductModel->getUserProductsById($user->getId());

        if(empty($userProducts)){
            return [];
        }

        foreach($userProducts as $userProduct)
        {
            $product_id = $userProduct->getProductId();
            $product = $this->productModel->getProductById($product_id);
            if($product !== null && ($userProduct->getAmount()) !== null) {
                $userProduct->setProduct($product);
                $totalSum = $userProduct->getProduct()->getPrice() * $userProduct->getAmount();
                $userProduct->setTotalSum($totalSum);
            }
        }

        return $userProducts;
    }

    public function getTotal(): int
    {
        $total = 0;
        foreach ($this->getUserProduct() as $userProduct)
        {
            $total += $userProduct->getTotalSum();
        }

        return $total;
    }


}