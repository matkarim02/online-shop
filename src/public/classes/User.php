<?php



class User
{
    public function getRegistrate()
    {
//        session_start();
//        if (isset($_SESSION['userId'])) {
//            header('Location: /catalog');
//        }
        require_once './pages/registration_form.php';
    }



    private function validateRegistrate(array $data): array
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



    public function registrate() {

        $errors = $this->validateRegistrate($_POST);

        if(empty($errors)){

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['psw'];
            $psw_repeat = $_POST['psw_repeat'];

            $password = password_hash($password, PASSWORD_DEFAULT);

            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
            $statement = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);


//    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
//    $statement->execute(['email' => $email]);
//    $user = $statement->fetch();
//    print_r($user);

//    $statement = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
//    $users = $statement->fetch();
//    print_r($users);

        }

        require_once './pages/registration_form.php';
    }





    // -------LOGIN--------

    public function getLogin()
    {
        require_once './pages/login_form.php';
    }


    private function validateLogin(array $data): array
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

    public function login()
    {
        $errors = $this->validateLogin($_POST);

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

        require_once './pages/login_form.php';
    }



    // --------PROFILE---------

    public function getProfile()
    {
        session_start();

        if(isset($_SESSION['userId'])){
            $userId = $_SESSION['userId'];

            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

            $stmt = $pdo->query("SELECT * FROM users WHERE id = $userId");
            $user = $stmt->fetch();

            require_once './pages/profile_page.php';
        } else {
            header("Location: /login");
        }
    }





    //----------EDIT-PROFILE---------

    public function getEditProfile()
    {
        require_once './pages/edit_profile_page.php';
    }



    private function validateEditProfile(array $data): array
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


    public function editProfile()
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        if(!isset($_SESSION['userId'])){
            header("Location: /login");
            exit();
        }



        $errors = $this->validateEditProfile($_POST);


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
            if(isset($_POST['password'])) {
                $psw = $_POST['password'];
                $psw = password_hash($psw, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = $userId");
                $stmt->execute([':password' => $psw]);
            }

            header('Location: /profile');
            exit();

        }

        require_once './pages/edit_profile_page.php';
    }





}








