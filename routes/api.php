<?php

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

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API'
], function() {
    Route::group([
        'prefix' => 'auth'
    ], function() {
        Route::post('/sign-in', 'AuthController@signIn');
        Route::post('/sign-up', 'AuthController@signUp');
        Route::get('/verify/{id}/{token}', 'AuthController@verifySignUp');
        Route::post('/sign-out', 'AuthController@signOut')->middleware('auth.jwt');
        Route::get('/me', 'AuthController@getMe')->middleware('auth.jwt');
    });

    Route::group([
        'prefix' => 'posts',
        'middleware' => 'auth.jwt'
    ], function () {

    });
});
