<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoffeeController;

Route::get('/coffees', [CoffeeController::class, 'index'])->name('coffees.index');
Route::get('/coffees/{id}', [CoffeeController::class, 'show'])->name('coffees.show');