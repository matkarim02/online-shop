<?php


namespace Model;
class User extends Model
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;


    protected static function getTableName(): string
    {
        return 'users';
    }

    public static function getByEmail(string $email): self|null
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("SELECT * FROM $tableName WHERE email = :email");
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


    public static function getById(int $userId): self|null
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->query("SELECT * FROM $tableName WHERE id = $userId");
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

    public static function insertToUsers(string $name, string $email, string $password): void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("INSERT INTO $tableName (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }

    public static function updateNameById(int $userId, string $name): void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("UPDATE $tableName SET name = :name WHERE id = $userId");
        $stmt->execute([':name' => $name]);
    }

    public static function updateEmailById(int $userId, string $email): void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("UPDATE $tableName SET email = :email WHERE id = $userId");
        $stmt->execute([':email' => $email]);
    }

    public static function updatePasswordById(int $userId, string $psw): void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("UPDATE $tableName SET password = :password WHERE id = $userId");
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