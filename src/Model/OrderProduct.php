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


    protected static function getTableName(): string
    {
        return 'order_products';
    }

    public static function createOrderProducts(int $orderId, int $productId, int $amount):void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("INSERT INTO $tableName (order_id, product_id, amount) VALUES (:orderId, :productId, :amount)");
        $stmt->execute(['orderId' => $orderId, 'productId' => $productId, 'amount' => $amount]);

    }

    public static function getAllByOrderId(int $orderId):array|null
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("SELECT * FROM $tableName WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $orderProducts = $stmt->fetchAll();

        if(empty($orderProducts)){
            return null;
        }

        $newOrderProducts = [];
        foreach ($orderProducts as $orderProduct) {

            $newOrderProducts[] = static::createObj($orderProduct);
        }

        return $newOrderProducts;
    }


    public static function getAllByOrderIdWithProduct(int $orderId):array|null
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("SELECT * FROM $tableName op INNER JOIN products p 
                                                 ON op.product_id = p.id
                                                 WHERE op.order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $orderProducts = $stmt->fetchAll();

        if(empty($orderProducts)){
            return null;
        }

        $newOrderProducts = [];
        foreach ($orderProducts as $orderProduct) {

            $newOrderProducts[] = static::createObjWithProduct($orderProduct);
        }

        return $newOrderProducts;
    }

    public static function createObj(array $data): self|null
    {
        if(!$data){
            return null;
        }

        $obj = new self();
        $obj->id = $data['id'];
        $obj->order_id = $data['order_id'];
        $obj->product_id = $data['product_id'];
        $obj->amount = $data['amount'];

        return $obj;
    }

    public static function createObjWithProduct(array $data):self|null
    {
        if(!$data){
            return null;
        }

        $obj = static::createObj($data);

        $product = Product::createObj($data, $data['product_id']);
        $obj->setProduct($product);

        return $obj;

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