<?php

namespace Service;

use Model\Order;
use Model\OrderProduct;
use Model\UserProduct;

class OrderService
{
    private Order $orderModel;
    private UserProduct $userProductModel;
    private OrderProduct $orderProductModel;

    public function __construct()
    {
        $this->orderModel = new Order();
        $this->userProductModel = new UserProduct();
        $this->orderProductModel = new OrderProduct();
    }

    public function createOrder($contactName, $contactPhone, $address, $comments, $user_id):void
    {
        $orderId = $this->orderModel->createOrder($contactName, $contactPhone, $address, $comments, $user_id);

        $userProducts = $this->userProductModel->getUserProductsById($user_id);

        foreach ($userProducts as $userProduct) {
            $productId = $userProduct->getProductId();
            $amount = $userProduct->getAmount();
            $this->orderProductModel->createOrderProducts($orderId, $productId, $amount);
        }

        $this->userProductModel->deleteByUserId($user_id);
    }
}