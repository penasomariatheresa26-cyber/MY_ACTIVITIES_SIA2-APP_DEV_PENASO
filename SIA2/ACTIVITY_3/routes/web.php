<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VolunteerController;
Route::get('/volunteer/dashboard', [VolunteerController::class, 'dashboard'])->name('volunteer.dashboard');
Route::get('/volunteer', [VolunteerController::class, 'create'])->name('volunteer.create');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');
Route::get('/', function () {
    return view('welcome');
});
