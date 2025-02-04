<?php


$errors = [];



if(isset($_POST['name'])){
    $name = $_POST['name'];

    if(strlen($name) < 2){
        $errors['name'] = 'Name must be at least 2 characters';
    }
} else {
    $errors['name'] = 'Name is required';
}





if(isset($_POST['email'])){
    $email = $_POST['email'];

    if(strlen($email) < 2){
        $errors['email'] = 'Email must be at least 2 characters';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $errors['email'] = 'Email must be a valid email address';
    } else {
        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

        $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->execute(['email' => $email]);
        $count_email = $statement->fetch();

        if($count_email){
            $errors['email'] = 'Email is already in use';
        }
    }

} else {
    $errors['email'] = 'Email is required';
}





if(isset($_POST['psw']) && isset($_POST['psw_repeat'])){
    $password = $_POST['psw'];
    $psw_repeat = $_POST['psw_repeat'];

    if(strlen($password) < 6){
        $errors['psw'] = 'Password must be at least 6 characters';
    }elseif($password !== $psw_repeat){
        $errors['psw'] = 'Passwords do not match';
    }
} elseif (empty($_POST['psw'])){
    $errors['psw'] = 'Password is required';
} elseif (empty($_POST['psw_repeat'])){
    $errors['psw_repeat'] = 'Password repeat is required';
}










if(empty($errors)){

//    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

    $password = password_hash($password, PASSWORD_DEFAULT);
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





require_once './registration_form.php'
?>



