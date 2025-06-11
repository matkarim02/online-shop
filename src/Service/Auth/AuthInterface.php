<?php

namespace Service\Auth;

use DTO\AuthUserDTO;
use Model\User;

interface AuthInterface
{
    public function check():bool;


    public function getUser(): ?User;


    public function auth(AuthUserDTO $data):bool;


    public function logout();

}