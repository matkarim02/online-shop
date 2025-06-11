<?php

namespace Service\Auth;

use DTO\AuthUserDTO;
use Model\User;

class AuthSessionService implements AuthInterface
{
    protected User $userModel;
    public function __construct()
    {
        $this->userModel = new User;
    }
    public function check():bool
    {
        $this->startSession();
        return isset($_SESSION['userId']);
    }

    public function getUser(): ?User
    {
        $this->startSession();
        if($this->check()) {

            $userId = $_SESSION['userId'];
            return $this->userModel->getById($userId);

        } else {
            return null;
        }
    }

    public function auth(AuthUserDTO $data):bool
    {
        $user = $this->userModel->getByEmail($data->getEmail());
        if(!$user){
            return false;
        } else {
            $passwordDB = $user->getPassword();
            if(password_verify($data->getPassword(), $passwordDB)) {
                $this->startSession();
                $_SESSION['userId'] = $user->getId();

                return true;
            } else {
                return false;
            }
        }
    }

    public function logout()
    {
        $this->startSession();
        session_destroy();
    }

    private function startSession():void
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
    }
}