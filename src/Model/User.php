<?php


namespace Model;
class User extends Model
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;


    protected function getTableName(): string
    {
        return 'users';
    }

    public function getByEmail(string $email): self|null
    {

        $stmt = $this->pdo->prepare("SELECT * FROM {$this->getTableName()} WHERE email = :email");
        $stmt->execute([':email' => $email]);

        $result = $stmt->fetch();

        if ($result === false) {
            return null;
        }

        $obj = new self();
        $obj->id = $result['id'];
        $obj->name = $result['name'];
        $obj->email = $result['email'];
        $obj->password = $result['password'];


        return $obj;
    }


    public function getById(int $userId): self|null
    {

        $stmt = $this->pdo->query("SELECT * FROM {$this->getTableName()} WHERE id = $userId");
        $user = $stmt->fetch();

        if ($user === false) {
            return null;
        }

        $obj = new self();
        $obj->id = $user['id'];
        $obj->name = $user['name'];
        $obj->email = $user['email'];
        $obj->password = $user['password'];

        return $obj;
    }

    public function insertToUsers(string $name, string $email, string $password): void
    {

        $stmt = $this->pdo->prepare("INSERT INTO {$this->getTableName()} (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }

    public function updateNameById(int $userId, string $name): void
    {

        $stmt = $this->pdo->prepare("UPDATE {$this->getTableName()} SET name = :name WHERE id = $userId");
        $stmt->execute([':name' => $name]);
    }

    public function updateEmailById(int $userId, string $email): void
    {

        $stmt = $this->pdo->prepare("UPDATE {$this->getTableName()} SET email = :email WHERE id = $userId");
        $stmt->execute([':email' => $email]);
    }

    public function updatePasswordById(int $userId, string $psw): void
    {

        $stmt = $this->pdo->prepare("UPDATE users SET password = :password WHERE id = $userId");
        $stmt->execute([':password' => $psw]);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }


}