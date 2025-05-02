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

Route::get('/apartaments', function () {
    return view('apartaments');
});

Route::get('/newproposition', function () {
    return view('newproposition');
});
