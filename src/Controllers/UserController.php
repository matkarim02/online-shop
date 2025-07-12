<?php

namespace Controllers;


use DTO\AuthUserDTO;
use Model\User;
use Request\EditProfileRequest;
use Request\LoginRequest;
use Request\RegistrateRequest;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }



    public function getRegistrate(): void
    {
//        session_start();
//        if (isset($_SESSION['userId'])) {
//            header('Location: /catalog');
//        }
        require_once '../Views/registration_form.php';
    }





    public function registrate(RegistrateRequest $request)
    {

        $errors = $request->validateRegistrate();

        if (empty($errors)) {



            $password = password_hash($request->getPassword(), PASSWORD_DEFAULT);



            User::insertToUsers($request->getName(), $request->getEmail(), $password);


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




    public function login(LoginRequest $request)
    {
        $data = $_POST;
        $errors = $request->validateLogin();


        if (empty($errors)) {

            $errors = [];

            $dto = new AuthUserDTO($request->getEmail(), $request->getPassword());

            $result_auth = $this->authService->auth($dto);

            if ($result_auth) {
                header("Location: /catalog");
                exit();
            } else {
                $errors['username'] = 'username or password is incorrect';
            }

        }

        require_once '../Views/login_form.php';
    }


    // --------PROFILE---------

    public function getProfile()
    {
        session_start();

        if ($this->authService->check()) {


            $user = $this->authService->getUser();

            require_once '../Views/profile_page.php';
        } else {
            header("Location: /login");
        }
    }






    //-----------LOGOUT-------------
    public function logout()
    {
        $this->authService->logout();
        header("Location: /login");
        exit();
    }








    //----------EDIT-PROFILE---------

    public function getEditProfile()
    {


        if($this->authService->check()) {

            $user = $this->authService->getUser();

            require_once '../Views/edit_profile_page.php';
        } else {
            header("Location: /login_form.php");
            exit();
        }

    }





    public function editProfile(EditProfileRequest $request)
    {

        if (!$this->authService->check()) {
            header("Location: /login");
            exit();
        }


        $errors = $request->validateEditProfile();



        $user = $this->authService->getUser();


        if (empty($errors)) {

            if ($user->getName() !== $request->getName()) {
                User::updateNameById($user->getId(), $request->getName());
            }
            if ($user->getEmail() !== $request->getEmail()) {

                User::updateEmailById($user->getId(), $request->getEmail());

            }
            if (!empty($request->getPassword())) {
                $psw = $request->getPassword();
                $psw = password_hash($psw, PASSWORD_DEFAULT);
                User::updatePasswordById($user->getId(), $psw);

            }

            header('Location: /profile');
            exit();

        }

        require_once '../Views/edit_profile_page.php';
    }


}








