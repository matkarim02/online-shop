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
    private AuthInterface $authService;
    private CartService $cartService;

    public function __construct()
    {
        $this->authService = new AuthSessionService();
        $this->cartService = new CartService();
    }

    public function createOrder(OrderCreateDTO $data):void
    {

        $sumAll = $this->cartService->getTotal();

        if($sumAll < 12000) {
            throw new \Exception('Для оформления заказа сумма корзины должна быть больше 12000');
        }

        $user = $this->authService->getUser();
        $userProducts = UserProduct::getUserProductsById($user->getId());
        $orderId = Order::createOrder(
            $data->getContactName(),
            $data->getContactPhone(),
            $data->getAddress(),
            $data->getComment(),
            $user->getId()
        );

        foreach ($userProducts as $userProduct) {
            $productId = $userProduct->getProductId();
            $amount = $userProduct->getAmount();
            OrderProduct::createOrderProducts($orderId, $productId, $amount);
        }

        UserProduct::deleteByUserId($user->getId());
    }

    public function getAll(): array
    {
        $user = $this->authService->getUser();

        $userOrders = Order::getAllByUserId($user->getId());

        if($userOrders){
            foreach($userOrders as $userOrder){
                $orderId = $userOrder->getId();
                $orderProducts = OrderProduct::getAllByOrderIdWithProduct($orderId);

                if($orderProducts !== null){
                    $sumAll = 0;

                    foreach ($orderProducts as $orderProduct){
                        $productTotal = $orderProduct->getProduct()->getPrice() * $orderProduct->getAmount();
                        $orderProduct->setProductTotal($productTotal);
                        $sumAll += $orderProduct->getProductTotal();
                    }

                    $userOrder->setSumAll($sumAll);
                    $userOrder->setProductDetails($orderProducts);

                }
            }
        }



        return $userOrders;
    }




}