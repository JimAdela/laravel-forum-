<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PostController@index');
Route::resource('discussions', 'PostController');
Route::get('/user/register', 'UserController@register');
Route::get('/user/login', 'UserController@login');
Route::post('/user/login', 'UserController@signin');
Route::get('/verify/{confirm_code}', 'UserController@confirmEmail');
Route::post('/user/register', 'UserController@store');
Route::get('/logout', 'UserController@logout');

