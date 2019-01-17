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

Route::resource('comment', 'CommentsController');

Route::get('/user/register', 'UserController@register');
Route::get('/user/login', 'UserController@login');
Route::get('/user/avatar', 'UserController@avatar');
Route::post('/user/login', 'UserController@signin');
Route::post('/user/register', 'UserController@store');
Route::post('/avatar', 'UserController@changeAvatar');
Route::post('/crop/api', 'UserController@cropAvatar');

Route::post('/post/upload', 'PostController@upload');

Route::get('/logout', 'UserController@logout');

Route::get('/verify/{confirm_code}', 'UserController@confirmEmail');

