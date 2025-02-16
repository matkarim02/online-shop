<?php

session_start();

if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];

    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

    $stmt = $pdo->query("SELECT * FROM users WHERE id = $userId");
    $user = $stmt->fetch();

    require_once './profile_page.php';
} else {
    header("Location: /login");
}