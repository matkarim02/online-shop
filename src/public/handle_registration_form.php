<?php

function validate(array $data): array
{

    $errors = [];


    if(isset($data['name'])){
        $name = $data['name'];

        if(strlen($name) < 2){
            $errors['name'] = 'Имя должно содержать не менее 2 символов';
        }

    } else {
        $errors['name'] = 'Имя обязательно';
    }





    if(isset($data['email'])){
        $email = $data['email'];

        if(strlen($email) < 2){
            $errors['email'] = 'Email должен содержать не менее 2 символов';
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $errors['email'] = 'Электронная почта должна быть правильным';
        } else {
            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

            $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
            $statement->execute([':email' => $email]);
            $count_email = $statement->fetch();

            if($count_email){
                $errors['email'] = 'Электронная почта занята';
            }
        }

    } else {
        $errors['email'] = 'Электронная почта обязательна';
    }





    if(isset($data['psw']) && isset($data['psw_repeat'])){
        $password = $data['psw'];
        $psw_repeat = $data['psw_repeat'];

        if(strlen($password) < 6){
            $errors['psw'] = 'Пароль должен состоять не менее чем из 6 символов';
        }elseif($password !== $psw_repeat){
            $errors['psw'] = 'Пароли не совпадают';
        }
    } elseif (empty($data['psw'])){
        $errors['psw'] = 'Требуется пароль';
    } elseif (empty($data['psw_repeat'])){
        $errors['psw_repeat'] = 'Необходимо повторить пароль';
    }


    return $errors;
}


$errors = validate($_POST);








if(empty($errors)){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $psw_repeat = $_POST['psw_repeat'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $statement = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);


    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $statement->execute(['email' => $email]);
    $user = $statement->fetch();
    print_r($user);

//    $statement = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
//    $users = $statement->fetch();
//    print_r($users);
}





require_once './registration_form.php';
?>



