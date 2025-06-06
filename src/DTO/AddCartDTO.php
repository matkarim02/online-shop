<?php

namespace DTO;

use Model\User;

class AddCartDTO
{
    public function __construct(private int $product_id, private int $amount, private User $user)
    {
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getUser(): User
    {
        return $this->user;
    }



}