<?php

require_once "../Model/Model.php";

class Product extends Model
{


    public function getProduct(): array|false
    {

        $stmt = $this->pdo->query('SELECT * FROM products');
        $products = $stmt->fetchAll();

        return $products;
    }

    public function getProductById(int $user_productId): array|false
    {

        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :productId");
        $stmt->execute(['productId' => $user_productId]);
        $product = $stmt->fetch();
        return $product;
    }


}