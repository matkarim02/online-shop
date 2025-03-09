<?php


namespace Model;
class UserProduct extends Model
{


    public function getUserProductsById(int $userId): array|false
    {

        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :userId");
        $stmt->execute(['userId' => $userId]);
        $userProducts = $stmt->fetchAll();

        return $userProducts;
    }

    public function getById(int $user_id, int $product_id): array|false
    {

        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
        $user_product = $stmt->fetch();

        return $user_product;
    }


    public function updateAmountById(int $user_id, int $product_id, int $amount): void
    {

        $stmt = $this->pdo->prepare("UPDATE user_products SET amount = :amount WHERE product_id = :product_id AND user_id = :user_id;");
        $stmt->execute(['amount' => $amount, 'product_id' => $product_id, 'user_id' => $user_id]);
    }

    public function setUserProduct(int $user_id, int $product_id, int $amount): void
    {

        $stmt = $this->pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }
}