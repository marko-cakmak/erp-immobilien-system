<?php

use App\Http\Controllers\InterestedPersonController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('interested-persons/search', [InterestedPersonController::class, 'ajaxSearch'])
        ->middleware('permission:view_interessenten')
        ->name('interested-persons.search');

    Route::resource('interested-persons', InterestedPersonController::class)
        ->middleware([
            'index'   => 'permission:view_interessenten',
            'show'    => 'permission:view_interessenten',
            'create'  => 'permission:manage_interessenten',
            'store'   => 'permission:manage_interessenten',
            'edit'    => 'permission:manage_interessenten',
            'update'  => 'permission:manage_interessenten',
            'destroy' => 'permission:manage_interessenten',
        ]);
});
