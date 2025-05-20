<?php


namespace Model;
class UserProduct extends Model
{

    private int $id;
    private int $user_id;
    private int $product_id;
    private float $amount;

    private Product $product;

    public function getUserProductsById(int $user_id): array|null
    {

        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :userId");
        $stmt->execute(['userId' => $user_id]);
        $userProducts = $stmt->fetchAll();

        if(empty($userProducts)){
            return null;
        }
        $newUserProducts = [];

        foreach ($userProducts as $userProduct) {
            $newUserProducts[] = $this->createObj($userProduct);
        }

        return $newUserProducts;
    }

    public function getById(int $user_id, int $product_id): self|null
    {

        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
        $user_product = $stmt->fetch();

        if($user_product === false){
            return null;
        }

        return $this->createObj($user_product);
    }

    public function createObj(array $data):self
    {
        $obj = new self();
        $obj->id = $data['id'];
        $obj->user_id = $data['user_id'];
        $obj->product_id = $data['product_id'];
        $obj->amount = $data['amount'];

        return $obj;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getAmount(): float
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

    public function deleteByUserId(int $user_id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id = :userId");
        $stmt->execute(['userId'=>$user_id]);
    }
}