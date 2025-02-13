<?php

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

if(!isset($_SESSION['userId'])){
    header("Location: /login_form.php");
    exit();
}





function validate(array $data): array
{

    $errors = [];

    if(isset($data['name'])){
        $name = $data['name'];

        if(strlen($name) < 2){
            $errors['name'] = 'Имя должно содержать не менее 2 символов';
        }

    }


    if(isset($data['email'])){
        $email = $data['email'];

        if(strlen($email) < 2){
            $errors['email'] = 'Email должен содержать не менее 2 символов';
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $errors['email'] = 'Электронная почта должна быть правильным';
        } else {

            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
            $stmt= $pdo->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            $userId = $_SESSION['userId'];
            if($user && $user['id'] !== $userId){
                $errors['email'] = 'Электронная почта занята';
            }
        }
    }



    if (!empty($data['password']) || !empty($data['password_rpt'])) {
        if (empty($data['password']) || empty($data['password_rpt'])) {
            $errors['password_rpt'] = 'Необходимо повторить пароль';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'Пароль должен содержать не менее 6 символов';
        } elseif ($data['password'] !== $data['password_rpt']) {
            $errors['password'] = 'Пароли не совпадают';
        }
    }



    return $errors;
}




$errors = validate($_POST);





if(empty($errors)){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $userId = $_SESSION['userId'];

    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->query("SELECT * FROM users WHERE id = $userId");
    $user = $stmt->fetch();

    if($user['name'] !== $name){
        $name = $_POST['name'];
        $stmt = $pdo->prepare("UPDATE users SET name = :name WHERE id = $userId");
        $stmt->execute([':name' => $name]);
    }
    if($user['email'] !== $email){
        $email = $_POST['email'];
        $stmt = $pdo->prepare("UPDATE users SET email = :email WHERE id = $userId");
        $stmt->execute([':email' => $email]);
    }
    if(isset($_POST['password'])){
        $psw = $_POST['password'];
        $psw = password_hash($psw, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = $userId");
        $stmt->execute([':password' => $psw]);
    }



    header('Location: /profile_handle.php');
    exit();

}

require_once './edit_profile_page.php';