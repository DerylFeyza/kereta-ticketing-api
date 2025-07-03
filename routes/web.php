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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/dashboard/pelanggan', [PelangganController::class, 'index'])->name('admin.dashboard.pelanggan.index');
    Route::get('/admin/dashboard/pelanggan/add', function () {
        return view('admin.dashboard.pelanggan.pelanggan-create');
    })->name('admin.dashboard.pelanggan.create');
    Route::get('/admin/dashboard/pelanggan/edit/{id}', [PelangganController::class, 'edit'])->name('admin.dashboard.pelanggan.edit');
    Route::post('/admin/dashboard/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/admin/dashboard/pelanggan/edit/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/admin/dashboard/pelanggan/{id}', [UserController::class, 'destroy'])->name('pelanggan.destroy');
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
