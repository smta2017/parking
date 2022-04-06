<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\TransactionAPIController;
use App\Http\Controllers\API\UserAPIController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'transactions'], function () {
        Route::post('checkin', [TransactionAPIController::class, 'checkIn']);
        Route::post('checkout/{qr_code?}', [TransactionAPIController::class, 'checkOut']);        
    });
    Route::resource('transactions', TransactionAPIController::class);
});


Route::resource('users', UserAPIController::class);


Route::resource('zones', App\Http\Controllers\API\ZoneAPIController::class);
