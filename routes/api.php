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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::namespace('Api')->group(function () {
    Route::post('registration', 'UsersController@store')->name('registration');
    Route::post('login', 'AppController@login')->name('login');
    Route::post('logout', 'AppController@logout')->name('logout');
    Route::post('send-otp', 'AppController@sendOtp')->name('send-otp');
    Route::post('verify-otp', 'AppController@verifyOtp')->name('verify-otp');
    Route::post('change-password', 'AppController@resetPassword')->name('change-password');
    Route::get('init', 'AppController@init')->name('init');
});
