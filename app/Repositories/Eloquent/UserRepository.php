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

    public function getAllUsers()
    {
        return User::all();
    }

    public function updateUser($id, array $data)
    {
        $user = $this->getUserById($id);
        if ($user) {
            $user->update($data);
        }
        return $user;
    }

    public function deleteUser($id)
    {
        $user = $this->getUserById($id);
        if ($user) {
            $user->delete();
        }
    }
}
