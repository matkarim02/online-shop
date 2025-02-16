<?php

function validate(array $data): array
{
    $errors = [];

    if(!isset($data['username'])){
        $errors['username'] = "Username is required";
    }

    if(!isset($data['password'])){
        $errors['password'] = "Password is required";
    }

    return $errors;
}

$errors = validate($_POST);




if(empty($errors)){

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

            //успешный вход через сессии
            session_start();
            $_SESSION['userId'] = $user['id'];

            //успешный вход через куки
            //setcookie('user_id', $user['id']);
            header("Location: /catalog");


        } else {
            $errors['username'] = 'username or password is incorrect';
        }
    }

}






require_once './login_form.php';