<?php

namespace Request;

class HandleCheckoutRequest
{
    public function __construct(private array $data)
    {

    }

    public function getName(): string
    {
        return $this->data['name'];
    }

    public function getPhone(): string
    {
        return $this->data['phone'];
    }

    public function getComment(): string
    {
        return $this->data['comments'];
    }

    public function getAddress(): string
    {
        return $this->data['address'];
    }

    public function validateCheckoutForm(): array
    {
        $errors = [];

        if(!empty($this->data['name'])) {
            $contactName = $this->data['name'];

            if(strlen($contactName) < 2) {
                $errors['name'] = "Имя должно содержать не менее 2 символов";
            }
        } else {
            $errors['name'] = "Заполните поле";
        }

        if(!empty($this->data['phone'])) {
            $contactPhone = $this->data['phone'];

//            if(!is_numeric($contactPhone)) {
//                $errors['phone'] = "Поле должно содержать номер";
//            }
        } else {
            $errors['phone'] = "Заполните поле";
        }

        return $errors;
    }

}