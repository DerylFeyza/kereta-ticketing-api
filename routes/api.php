<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\KeretaController;
use App\Http\Controllers\API\GerbongController;
use App\Http\Controllers\API\KursiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['message' => 'welcome to kereta ticketing API !'], 200);
});

Route::prefix('kereta')->group(function () {
    Route::post('/', [KeretaController::class, 'createKereta']);
    Route::get('/{id?}', [KeretaController::class, 'getKereta']);
    Route::patch('/{id}', [KeretaController::class, 'updateKereta']);
    Route::delete('/{id}', [KeretaController::class, 'deleteKereta']);
});

Route::prefix('gerbong')->group(function () {
    Route::post('/', [GerbongController::class, 'createGerbong']);
    Route::get('/{id?}', [GerbongController::class, 'getGerbong']);
    Route::patch('/{id}', [GerbongController::class, 'updateGerbong']);
    Route::delete('/{id}', [GerbongController::class, 'deleteGerbong']);
});

Route::prefix('kursi')->group(function () {
    Route::post('/', [KursiController::class, 'createKursi']);
    Route::get('/{id?}', [KursiController::class, 'getKursi']);
    Route::patch('/{id}', [KursiController::class, 'updateKursi']);
    Route::delete('/{id}', [KursiController::class, 'deleteKursi']);
});
