<?php

namespace DTO;
use Model\User;

class OrderCreateDTO
{

    public function __construct(
        private string $contact_name,
        private string $contact_phone,
        private string $comment,
        private string $address,
        private User $user
    ){
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getContactPhone(): string
    {
        return $this->contact_phone;
    }

    public function getContactName(): string
    {
        return $this->contact_name;
    }


}