<?php

use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/contracts/apartment/{apartment}/persons', [ContractController::class, 'getApartmentPersons'])
        ->middleware('permission:view_contracts')
        ->name('contracts.apartment.persons');

    Route::resource('contracts', ContractController::class)
        ->middleware([
            'index' => 'permission:view_contracts',
            'show' => 'permission:view_contracts',
            'create' => 'permission:manage_contracts',
            'store' => 'permission:manage_contracts',
            'edit' => 'permission:manage_contracts',
            'update' => 'permission:manage_contracts',
            'destroy' => 'permission:manage_contracts',
        ]);

    Route::post('/contracts/{contract}/sign', [ContractController::class, 'sign'])
        ->middleware('permission:manage_contracts')
        ->name('contracts.sign');

    Route::get('/contracts/{contract}/preview', [ContractController::class, 'preview'])
        ->middleware('permission:view_contracts')
        ->name('contracts.preview');

});
