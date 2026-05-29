<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FoodController as AdminFoodController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])
        ->name('admin.login');
});

/*
|--------------------------------------------------------------------------
| LOGIN SUBMIT
|--------------------------------------------------------------------------
*/

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::post('/admin/login', [LoginController::class, 'adminLogin'])
    ->name('admin.login.submit');

/*
|--------------------------------------------------------------------------
| LOGOUT ROUTE
|--------------------------------------------------------------------------
*/

Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');

})->name('logout');

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])
        ->name('home.dashboard');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::post('/cart/add', [CartController::class, 'add'])
        ->name('cart.add');

    Route::patch('/cart/{cart}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{cart}', [CartController::class, 'remove'])
        ->name('cart.remove');

    Route::delete('/cart', [CartController::class, 'clear'])
        ->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout');

    Route::post('/checkout', [CheckoutController::class, 'process'])
        ->name('checkout.process');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders');

    Route::get('/orders/{id}', [OrderController::class, 'show'])
        ->name('orders.show');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | FOODS
        |--------------------------------------------------------------------------
        */

        Route::get('/foods', [AdminFoodController::class, 'index'])
            ->name('foods.index');

        Route::get('/foods/create', [AdminFoodController::class, 'create'])
            ->name('foods.create');

        Route::post('/foods', [AdminFoodController::class, 'store'])
            ->name('foods.store');

        Route::get('/foods/{food}/edit', [AdminFoodController::class, 'edit'])
            ->name('foods.edit');

        Route::put('/foods/{food}', [AdminFoodController::class, 'update'])
            ->name('foods.update');

        Route::delete('/foods/{food}', [AdminFoodController::class, 'destroy'])
            ->name('foods.destroy');

        /*
        |--------------------------------------------------------------------------
        | ADMIN ORDERS
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::patch('/orders/{order}/status',
            [AdminOrderController::class, 'updateStatus'])
            ->name('orders.status');

            // Orders
Route::get('/orders', [AdminOrderController::class, 'index'])
    ->name('orders.index');

Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
    ->name('orders.show');

Route::patch('/orders/{order}/status',
    [AdminOrderController::class, 'updateStatus'])
    ->name('orders.status');

Route::patch('/orders/{order}/payment',
    [AdminOrderController::class, 'updatePayment'])
    ->name('orders.payment');
    });