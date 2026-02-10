<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StatusController;

Route::prefix('tasks')->group(function () {
    Route::post('/', [TaskController::class, 'create']);
    Route::get('/', [TaskController::class, 'getAll']);
    Route::get('/{id}', [TaskController::class, 'getById']);
    Route::put('/{id}', [TaskController::class, 'update']);
    Route::delete('/{id}', [TaskController::class, 'deleteById']);

});

Route::prefix('statuses')->group(function () {
    Route::post('/', [StatusController::class, 'create']);
    Route::get('/', [StatusController::class, 'getAll']);
    Route::get('/{id}', [StatusController::class, 'getById']);
    Route::put('/{id}', [StatusController::class, 'update']);
    route::delete('/{id}', [StatusController::class, 'deleteById']);
});
