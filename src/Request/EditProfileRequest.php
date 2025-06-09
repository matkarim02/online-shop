<?php

namespace Request;

use Model\User;
use Service\AuthService;

class EditProfileRequest
{
    public function __construct(private array $data)
    {
    }

    public function getName(): string
    {
        return $this->data['name'];
    }

    public function getEmail(): string
    {
        return $this->data['email'];
    }

    public function getPassword(): string
    {
        return $this->data['password'];
    }

    public function getPasswordRpt(): string
    {
        return $this->data['password_rpt'];
    }
    public function validateEditProfile(): array
    {

        $errors = [];

        if (isset($this->data['name'])) {
            $name = $this->data['name'];

            if (strlen($name) < 2) {
                $errors['name'] = 'Имя должно содержать не менее 2 символов';
            }

        }


        if (isset($this->data['email'])) {
            $email = $this->data['email'];

            if (strlen($email) < 2) {
                $errors['email'] = 'Email должен содержать не менее 2 символов';
            } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Электронная почта должна быть правильным';
            } else {

                $userModel = new User();
                $user = $userModel->getByEmail($email);

                $authService = new AuthService();
                $userCurrent = $authService->getUser();
                if (($user !== null) && ($user->getId() !== $userCurrent->getId()) ) {
                    $errors['email'] = 'Электронная почта занята';
                }
            }
        }


        if (!empty($this->data['password']) || !empty($this->data['password_rpt'])) {
            if (empty($this->data['password']) || empty($this->data['password_rpt'])) {
                $errors['password_rpt'] = 'Необходимо повторить пароль';
            } elseif (strlen($this->data['password']) < 6) {
                $errors['password'] = 'Пароль должен содержать не менее 6 символов';
            } elseif ($this->data['password'] !== $this->data['password_rpt']) {
                $errors['password'] = 'Пароли не совпадают';
            }
        }

        return $errors;
    }
}