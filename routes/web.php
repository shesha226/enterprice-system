<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductWebController;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\EmployeeWebController;
use App\Http\Controllers\AttendanceWebController;
use App\Http\Controllers\SalesWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // New Module Resource Routes
    Route::resource('products', ProductWebController::class);
    Route::resource('users', UserWebController::class);
    Route::resource('employees', EmployeeWebController::class);
    Route::resource('attendance', AttendanceWebController::class);
    Route::resource('sales', SalesWebController::class);
});

require __DIR__ . '/auth.php';
