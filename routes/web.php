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

Route::get('/apartments', [ApartmentControlles::class, 'showApartments'])->name('apartments');
Route::post('/apartments', [ApartmentControlles::class, 'sortApartments']);

Route::get('/detailsapartments/{id}', [ApartmentControlles::class, 'showDetailsApartments'])->name('detailsapartments');

Route::get('/editapartment', function () {
    return view('editapartment');
});

