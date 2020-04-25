<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
], function () {
    Route::group([
        'namespace' => 'Auth',
        'middleware' => 'guest'
    ], function () {
        Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'LoginController@main')->name('admin.postLogin');
    });

    Route::group([
        'middleware' => 'admin'
    ], function () {
        Route::get('logout', 'Auth\LogoutController@main')->name('admin.logout');
        Route::get('dashboard', 'DashboardController@main')->name('admin.dashboard');
    });
});
