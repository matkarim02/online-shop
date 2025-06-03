<?php

namespace Model;

class OrderProduct extends Model
{

    private int $id;
    private int $order_id;
    private int $product_id;
    private int $amount;


    private Product $product;
    private float $product_total;


    protected function getTableName(): string
    {
        return 'order_products';
    }

    public function createOrderProducts(int $orderId, int $productId, int $amount):void
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->getTableName()} (order_id, product_id, amount) VALUES (:orderId, :productId, :amount)");
        $stmt->execute(['orderId' => $orderId, 'productId' => $productId, 'amount' => $amount]);

    }

    public function getAllByOrderId(int $orderId):array|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->getTableName()} WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $orderProducts = $stmt->fetchAll();

        if(empty($orderProducts)){
            return null;
        }

        $newOrderProducts = [];
        foreach ($orderProducts as $orderProduct) {
            $obj = new self();
            $obj->id = $orderProduct['id'];
            $obj->order_id = $orderProduct['order_id'];
            $obj->product_id = $orderProduct['product_id'];
            $obj->amount = $orderProduct['amount'];
            $newOrderProducts[] = $obj;
        }

        return $newOrderProducts;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }



    public function getProductTotal(): float
    {
        return $this->product_total;
    }

    public function setProductTotal(float $product_total): void
    {
        $this->product_total = $product_total;
    }






}