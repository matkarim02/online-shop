<?php

namespace Service;

use DTO\AddCartDTO;
use Model\UserProduct;

class CartService
{
    private UserProduct $userProductModel;

    public function __construct()
    {
        $this->userProductModel = new UserProduct();
    }



    public function addProduct(AddCartDTO $data):void
    {

        $user_product = $this->userProductModel->getById($data->getUser()->getId(),$data->getProductId());

        if ($user_product !== null) {
            $amount = $user_product->getAmount() + $data->getAmount();
            $this->userProductModel->updateAmountById($data->getUser()->getId(),$data->getProductId(),  $amount);
        } else {
            $this->userProductModel->setUserProduct($data->getUser()->getId(),$data->getProductId(),  $data->getAmount());
        }

    }



    public function decreaseProduct(AddCartDTO $data):void
    {

        $user_product = $this->userProductModel->getById($data->getUser()->getId(),$data->getProductId());

        if($user_product !== null){
            if($user_product->getAmount() == 1){
                $this->userProductModel->deleteByUserIdProductId($data->getUser()->getId(),$data->getProductId());
            }
            $amount = $user_product->getAmount() - $data->getAmount();
            $this->userProductModel->updateAmountById($data->getUser()->getId(),$data->getProductId(), $amount);
        }

    }


}