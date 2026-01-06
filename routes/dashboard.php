<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', fn () => view('dashboard.index'))->name('dashboard');
    Route::get('/dashboard', fn () => view('dashboard.index'));
});
