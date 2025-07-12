<?php


namespace Model;
class UserProduct extends Model
{

    private int $id;
    private int $user_id;
    private int $product_id;
    private float $amount;

    private Product $product;

    private int $totalSum;


    protected static function getTableName(): string
    {
        return 'user_products';
    }

    public static function getUserProductsById(int $user_id): array|null
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("SELECT * FROM $tableName WHERE user_id = :userId");
        $stmt->execute(['userId' => $user_id]);
        $userProducts = $stmt->fetchAll();

        if(empty($userProducts)){
            return null;
        }
        $newUserProducts = [];

        foreach ($userProducts as $userProduct) {
            $newUserProducts[] = static::createObj($userProduct);
        }

        return $newUserProducts;
    }



    public static function getAllByIdWithProducts(int $user_id):array|null
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("SELECT * FROM $tableName up INNER JOIN products p ON up.product_id = p.id WHERE up.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $userProducts = $stmt->fetchAll();
//        echo '<pre>';
//        print_r($userProducts);
//        echo '</pre>';
//        exit();

        if(empty($userProducts)){
            return null;
        }

        $newUserProducts = [];

        foreach ($userProducts as $userProduct) {
            $newUserProducts[] = static::createObjWidthProduct($userProduct);
        }

        return $newUserProducts;
    }




    public static function getById(int $user_id, int $product_id): self|null
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("SELECT * FROM $tableName WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
        $user_product = $stmt->fetch();

        if($user_product === false){
            return null;
        }

        return static::createObj($user_product);
    }

    public static function createObj(array $data):self|null
    {

        if(!$data){
            return null;
        }

        $obj = new self();
        $obj->id = $data['id'];
        $obj->user_id = $data['user_id'];
        $obj->product_id = $data['product_id'];
        $obj->amount = $data['amount'];


        return $obj;
    }

    public static function createObjWidthProduct(array $data):self|null
    {

        if(!$data){
            return null;
        }

        $obj = static::createObj($data);

        $product = Product::createObj($data, $data['product_id']);
        $obj->setProduct($product);

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

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getTotalSum(): int
    {
        return $this->totalSum;
    }

    public function setTotalSum(int $totalSum): void
    {
        $this->totalSum = $totalSum;
    }







    public static function updateAmountById(int $user_id, int $product_id, int $amount): void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("UPDATE $tableName SET amount = :amount WHERE product_id = :product_id AND user_id = :user_id;");
        $stmt->execute(['amount' => $amount, 'product_id' => $product_id, 'user_id' => $user_id]);
    }




    public static function setUserProduct(int $user_id, int $product_id, int $amount): void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("INSERT INTO $tableName (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }



    public static function deleteByUserId(int $user_id): void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("DELETE FROM $tableName WHERE user_id = :userId");
        $stmt->execute(['userId'=>$user_id]);
    }


    public static function deleteByUserIdProductId(int $user_id, int $product_id): void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("DELETE FROM $tableName WHERE user_id = :userId AND product_id = :product_id");
        $stmt->execute(['userId'=>$user_id, 'product_id'=>$product_id]);
    }
}