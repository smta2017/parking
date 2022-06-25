<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\CustomerAPIController;
use App\Http\Controllers\API\PlanController as APIPlanController;
use App\Http\Controllers\API\TransactionAPIController;
use App\Http\Controllers\API\UserAPIController;
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
        Route::post('checkin-client/{client_id}', [TransactionAPIController::class, 'checkInClient']);
        Route::post('checkout/{qr_code?}', [TransactionAPIController::class, 'checkOut']);        
        Route::post('checkout-clinet/{client_id}', [TransactionAPIController::class, 'checkOutClient']);        
        Route::put('collect', [TransactionAPIController::class, 'actualCollect']);        
        Route::post('checkout-plate/{plate}', [TransactionAPIController::class, 'checkOutByPlate']);        
    });
    Route::resource('transactions', TransactionAPIController::class);
});


Route::resource('users', UserAPIController::class);

Route::resource('customers', CustomerAPIController::class);

Route::post('subscriptions', [APIPlanController::class, 'createSubscription']);


Route::resource('zones', App\Http\Controllers\API\ZoneAPIController::class);


Route::resource('customerVehicles', App\Http\Controllers\API\CustomerVehicleAPIController::class);
