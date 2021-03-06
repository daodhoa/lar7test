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

Route::get('/', function () {
    return view('admin.profile.index');
})->name('admin.profile.index');

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
], function () {
    Route::group([
        'namespace' => 'Auth'
    ], function () {
        Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'LoginController@main')->name('admin.postLogin');
    });
});
