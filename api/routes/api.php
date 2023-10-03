<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });




    Route::get('/tasks', [TaskController::class, 'list'])
                ->name('tasks');

    Route::get('/tasks/{id}', [TaskController::class, 'index'])
                ->name('tasks.id');

    Route::post('/task', [TaskController::class, 'store'])
                ->name('tasks.store');

    Route::put('/task', [TaskController::class, 'update'])
                ->name('tasks.update');

    Route::delete('/task', [TaskController::class, 'destroy'])
                ->name('tasks.destroy');

    Route::post('/comment', [CommentController::class, 'store'])
                ->name('tasks.store');

    Route::put('/comment', [CommentController::class, 'update'])
                ->name('tasks.update');

    Route::delete('/comment', [CommentController::class, 'destroy'])
                ->name('tasks.destroy');


});
