<?php

namespace Model;

class OrderProduct extends Model
{

    private int $id;
    private int $order_id;
    private int $product_id;
    private int $amount;

    private string $name;
    private string $description;
    private float $price;
    private string $image_url;
    private float $product_total;


    public function createOrderProducts(int $orderId, int $productId, int $amount):void
    {
        $stmt = $this->pdo->prepare("INSERT INTO order_products (order_id, product_id, amount) VALUES (:orderId, :productId, :amount)");
        $stmt->execute(['orderId' => $orderId, 'productId' => $productId, 'amount' => $amount]);

    }

    public function getAllByOrderId(int $orderId):array|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM order_products WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $orderProducts = $stmt->fetchAll();

        if($orderProducts === false){
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
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