<?php


use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::resource('tasks', TaskController::class);
Route::get('/', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/toggle/{task}', [TaskController::class, 'toggle']);
Route::get('/tasks/delete/{task}', [TaskController::class, 'destroy']);
