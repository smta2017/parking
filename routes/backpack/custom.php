<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('transaction', 'TransactionCrudController');
    Route::crud('plan-subscription', 'PlanSubscriptionCrudController');
    Route::crud('client', 'ClientCrudController');
    Route::crud('customer-vehicle', 'CustomerVehicleCrudController');

    Route::resource('subscription', 'SubscriptionController');
    Route::resource('customers', 'CustomerController');
    Route::resource('vehicles', 'VehicleController');
    Route::crud('admin', 'AdminCrudController');
}); // this should be the absolute last line of this file