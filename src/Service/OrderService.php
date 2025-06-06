<?php

namespace Service;

use DTO\OrderCreateDTO;
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

    public function createOrder(OrderCreateDTO $data):void
    {
        $orderId = $this->orderModel->createOrder(
            $data->getContactName(),
            $data->getContactPhone(),
            $data->getAddress(),
            $data->getComment(),
            $data->getUser()->getId()
        );

        $userProducts = $this->userProductModel->getUserProductsById($data->getUser()->getId());

        foreach ($userProducts as $userProduct) {
            $productId = $userProduct->getProductId();
            $amount = $userProduct->getAmount();
            $this->orderProductModel->createOrderProducts($orderId, $productId, $amount);
        }

        $this->userProductModel->deleteByUserId($data->getUser()->getId());
    }
}