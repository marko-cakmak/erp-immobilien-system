<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApartmentController;

Route::middleware(['auth'])->group(function () {

    Route::get('/apartments', [ApartmentController::class, 'index'])
        ->name('apartments.index');

    Route::get('/apartments/create', [ApartmentController::class, 'create'])
        ->name('apartments.create');

    Route::post('/apartments', [ApartmentController::class, 'store'])
        ->name('apartments.store');

    Route::get('/apartments/search', [ApartmentController::class, 'ajaxSearch'])
        ->name('apartments.search');

    Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])
        ->name('apartments.show');

    Route::get('/apartments/{apartment}/edit', [ApartmentController::class, 'edit'])
        ->name('apartments.edit');

    Route::put('/apartments/{apartment}', [ApartmentController::class, 'update'])
        ->name('apartments.update');

    Route::delete('/apartments/{apartment}', [ApartmentController::class, 'destroy'])
        ->name('apartments.destroy');
});
