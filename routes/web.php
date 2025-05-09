<?php

use App\Http\Controllers\AuthinticateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/registration', [AuthinticateController::class, 'showRegistrationForm'])->name('registration');
Route::post('/registration', [AuthinticateController::class, 'registration']);

Route::get('/login', [AuthinticateController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthinticateController::class, 'login']);

Route::get('/logout', [AuthinticateController::class, 'logout'])->name('logout');

Route::get('/apartments', function () {
    return view('apartments');
});

Route::get('/detailsapartments', function () {
    return view('detailsapartments');
});

Route::get('/newproposition', function () {
    return view('newproposition');
});

Route::get('/editapartment', function () {
    return view('editapartment');
});

