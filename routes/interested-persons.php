<?php

use App\Http\Controllers\InterestedPersonController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('interested-persons', InterestedPersonController::class);
});
