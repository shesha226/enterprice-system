<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);
Route::post('/employees', [EmployeeController::class, 'createEmployee']);
Route::get('/employees/{id}', [EmployeeController::class, 'getEmployeeById']);
Route::put('/employees/{id}', [EmployeeController::class, 'updateEmployee']);
Route::delete('/employees/{id}', [EmployeeController::class, 'deleteEmployee']);

Route::get('/users', [UserController::class, 'getAllUsers']);
Route::post('/users', [UserController::class, 'createUser']);
Route::get('/users/{id}', [UserController::class, 'getUserById']);
Route::put('/users/{id}', [UserController::class, 'updateUser']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::post('/products', [ProductController::class, 'CreateProduct']);
Route::get('/products/{id}', [ProductController::class, 'getProductById']);
Route::put('/products/{id}', [ProductController::class, 'updateProduct']);
Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);
