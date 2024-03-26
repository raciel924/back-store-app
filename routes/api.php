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
            Route::post('registry', [CompanyController::class, 'registry']);
            Route::get('update/{id}', [CompanyController::class, 'update']);
            Route::get('delete/{id}', [CompanyController::class, 'delete']);
        });

    Route::get('logout',[LoginController::class,'logout']);

    Route::get('/games/all', [GameController::class, 'index']);
    Route::get('/games/{id}', [GameController::class, 'show']);
    Route::post('/games/create', [GameController::class, 'store']);
    Route::put('/games/edit/{id}', [GameController::class, 'update']);
    Route::delete('/games/delete/{id}', [GameController::class, 'destroy']);
});
