<?php

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

if(!isset($_SESSION['userId'])){
    header("Location: /login");
    exit();
}

function validate(array $data): array {

    $errors = [];

    if(empty($data['product_id']) || $data['product_id'] == 0 ){
        $errors['product_id'] = 'Product ID is required';
    } elseif (!is_numeric($data['product_id'])) {
        $errors['product_id'] = 'Product ID must be numeric';
    }

    if(empty($data['amount']) || $data['amount'] == 0 ){
        $errors['amount'] = 'Amount is required';
    } elseif (!is_numeric($data['amount'])) {
        $errors['amount'] = 'Amount must be numeric';
    }

    return $errors;
}

$errors = validate($_POST);

if(empty($errors)){
    $user_id = $_SESSION['userId'];
    $product_id = $_POST['product_id'];
    $amount = $_POST['amount'];

    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
    $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
    $user_product = $stmt->fetch();

    if($user_product){
        $stmt = $pdo->prepare("UPDATE user_products SET amount = :amount WHERE product_id = :product_id");
        $stmt->execute(['amount' => $amount, 'product_id' => $product_id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }
}

require_once './add_product.php';

