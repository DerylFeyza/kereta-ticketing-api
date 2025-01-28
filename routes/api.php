<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\KeretaController;
use App\Http\Controllers\API\GerbongController;
use App\Http\Controllers\API\KursiController;
use App\Http\Controllers\API\JadwalController;
use App\Http\Controllers\API\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['message' => 'welcome to kereta ticketing API !'], 200);
});

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'registerPelanggan']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('kereta')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [KeretaController::class, 'createKereta']);
    Route::get('/{id?}', [KeretaController::class, 'getKereta'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{id}', [KeretaController::class, 'updateKereta']);
    Route::delete('/{id}', [KeretaController::class, 'deleteKereta']);
});

Route::prefix('gerbong')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [GerbongController::class, 'createGerbong']);
    Route::get('/{id?}', [GerbongController::class, 'getGerbong'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{id}', [GerbongController::class, 'updateGerbong']);
    Route::delete('/{id}', [GerbongController::class, 'deleteGerbong']);
});

Route::prefix('kursi')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [KursiController::class, 'createKursi']);
    Route::get('/{id?}', [KursiController::class, 'getKursi'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{id}', [KursiController::class, 'updateKursi']);
    Route::delete('/{id}', [KursiController::class, 'deleteKursi']);
});

Route::prefix('jadwal')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [JadwalController::class, 'createJadwal']);
    Route::get('/', [JadwalController::class, 'getJadwals'])->withoutMiddleware('auth:sanctum');
    Route::get('/{id}', [JadwalController::class, 'findJadwal'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{id}', [JadwalController::class, 'updateJadwal']);
    Route::delete('/{id}', [JadwalController::class, 'deleteJadwal']);
});

Route::prefix('tiket')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [OrderController::class, 'createTiket']);
    Route::get('/', [OrderController::class, 'getUserTikets']);
    Route::get('/{id}', [OrderController::class, 'findTiket']);
    Route::delete('/{id}', [OrderController::class, 'deleteTiket']);
});
