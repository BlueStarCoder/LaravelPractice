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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth'], function() {
	Route::get('register', ['as' => 'get_register', 'uses' => 'Auth\AuthController@getRegister']);

	Route::post('register', ['as' => 'post_register', 'uses' => 'Auth\AuthController@postRegister']);

	Route::get('login', ['as' => 'get_login', 'uses' => 'Auth\AuthController@getLogin']);

	Route::post('login', ['as' => 'post_login', 'uses' => 'Auth\AuthController@postLogin']);

	Route::get('logout', ['as' => 'get_logout', 'uses' => 'Auth\AuthController@getLogout']);
});