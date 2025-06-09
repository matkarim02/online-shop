<?php

namespace Request;

class LoginRequest
{
    public function __construct(private array $data)
    {
    }

    public function getEmail(): string
    {
        return $this->data['username'];
    }

    public function getPassword(): string
    {
        return $this->data['password'];
    }

    public function validateLogin(): array
    {
        $errors = [];

        if (!isset($this->data['username'])) {
            $errors['username'] = "Username is required";
        }

        if (empty($this->data['password'])) {
            $errors['password'] = "Password is required";
        }

        return $errors;
    }
}