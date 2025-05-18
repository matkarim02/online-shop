<?php

namespace Model;

class Order extends Model
{
    private int $id;
    private string $contact_name;
    private string $contact_phone;
    private string $comment;
    private int $user_id;
    private string $address;

    private float $sum_all;

    private array $product_details = [];


    public function createOrder(string $contactName, string $contactPhone, string $address, string $comments, int $user_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO orders (contact_name, contact_phone, address, comment, user_id) 
                                            VALUES (:contact_name, :contact_phone, :address, :comment, :user_id) RETURNING id"
        );
        $stmt->execute([
            'contact_name' => $contactName,
            'contact_phone' => $contactPhone,
            'address' => $address,
            'comment' => $comments,
            'user_id' => $user_id
        ]);

        $data = $stmt->fetch();
        return $data['id'];

    }

    public function getAllByUserId(int $user_id): array|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        $userOrders = $stmt->fetchAll();

        if ($userOrders === false) {
            return null;
        }
        $newUserOrders = [];

        foreach ($userOrders as $userOrder) {
            $newUserOrders[] = $this->createObj($userOrder);
        }
        return $newUserOrders;
    }

    public function createObj(array $data): self
    {
        $obj = new self();
        $obj->id = $data['id'];
        $obj->contact_name = $data['contact_name'];
        $obj->contact_phone = $data['contact_phone'];
        $obj->comment = $data['comment'];
        $obj->user_id = $data['user_id'];
        $obj->address = $data['address'];

        return $obj;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContactName(): string
    {
        return $this->contact_name;
    }

    public function getContactPhone(): string
    {
        return $this->contact_phone;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getProductDetails(): array
    {
        return $this->product_details;
    }

    public function setProductDetails(array $product_details): void
    {
        $this->product_details = $product_details;
    }

    public function getSumAll(): float
    {
        return $this->sum_all;
    }

    public function setSumAll(float $sum_all): void
    {
        $this->sum_all = $sum_all;
    }



}
