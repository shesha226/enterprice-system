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
            'Role'     => 'required|string|in:Admin,Cashier,Manager', // පද්ධතියේ ඉන්න පුළුවන් Roles විතරක් සීමා කළා
            'Password' => 'required|string|min:6',
        ]);

        try {
            $this->userService->createUser($validateData);

            return response()->json(['message' => 'User created successfully.'], 201);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => 'Error creating user.', 'errors' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error.', 'errors' => $e->getMessage()], 500);
        }
    }
}
