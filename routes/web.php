<?php

use App\Http\Controllers\AllUsersController;
use App\Http\Controllers\AuthinticateController;
use App\Http\Controllers\ApartmentControlle;
use Illuminate\Support\Facades\Route;

Route::get('/', [ApartmentControlle::class, 'showHomePage'])->name('homePage');

Route::get('/registration', [AuthinticateController::class, 'showRegistrationForm'])->name('registration');
Route::post('/registration', [AuthinticateController::class, 'registration']);

Route::get('/login', [AuthinticateController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthinticateController::class, 'login']);

Route::get('/logout', [AuthinticateController::class, 'logout'])->name('logout');

Route::get('/newproposition', [ApartmentControlle::class, 'showNewProposition'])->name('newproposition');
Route::post('/newproposition', [ApartmentControlle::class, 'newProposition'])->name('newproposition');

Route::get('/apartments', [ApartmentControlle::class, 'showApartments'])->name('apartments');

Route::get('/allusers', [AllUsersController::class, 'showAllUsers'])->name('allusers');
Route::get('/changeRole/{id}', [AllUsersController::class, 'changeRole'])->name('changeRole');

Route::get('/detailsapartments/{id}', [ApartmentControlle::class, 'showDetailsApartments'])->name('detailsapartments');

Route::get('/editapartments/{id}', [ApartmentControlle::class, 'showEditApartment'])->name('editapartments');
Route::post('/editapartments/{id}', [ApartmentControlle::class, 'editApartment'])->name('updateapartment');

Route::get('/deleteapartment/{id}', [ApartmentControlle::class, 'deleteApartment'])->name('deleteapartment');

Route::post('/newReservation/{id}', [ApartmentControlle::class, 'reservation'])->name('newReservation');
