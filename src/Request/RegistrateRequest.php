<?php

namespace Request;

use Model\User;

class RegistrateRequest
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
        return $this->data['psw'];
    }

    public function validateRegistrate(): array
    {

        $errors = [];


        if (isset($this->data['name'])) {
            $name = $this->data['name'];

            if (strlen($name) < 2) {
                $errors['name'] = 'Имя должно содержать не менее 2 символов';
            }

        } else {
            $errors['name'] = 'Имя обязательно';
        }


        if (isset($this->data['email'])) {
            $email = $this->data['email'];


            if (strlen($email) < 2) {
                $errors['email'] = 'Email должен содержать не менее 2 символов';
            } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Электронная почта должна быть правильным';
            } else {


                $userModel = new User();
                $count_email = $userModel->getByEmail($email);

                if ($count_email) {
                    $errors['email'] = 'Электронная почта занята';
                }
            }

        } else {
            $errors['email'] = 'Электронная почта обязательна';
        }


        if (isset($this->data['psw']) && isset($this->data['psw_repeat'])) {
            $password = $this->data['psw'];
            $psw_repeat = $this->data['psw_repeat'];

            if (strlen($password) < 6) {
                $errors['psw'] = 'Пароль должен состоять не менее чем из 6 символов';
            } elseif ($password !== $psw_repeat) {
                $errors['psw'] = 'Пароли не совпадают';
            }
        } elseif (empty($this->data['psw'])) {
            $errors['psw'] = 'Требуется пароль';
        } elseif (empty($this->data['psw_repeat'])) {
            $errors['psw_repeat'] = 'Необходимо повторить пароль';
        }


        return $errors;
    }

}