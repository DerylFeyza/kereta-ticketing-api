<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\PelangganController;
use App\Http\Controllers\API\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/dashboard/pelanggan', [PelangganController::class, 'index'])->name('admin.dashboard.pelanggan.index');
Route::delete('/admin/dashboard/pelanggan/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/register', [AuthController::class, 'register']);
