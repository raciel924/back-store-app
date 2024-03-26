<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\GameController;
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




Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/companies', [UserController::class, 'indexCompanies']);

    Route::get('/games/all', [GameController::class, 'index']);
    Route::get('/games/{id}', [GameController::class, 'show']);
    Route::post('/games/create', [GameController::class, 'store']);
    Route::put('/games/edit/{id}', [GameController::class, 'update']);
    Route::delete('/games/delete/{id}', [GameController::class, 'destroy']);
});
