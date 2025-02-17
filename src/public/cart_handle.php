<?php

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

if(!isset($_SESSION['userId'])){
    header('location: login.php');
    exit();
}

//function validate(array $data): array{
//    $errors = [];
//
//    if(!empty($data['amount'])){
//        $amount = $data['amount'];
//
//        if($amount <= 0){
//            $errors['amount'] = 'Amount must be greater than 0';
//        }
//    }
//
//    return $errors;
//}
//
//
//$errors = validate($_POST);




$userId = $_SESSION['userId'];

$pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
$stmt = $pdo->prepare("SELECT * FROM user_products WHERE user_id = :userId");
$stmt->execute(['userId' => $userId]);
$userProducts = $stmt->fetchAll();


if ($userProducts) {
    $products = [];
    foreach ($userProducts as $userProduct) {
        $productId = $userProduct['product_id'];
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :productId");
        $stmt->execute(['productId' => $productId]);
        $product = $stmt->fetch();

        if ($product) {
            $products[] = array_merge($userProduct, $product);
        }
    }
    require_once './cart.php';
} else {
    header('location: addProduct');
}






