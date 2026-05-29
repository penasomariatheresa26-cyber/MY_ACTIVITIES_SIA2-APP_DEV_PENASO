<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// Get authenticated user info
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// USERS API - Full CRUD
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);           // GET all users
    Route::get('/{id}', [UserController::class, 'show']);        // GET single user
    Route::post('/', [UserController::class, 'store']);          // CREATE user
    Route::put('/{id}', [UserController::class, 'update']);       // UPDATE user
    Route::delete('/{id}', [UserController::class, 'destroy']);  // DELETE user
});