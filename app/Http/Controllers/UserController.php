<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use InvalidArgumentException;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(Request $request)
    {
        $validateData = $request->validate([
            'UserId'   => 'required|integer',
            'Name'     => 'required|string|max:255',
            'Role'     => 'required|string|in:Admin,Cashier,Manager',
            'Password' => 'required|string|min:6',
        ]);

        try {
            $this->userService->createUser($validateData);

            return response()->json(['message' => 'User created successfully.', 'data' => $validateData], 201);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => 'Error creating user.', 'errors' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error.', 'errors' => $e->getMessage()], 500);
        }
    }

    public function getAllUsers()
    {
        try {
            $user = $this->userService->getAllUsers();
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching users.', 'errors' => $e->getMessage()], 500);
        }
    }

    public function getUserById(int $id)
    {
        try {
            $user = $this->userService->getUserById($id);
            return response()->json($user, 200);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching user.', 'errors' => $e->getMessage()], 500);
        }
    }

    public function updateUser(Request $request, int $id)
    {
        $validatedata = $request->validate([
            'Name'     => 'sometimes|required|string|max:255',
            'Role'     => 'sometimes|required|string|in:Admin,Cashier,Manager',
            'Password' => 'sometimes|required|string|min:6',
        ]);
        try {
            $this->userService->updateUser($id, $validatedata);
            return response()->json(['message' => 'User updated successfully.', 'data' => $validatedata], 200);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => 'Error updating user.', 'errors' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating user.', 'errors' => $e->getMessage()], 422);
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $this->userService->deleteUser($id);
            return response()->json(['message' => 'User deleted successfully.', 'data' => ['id' => $id]], 200);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => 'Error deleting user.', 'errors' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting user.', 'errors' => $e->getMessage()], 422);
        }
    }
}
