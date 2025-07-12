<?php


namespace Model;
class Product extends Model
{

    private int $id;
    private string $name;
    private string $description;
    private float $price;
    private string $image_url;

    private UserProduct $user_product;

    private array $reviews = [];

    private float $avg_rating = 0.0;


    protected static function getTableName(): string
    {
        return 'products';
    }

    public static function getAllProduct(): array|null
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->query("SELECT * FROM $tableName");
        $products = $stmt->fetchAll();

        if(empty($products)){
            return null;
        }

        $newProducts = [];
        foreach ($products as $product){
            $newProducts[] = static::createObj($product);
        }
        return $newProducts;
    }


    public static function getProductById(int $user_productId): self|null
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("SELECT * FROM $tableName WHERE id = :productId");
        $stmt->execute(['productId' => $user_productId]);
        $product = $stmt->fetch();

        if($product === false){
            return null;
        }

        return static::createObj($product);
    }


    public static function createObj(array $data, int $id = null):self|null
    {
        if(!$data){
            return null;
        }

        $obj = new self();

        if($id !== null){
            $obj->id = $id;
        } else {
            $obj->id = $data['id'];
        }

        $obj->name = $data['name'];
        $obj->description = $data['description'];
        $obj->price = $data['price'];
        $obj->image_url = $data['image_url'];


        return $obj;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserProduct(): UserProduct
    {
        return $this->user_product;
    }

    public function setUserProduct(UserProduct $user_product): void
    {
        $this->user_product = $user_product;
    }

    public function getReviews(): array
    {
        return $this->reviews;
    }

    public function setReviews(array $reviews): void
    {
        $this->reviews = $reviews;
    }

    public function getAvgRating(): float
    {
        return $this->avg_rating;
    }

    public function setAvgRating(float $avg_rating): void
    {
        $this->avg_rating = $avg_rating;
    }










}