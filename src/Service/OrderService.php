<?php

namespace Service;

use DTO\OrderCreateDTO;
use Model\Order;
use Model\OrderProduct;
use Model\Product;
use Model\UserProduct;
use Service\Auth\AuthInterface;
use Service\Auth\AuthSessionService;

class OrderService
{
    private Order $orderModel;
    private UserProduct $userProductModel;
    private OrderProduct $orderProductModel;
    private AuthInterface $authService;
    private Product $productModel;

    public function __construct()
    {
        $this->orderModel = new Order();
        $this->userProductModel = new UserProduct();
        $this->orderProductModel = new OrderProduct();
        $this->authService = new AuthSessionService();
        $this->productModel = new Product();
    }

    public function createOrder(OrderCreateDTO $data):void
    {
        $user = $this->authService->getUser();
        $orderId = $this->orderModel->createOrder(
            $data->getContactName(),
            $data->getContactPhone(),
            $data->getAddress(),
            $data->getComment(),
            $user->getId()
        );

        $userProducts = $this->userProductModel->getUserProductsById($user->getId());

        foreach ($userProducts as $userProduct) {
            $productId = $userProduct->getProductId();
            $amount = $userProduct->getAmount();
            $this->orderProductModel->createOrderProducts($orderId, $productId, $amount);
        }

        $this->userProductModel->deleteByUserId($user->getId());
    }

    public function getAll(): array
    {
        $user = $this->authService->getUser();

        $userOrders = $this->orderModel->getAllByUserId($user->getId());

        if($userOrders)

        foreach($userOrders as $userOrder){
            $orderId = $userOrder->getId();
            $orderProducts = $this->orderProductModel->getAllByOrderId($orderId);

            if($orderProducts !== null){
                $sumAll = 0;

                foreach ($orderProducts as $orderProduct){
                    $product = $this->productModel->getProductById($orderProduct->getProductId());
                    $orderProduct->setProduct($product);
                    $productTotal = $orderProduct->getProduct()->getPrice() * $orderProduct->getAmount();
                    $orderProduct->setProductTotal($productTotal);
                    $sumAll += $orderProduct->getProductTotal();
                }

                $userOrder->setSumAll($sumAll);
                $userOrder->setProductDetails($orderProducts);

            }
        }

        return $userOrders;
    }




}