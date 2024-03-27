<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\GameController;
use \App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyGameController;
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

    Route::prefix('games')
        ->group(function () {
            Route::get('all', [GameController::class, 'index']);
            Route::get('{id}', [GameController::class, 'show']);
            Route::post('create', [GameController::class, 'store']);
            Route::post('update/{id}', [GameController::class, 'update']);
            Route::post('delete/{id}', [GameController::class, 'destroy']);
        });

    Route::get('/company-games', [CompanyGameController::class, 'index']);

    Route::put('/users/edit/{id}', [UserController::class, 'update']);

    Route::get('logout',[LoginController::class,'logout']);
});
