<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/menu', [MenuController::class, 'index']);

Route::get('/cart', [CartController::class, 'index']);

Route::post('/cart/add', [CartController::class, 'add']);

Route::post('/checkout', [OrderController::class, 'store']);

Route::get('/admin', [AdminController::class, 'index']);