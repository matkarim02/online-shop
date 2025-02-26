<?php

require_once "../Model/Model.php";

class User extends Model
{


    public function getByEmail(string $email): array|false
    {

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        $result = $stmt->fetch();

        return $result;
    }


    public function getById(int $userId): array|false
    {

        $stmt = $this->pdo->query("SELECT * FROM users WHERE id = $userId");
        $user = $stmt->fetch();

        return $user;
    }

    public function insertToUsers(string $name, string $email, string $password): void
    {

        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }

    public function updateNameById(int $userId, string $name): void
    {

        $stmt = $this->pdo->prepare("UPDATE users SET name = :name WHERE id = $userId");
        $stmt->execute([':name' => $name]);
    }

    public function updateEmailById(int $userId, string $email): void
    {

        $stmt = $this->pdo->prepare("UPDATE users SET email = :email WHERE id = $userId");
        $stmt->execute([':email' => $email]);
    }

    public function updatePasswordById(int $userId, string $psw): void
    {

        $stmt = $this->pdo->prepare("UPDATE users SET password = :password WHERE id = $userId");
        $stmt->execute([':password' => $psw]);
    }
}