<?php

namespace Controllers;

use Model\User;

class UserController
{

    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }


    public function getRegistrate(): void
    {
//        session_start();
//        if (isset($_SESSION['userId'])) {
//            header('Location: /catalog');
//        }
        require_once '../Views/registration_form.php';
    }


    private function validateRegistrate(array $data): array
    {

        $errors = [];


        if (isset($data['name'])) {
            $name = $data['name'];

            if (strlen($name) < 2) {
                $errors['name'] = 'Имя должно содержать не менее 2 символов';
            }

        } else {
            $errors['name'] = 'Имя обязательно';
        }


        if (isset($data['email'])) {
            $email = $data['email'];


            if (strlen($email) < 2) {
                $errors['email'] = 'Email должен содержать не менее 2 символов';
            } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Электронная почта должна быть правильным';
            } else {



                $count_email = $this->userModel->getByEmail($email);

                if ($count_email) {
                    $errors['email'] = 'Электронная почта занята';
                }
            }

        } else {
            $errors['email'] = 'Электронная почта обязательна';
        }


        if (isset($data['psw']) && isset($data['psw_repeat'])) {
            $password = $data['psw'];
            $psw_repeat = $data['psw_repeat'];

            if (strlen($password) < 6) {
                $errors['psw'] = 'Пароль должен состоять не менее чем из 6 символов';
            } elseif ($password !== $psw_repeat) {
                $errors['psw'] = 'Пароли не совпадают';
            }
        } elseif (empty($data['psw'])) {
            $errors['psw'] = 'Требуется пароль';
        } elseif (empty($data['psw_repeat'])) {
            $errors['psw_repeat'] = 'Необходимо повторить пароль';
        }


        return $errors;
    }


    public function registrate()
    {

        $errors = $this->validateRegistrate($_POST);

        if (empty($errors)) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['psw'];
            $psw_repeat = $_POST['psw_repeat'];

            $password = password_hash($password, PASSWORD_DEFAULT);



            $this->userModel->insertToUsers($name, $email, $password);


//    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
//    $statement->execute(['email' => $email]);
//    $user = $statement->fetch();
//    print_r($user);

//    $statement = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
//    $users = $statement->fetch();
//    print_r($users);

        }

        require_once '../Views/registration_form.php';
    }








    // -------LOGIN--------

    public function getLogin()
    {
        require_once '../Views/login_form.php';
    }


    private function validateLogin(array $data): array
    {
        $errors = [];

        if (!isset($data['username'])) {
            $errors['username'] = "Username is required";
        }

        if (empty($data['password'])) {
            $errors['password'] = "Password is required";
        }

        return $errors;
    }

    public function login()
    {
        $errors = $this->validateLogin($_POST);

        if (empty($errors)) {

            $username = $_POST['username'];
            $password = $_POST['password'];




            $user = $this->userModel->getByEmail($username);

            $errors = [];

            if ($user === null) {
                $errors['username'] = 'username or password is incorrect';
            } else {
                $passwordDB = $user->getPassword();
                if (password_verify($password, $passwordDB)) {

                    //успешный вход через сессии
                    session_start();
                    $_SESSION['userId'] = $user->getId();

                    //успешный вход через куки
                    //setcookie('user_id', $user['id']);
                    header("Location: /catalog");


                } else {
                    $errors['username'] = 'username or password is incorrect';
                }
            }

        }

        require_once '../Views/login_form.php';
    }


    // --------PROFILE---------

    public function getProfile()
    {
        session_start();

        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];



            $user = $this->userModel->getById($userId);

            require_once '../Views/profile_page.php';
        } else {
            header("Location: /login");
        }
    }






    //-----------LOGOUT-------------
    public function logout(){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        $_SESSION = [];
        session_destroy();
        header("Location: /login");
        exit();
    }








    //----------EDIT-PROFILE---------

    public function getEditProfile()
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        if(isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
            $user = $this->userModel->getById($userId);

            require_once '../Views/edit_profile_page.php';
        } else {
            header("Location: /login_form.php");
            exit();
        }

    }


    private function validateEditProfile(array $data): array
    {

        $errors = [];

        if (isset($data['name'])) {
            $name = $data['name'];

            if (strlen($name) < 2) {
                $errors['name'] = 'Имя должно содержать не менее 2 символов';
            }

        }


        if (isset($data['email'])) {
            $email = $data['email'];

            if (strlen($email) < 2) {
                $errors['email'] = 'Email должен содержать не менее 2 символов';
            } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Электронная почта должна быть правильным';
            } else {


                $user = $this->userModel->getByEmail($email);


                $userId = $_SESSION['userId'];
                if (($user !== null) && ($user->getId() !== $userId) ) {
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
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['userId'])) {
            header("Location: /login");
            exit();
        }


        $errors = $this->validateEditProfile($_POST);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $userId = $_SESSION['userId'];

        $user = $this->userModel->getById($userId);


        if (empty($errors)) {

            if ($user->getName() !== $name) {
                $name = $_POST['name'];
                $this->userModel->updateNameById($userId, $name);
            }
            if ($user->getEmail() !== $email) {
                $email = $_POST['email'];
                $this->userModel->updateEmailById($userId, $email);

            }
            if (isset($_POST['password'])) {
                $psw = $_POST['password'];
                $psw = password_hash($psw, PASSWORD_DEFAULT);
                $this->userModel->updatePasswordById($userId, $psw);

            }

            header('Location: /profile');
            exit();

        }

        require_once '../Views/edit_profile_page.php';
    }


}








