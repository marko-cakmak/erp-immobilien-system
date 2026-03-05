<?php

use App\Http\Controllers\InterestedPersonController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('interested-persons/search', [InterestedPersonController::class, 'ajaxSearch'])
        ->name('interested-persons.search');

    Route::resource('interested-persons', InterestedPersonController::class);
});
