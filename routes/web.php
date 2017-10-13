<?php

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

Route::redirect('/', '/dashboard', 301);

Route::get('login', 'LoginController@login')->name('login');;
Route::post('authenticate', 'LoginController@authenticate');

Route::group(['middleware' => 'restAuthentication'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('deleteUser', 'DashboardController@delete')->name('deleteUser');
});