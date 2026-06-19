<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function createUser(array $data);
    public function getUserById($id);
    public function getAllUsers();
    public function updateUser($id, array $data);
    public function deleteUser($id);
}
