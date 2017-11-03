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

Route::redirect('/', '/users');

// temp fix for 301 redirect
Route::redirect('/dashboard', '/users');

Route::get('/login', 'AuthenticationController@login')->name('authentication.login');
Route::post('/auth', 'AuthenticationController@authenticate')->name('authentication.authenticate');

Route::group(['middleware' => 'restAuthentication'], function ()
{
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
    Route::get('/users/{id}/overview', 'UsersController@show')->name('users.show');
    Route::get('/users/{id}/history', 'UsersController@history')->name('users.history');
    Route::get('/users/{id}/portfolio', 'UsersController@portfolio')->name('users.portfolio');
    Route::get('/users/{id}/dangerzone', 'UsersController@dangerzone')->name('users.dangerzone');
    Route::put('/users/{userId}/accounts/{accountId}', 'UsersController@resetAccount')->name('users.resetAccount');
    Route::delete('/users/{id}', 'UsersController@destroy')->name('users.delete');
    Route::post('/users/{id}', 'UsersController@update')->name('users.update');
    Route::get('/logout', 'AuthenticationController@logout')->name('authentication.logout');
});