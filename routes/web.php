<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\PelangganController;
use App\Http\Controllers\Web\PetugasController;
use App\Http\Controllers\API\UserController;

// Basic routes
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::group(['prefix' => ''], function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// User routes
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

// Admin routes
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Pelanggan management routes
    Route::prefix('/admin/dashboard/pelanggan')->group(function () {
        Route::get('/', [PelangganController::class, 'index'])->name('admin.dashboard.pelanggan.index');
        Route::get('/add', function () {
            return view('admin.dashboard.pelanggan.pelanggan-create');
        })->name('admin.dashboard.pelanggan.create');
        Route::post('/store', [PelangganController::class, 'store'])->name('pelanggan.store');
        Route::get('/edit/{id}', [PelangganController::class, 'edit'])->name('admin.dashboard.pelanggan.edit');
        Route::put('/edit/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('pelanggan.destroy');
    });

    Route::prefix('/admin/dashboard/petugas')->group(function () {
        Route::get('/', [PetugasController::class, 'index'])->name('admin.dashboard.petugas.index');
    });
});
