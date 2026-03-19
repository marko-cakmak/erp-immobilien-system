<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApartmentController;

Route::middleware(['auth'])->group(function () {

    Route::get('/apartments', [ApartmentController::class, 'index'])
        ->middleware('permission:view_wohnungen')
        ->name('apartments.index');

    Route::get('/apartments/create', [ApartmentController::class, 'create'])
        ->middleware('permission:manage_wohnungen')
        ->name('apartments.create');

    Route::post('/apartments', [ApartmentController::class, 'store'])
        ->middleware('permission:manage_wohnungen')
        ->name('apartments.store');

    Route::get('/apartments/search', [ApartmentController::class, 'ajaxSearch'])
        ->middleware('permission:view_wohnungen')
        ->name('apartments.search');

    Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])
        ->middleware('permission:view_wohnungen')
        ->name('apartments.show');

    Route::get('/apartments/{apartment}/edit', [ApartmentController::class, 'edit'])
        ->middleware('permission:manage_wohnungen')
        ->name('apartments.edit');

    Route::put('/apartments/{apartment}', [ApartmentController::class, 'update'])
        ->middleware('permission:manage_wohnungen')
        ->name('apartments.update');

    Route::delete('/apartments/{apartment}', [ApartmentController::class, 'destroy'])
        ->middleware('permission:manage_wohnungen')
        ->name('apartments.destroy');
});
