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

Route::get('/', 'TagController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::post('/event/{id}/signup', 'EventController@signup');
Route::get('/event/{id}/cancel', 'EventController@cancel');
Route::resource('/event', 'EventController');
Route::resource('/user', 'UserController');
Route::resource('/message', 'MessageController');
Route::get('/tag/{id}','TagController@show');
Route::post('/tag/{id}', 'TagController@alter');
