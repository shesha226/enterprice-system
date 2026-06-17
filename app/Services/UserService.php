<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Exception;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data)
    {
        DB::beginTransaction();
        try {
            $existingUser = $this->userRepository->getUserById($data['UserId'] ?? null);
            if ($existingUser) {
                throw new InvalidArgumentException('User with this ID already exists.');
            }

            $user = $this->userRepository->createUser($data);

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating user in UserService: ' . $e->getMessage());
            throw $e;
        }
    }
}
