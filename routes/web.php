<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamRegistrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [TeamRegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [TeamRegistrationController::class, 'register']);
