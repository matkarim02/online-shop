<?php

class Product
{
    public function getProduct(): array|false
    {
        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
        $stmt = $pdo->query('SELECT * FROM products');
        $products = $stmt->fetchAll();

        return $products;
    }

    public function getProductById(int $user_productId): array|false
    {
        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :productId");
        $stmt->execute(['productId' => $user_productId]);
        $product = $stmt->fetch();
        return $product;
    }


}