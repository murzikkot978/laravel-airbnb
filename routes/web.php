<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', function () {
    return view('registration');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/apartments', function () {
    return view('apartments');
});

Route::get('/newproposition', function () {
    return view('newproposition');
});

Route::get('/editapartment', function () {
    return view('editapartment');
});
