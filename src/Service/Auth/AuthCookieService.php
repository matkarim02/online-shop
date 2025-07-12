<?php

namespace Service\Auth;

use DTO\AuthUserDTO;
use Model\User;

class AuthCookieService implements AuthInterface
{
    protected User $userModel;
    public function __construct()
    {
        $this->userModel = new User;
    }
    public function check():bool
    {

        return isset($_COOKIE['userId']);
    }

    public function getUser(): ?User
    {

        if($this->check()) {

            $userId = $_COOKIE['userId'];
            return User::getById($userId);

        } else {
            return null;
        }
    }

    public function auth(AuthUserDTO $data):bool
    {
        $user = User::getByEmail($data->getEmail());
        if(!$user){
            return false;
        } else {
            $passwordDB = $user->getPassword();
            if(password_verify($data->getPassword(), $passwordDB)) {
                setcookie('userId', $user->getId());
                return true;
            } else {
                return false;
            }
        }
    }

    public function logout()
    {
        setcookie('userId', '', time() - 3600,  '/');
        unset($_COOKIE['userId']);
    }

}