<?php

$username = $_POST['username'];
$password = $_POST['password'];


$pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
$stmt->execute(['email' => $username]);
$user = $stmt->fetch();

$errors = [];

if($user === false){
    $errors['username'] = 'username or password is incorrect';
} else {
    $passwordDB = $user['password'];
    if(password_verify($password, $passwordDB)){
        setcookie('user_id', $user['id']);
        header("Location: /catalog.php");
    } else {
        $errors['username'] = 'username or password is incorrect';
    }
}

require_once './login_form.php';