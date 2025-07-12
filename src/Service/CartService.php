<?php

namespace Service;

use DTO\AddCartDTO;
use Model\UserProduct;
use Service\Auth\AuthInterface;
use Service\Auth\AuthSessionService;

class CartService
{
    private AuthInterface $authService;

    public function __construct()
    {
        $this->authService = new AuthSessionService();
    }



    public function addProduct(AddCartDTO $data):void
    {
        $user = $this->authService->getUser();

        $user_product = UserProduct::getById($user->getId(), $data->getProductId());

        if ($user_product !== null) {
            $amount = $user_product->getAmount() + $data->getAmount();
            UserProduct::updateAmountById($user->getId(),$data->getProductId(),  $amount);
        } else {
            UserProduct::setUserProduct($user->getId(),$data->getProductId(),  $data->getAmount());
        }

    }



    public function decreaseProduct(AddCartDTO $data):void
    {
        $user = $this->authService->getUser();
        $user_product = UserProduct::getById($user->getId(),$data->getProductId());

        if($user_product !== null){
            if($user_product->getAmount() == 1){
                UserProduct::deleteByUserIdProductId($user->getId(),$data->getProductId());
            }
            $amount = $user_product->getAmount() - $data->getAmount();
            UserProduct::updateAmountById($user->getId(),$data->getProductId(), $amount);
        }

    }

    public function getUserProduct(): array
    {

        $user = $this->authService->getUser();

        if($user === null) {
            return [];
        }

        $userProducts = UserProduct::getAllByIdWithProducts($user->getId());

        if(empty($userProducts)){
            return [];
        }

        foreach($userProducts as $userProduct)
        {
            if($userProduct->getAmount() !== null) {
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