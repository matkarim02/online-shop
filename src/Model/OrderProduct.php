<?php

namespace Model;

class OrderProduct extends Model
{
    public function createOrderProducts(int $orderId, int $productId, int $amount):void
    {
        $stmt = $this->pdo->prepare("INSERT INTO order_products (order_id, product_id, amount) VALUES (:orderId, :productId, :amount)");
        $stmt->execute(['orderId' => $orderId, 'productId' => $productId, 'amount' => $amount]);

    }

    public function getAllByOrderId(int $orderId):array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM order_products WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $orderProducts = $stmt->fetchAll();
        return $orderProducts;
    }
}