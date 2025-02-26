<?php

class Product
{
    private PDO $pdo;

    public function __construct(){
        $this->pdo = new Pdo('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    }

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