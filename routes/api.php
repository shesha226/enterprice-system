<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController; // EmployeeController එක උඩින්ම import කරගත්තා

// Default Laravel API Route (මෙහෙමම තිබ්බපුදෙන්)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- ඔයාගේ Employees Routes ටික මෙතනින් පහළට ---

Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);
Route::post('/employees', [EmployeeController::class, 'createEmployee']);
Route::get('/employees/{id}', [EmployeeController::class, 'getEmployeeById']);
Route::put('/employees/{id}', [EmployeeController::class, 'updateEmployee']);
Route::delete('/employees/{id}', [EmployeeController::class, 'deleteEmployee']);
