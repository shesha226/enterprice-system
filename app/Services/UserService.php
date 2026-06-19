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

    public function getUserById(int $id)
    {
        try {
            $user = $this->userRepository->getUserById($id);
            if (!$user) {
                throw new InvalidArgumentException('User not found.');
            }
            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAllUsers()
    {
        try {
            return $this->userRepository->getAllUsers();
        } catch (Exception $e) {
            Log::error('Error fetching all users: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateUser(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->getUserById($id);
            if (!$user) {
                throw new InvalidArgumentException('User not found.');
            }

            $updatedUser = $this->userRepository->updateUser($id, $data);

            DB::commit();
            return $updatedUser;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating user in UserService: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteUser(int $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->getUserById($id);
            if (!$user) {
                throw new InvalidArgumentException('User not found.');
            }

            $this->userRepository->deleteUser($id);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting user in UserService: ' . $e->getMessage());
            throw $e;
        }
    }
}
