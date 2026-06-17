<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function createUser(array $data);
    public function getUserById($id);
}
