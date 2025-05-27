<?php

use App\Http\Controllers\AuthinticateController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/registration', [AuthinticateController::class, 'showRegistrationForm'])->name('registration');
Route::post('/registration', [AuthinticateController::class, 'registration']);

Route::get('/login', [AuthinticateController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthinticateController::class, 'login']);

Route::get('/logout', [AuthinticateController::class, 'logout'])->name('logout');

Route::resource('apartments', ApartmentController::class);

Route::get('/', [ApartmentController::class, 'apartment'])->name('apartments.apartment');
Route::post('/apartments/{apartment}/reservation', [ApartmentController::class, 'reservation'])->name('apartments.reservation');
Route::post('/apartments/{apartment}/update', [ApartmentController::class, 'update'])->name('apartments.update');
Route::get('/apartments/{apartment}/delete', [ApartmentController::class, 'destroy'])->name('apartments.destroy');


Route::resource('users', UsersController::class);

Route::post('/users/{user}/changeRole', [UsersController::class, 'changeRole'])->name('users.changeRole');
Route::post('/users/{user}/update', [UsersController::class, 'update'])->name('users.update');
Route::get('/users/{user}/delete', [UsersController::class, 'destroy'])->name('users.destroy');
