<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::middleware(['auth'])->group(function () {

    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('tasks.index');

    Route::get('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::get('/tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show');

    Route::put('/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');

    Route::post('/tasks/{task}/status', [TaskController::class, 'changeStatus'])
        ->name('tasks.changeStatus');

    Route::post('/tasks/{task}/besichtigung', [TaskController::class, 'storeBesichtigung'])
        ->name('tasks.besichtigung.store');

});
