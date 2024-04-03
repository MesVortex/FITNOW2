<?php

use App\Http\Controllers\ProgressController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/progress', [ProgressController::class, 'index']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'loginUser']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/progress/history', [ProgressController::class, 'showUserProgress']);
    Route::post('progress', [ProgressController::class, 'store']);
    Route::put('progress/{progress}', [ProgressController::class, 'update']);
    Route::delete('progress/{progress}', [ProgressController::class, 'destroy']);
    Route::patch('progress/{progress}', [ProgressController::class, 'updateStatus']);
    Route::post('/logout', [UserController::class, 'logout']);
});

// Route::resource('progress', ProgressController::class);

// Route::patch('progress/{progress}', [ProgressController::class, 'updateStatus']);