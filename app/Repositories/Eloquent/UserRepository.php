<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getUserById($id)
    {
        return User::where('UserId', $id)->first();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }
}
