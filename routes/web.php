<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
