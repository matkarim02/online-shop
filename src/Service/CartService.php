<?php

namespace Service;

use Model\UserProduct;

class CartService
{
    private UserProduct $userProductModel;

    public function __construct()
    {
        $this->userProductModel = new UserProduct();
    }



    public function addProduct(int $user_id, int $product_id, int $amount):void
    {

        $user_product = $this->userProductModel->getById($user_id, $product_id);

        if ($user_product !== null) {
            $amount = $user_product->getAmount() + $amount;
            $this->userProductModel->updateAmountById($user_id, $product_id, $amount);
        } else {
            $this->userProductModel->setUserProduct($user_id, $product_id, $amount);
        }

    }



    public function decreaseProduct(int $user_id, int $product_id, int $amount):void
    {

        $user_product = $this->userProductModel->getById($user_id, $product_id);

        if($user_product !== null){
            if($user_product->getAmount() == 1){
                $this->userProductModel->deleteByUserIdProductId($user_id, $product_id);
            }
            $amount = $user_product->getAmount() - $amount;
            $this->userProductModel->updateAmountById($user_id, $product_id, $amount);
        }

    }


}