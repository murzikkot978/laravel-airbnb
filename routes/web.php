<?php

use App\Http\Controllers\AuthinticateController;
use App\Http\Controllers\ApartmentControlles;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/registration', [AuthinticateController::class, 'showRegistrationForm'])->name('registration');
Route::post('/registration', [AuthinticateController::class, 'registration']);

Route::get('/login', [AuthinticateController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthinticateController::class, 'login']);

Route::get('/logout', [AuthinticateController::class, 'logout'])->name('logout');

Route::get('/newproposition', [ApartmentControlles::class, 'showNewProposition'])->name('newproposition');
Route::post('/newproposition', [ApartmentControlles::class, 'newProposition']);

Route::get('/apartments', function () {
    return view('apartments');
});

Route::get('/detailsapartments', function () {
    return view('detailsapartments');
});

Route::get('/editapartment', function () {
    return view('editapartment');
});

