<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function createUser(array $userInfo)
    {
        return User::create($userInfo);
    }

    public function getUserById($userId)
    {
        return User::find($userId);
    }   

    public function updateUser($userId, array $userInfo)
    {
        return User::whereId($userId)->update($userInfo);
    }
}
