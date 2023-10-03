<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function createUser(array $userInfo);
    public function updateUser($userId, array $userInfo);
    public function getUserById($userId);
}
