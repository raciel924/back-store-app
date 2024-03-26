<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\GameController;
use \App\Http\Controllers\CompanyController;
use \App\Http\Controllers\LoginController;
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
    Route::prefix('companies')
        ->group(function () {
            Route::get('all', [CompanyController::class, 'index']);
            Route::get('{id}', [CompanyController::class, 'show']);
            Route::post('create', [CompanyController::class, 'store']);
            Route::post('update/{id}', [CompanyController::class, 'update']);
            Route::post('delete/{id}', [CompanyController::class, 'destroy']);
        });

    Route::get('logout',[LoginController::class,'logout']);

    Route::get('/games/all', [GameController::class, 'index']);
    Route::get('/games/{id}', [GameController::class, 'show']);
    Route::post('/games/create', [GameController::class, 'store']);
    Route::post('/games/edit/{id}', [GameController::class, 'update']);
    Route::post('/games/delete/{id}', [GameController::class, 'destroy']);
});
