<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\HomeRedirectController;

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', HomeRedirectController::class)
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Panel
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::view('/admin', 'panels.admin')->name('admin.panel');
    });

    /*
    |--------------------------------------------------------------------------
    | Supplier Panel
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:supplier')->group(function () {
        Route::view('/supplier', 'panels.supplier')->name('supplier.panel');
    });

    /*
    |--------------------------------------------------------------------------
    | Customer Panel
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:customer')->group(function () {

        Route::get('/customer', [CustomerDashboardController::class, 'index'])
            ->name('customer.panel');

        Route::post('/customer/cart/add', [CustomerDashboardController::class, 'addToCart'])
            ->name('customer.cart.add');

        Route::patch('/customer/cart/{id}', [CustomerDashboardController::class, 'updateCart'])
            ->name('customer.cart.update');

        Route::delete('/customer/cart/{id}', [CustomerDashboardController::class, 'removeFromCart'])
            ->name('customer.cart.remove');

        Route::post('/customer/checkout', [CustomerDashboardController::class, 'checkout'])
            ->name('customer.checkout');
    });

});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';