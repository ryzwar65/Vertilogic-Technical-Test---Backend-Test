<?php

use Illuminate\Http\Request;

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

Route::prefix('v1')->group(function () {
    Route::apiResource('vendors', 'VendorController');    
    Route::get('tags','VendorController@tags');
    Route::prefix('order')->group(function () {
       Route::get('list-dishes','OrderController@listdishes');
       Route::post('order','OrderController@order');
       Route::post('special-order','OrderController@specialorder');
       Route::get('list-order','OrderController@listorder');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
