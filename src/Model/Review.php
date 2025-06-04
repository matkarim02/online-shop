<?php

namespace Model;

class Review extends Model
{
    private int $id;
    private int $product_id;
    private string $author;
    private string $text;
    private string $created_at;
    private int $rating;
    private ?float $avgRating = null;




    protected function getTableName(): string
    {
       return 'reviews';
    }

    public function getProductReviewsByProductId(int $product_id): array|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->getTableName()} WHERE product_id = :product_id");
        $stmt->execute(['product_id' => $product_id]);
        $products = $stmt->fetchall();

        if(empty($products)){
            return null;
        }

        $newProducts = [];

        foreach ($products as $product)
        {
            $newProducts[] = $this->createObj($product);
        }
        return  $newProducts;


    }

    public function createObj(array $data):self
    {
        $obj = new self();
        $obj->id = $data['id'];
        $obj->product_id = $data['product_id'];
        $obj->author = $data['author'];
        $obj->text = $data['text'];
        $obj->created_at = $data['created_at'];
        $obj->rating = $data['rating'];

        return $obj;
    }

    public function getAvgRatingByProductId(int $product_id): ?float
    {
        $stmt = $this->pdo->prepare("SELECT AVG(rating) AS average_rating FROM reviews WHERE product_id = :product_id");
        $stmt->execute(['product_id' => $product_id]);
        $result = $stmt->fetch();

        if ($result === false) {
            return null;
        }

        return (float) $result['average_rating'];
    }


    public function setProductReview(int $product_id, string $author, string $text, int $rating):void
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->getTableName()} (product_id, author, text, rating) VALUES (:product_id, :author, :text, :rating)");
        $stmt->execute(['product_id' => $product_id, 'author' => $author, 'text' => $text, 'rating' => $rating]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }








}