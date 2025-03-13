<?php

namespace Model;

class Order extends Model
{
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
}
