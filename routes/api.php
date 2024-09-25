<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/tasks', [TaskController::class, 'getTask']);
Route::post('/tasks/create', [TaskController::class, 'createTask']);
Route::prefix('/task')->group(function () {
    Route::put('/{id}', [TaskController::class, 'updateTask']);
    Route::delete('/{id}', [TaskController::class, 'deleteTask']);
});

