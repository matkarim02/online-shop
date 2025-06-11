<?php

namespace DTO;


class OrderCreateDTO
{

    public function __construct(
        private string $contact_name,
        private string $contact_phone,
        private string $comment,
        private string $address,
    ){
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