<?php

namespace Model;

class OrderProduct extends Model
{
    public function createOrderProducts(int $orderId, int $productId, int $amount)
    {
        $stmt = $this->pdo->prepare("INSERT INTO order_products (order_id, product_id, amount) VALUES (:orderId, :productId, :amount)");
        $stmt->execute(['orderId' => $orderId, 'productId' => $productId, 'amount' => $amount]);

    }
}