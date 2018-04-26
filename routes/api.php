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



Route::post('auth/login', 'Api\RoomController@login');

Route::group([
    'prefix' => 'auth',
    'middleware'=>'jwt.auth'
    
], function () {

   
    Route::post('logout', 'Api\RoomController@logout');
    Route::post('refresh', 'Api\RoomController@refresh');
    Route::post('room', 'Api\RoomController@index');
   


   
});
