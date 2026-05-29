<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Form Routes
|--------------------------------------------------------------------------
*/

Route::get('/form', [FormController::class, 'create'])->name('form.create');

Route::post('/form/store', [FormController::class, 'store'])->name('form.store');

Route::get('/form/view', [FormController::class, 'view'])->name('form.view');

Route::get('/form/dashboard', [FormController::class, 'dashboard'])->name('form.dashboard');