<?php

class Cart
{
    public function getCart()
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        if(!isset($_SESSION['userId'])){
            header('location: login.php');
            exit();
        }



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
            require_once './pages/cart.php';
        } else {
            header('location: /addProduct');
        }
    }








    //---------ADD_PRODUCT----------

    public function getAddProduct()
    {
        require_once './pages/add_product.php';
    }



    private function validateAddProduct(array $data): array
    {

        $errors = [];

        if(!empty($data['product_id'])) {
            $product_id = (int) $data['product_id'];

            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :product_id;");
            $stmt->execute(['product_id' => $product_id]);
            $product = $stmt->fetch();

            if($product === false){
                $errors['product_id'] = "Product does not exist";
            }
        } else {
            $errors['product_id'] = "Product ID is required";
        }



        if(empty($data['amount'])){
            $errors['amount'] = 'Amount is required';
        } elseif (!is_numeric($data['amount'])) {
            $errors['amount'] = 'Amount must be numeric';
        }

        return $errors;
    }




    public function addProduct()
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        if(!isset($_SESSION['userId'])){
            header("Location: /login");
            exit();
        }


        $errors = $this->validateAddProduct($_POST);

        if(empty($errors)){
            $user_id = $_SESSION['userId'];
            $product_id = $_POST['product_id'];
            $amount = $_POST['amount'];

            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
            $stmt = $pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
            $user_product = $stmt->fetch();

            if($user_product){
                $amount = $user_product['amount'] + $amount;
                $stmt = $pdo->prepare("UPDATE user_products SET amount = :amount WHERE product_id = :product_id AND user_id = :user_id;");
                $stmt->execute(['amount' => $amount, 'product_id' => $product_id, 'user_id' => $user_id]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
                $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
            }
        }

        require_once './pages/add_product.php';
    }
}