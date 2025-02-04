<?php



$pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

//$pdo->exec("INSERT INTO users (name, email, password) VALUES ('matkarim', 'matkarim@mail.ru', 'make2003')");

$statement = $pdo->query("SELECT * FROM users");

$users = $statement->fetch();
echo '<pre>';
print_r($users);
echo '</pre>';