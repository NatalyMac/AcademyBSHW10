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

Route::get('/', 'HomeController@index');

Route::resource('api/users', 'UserController');
Route::resource('api/books', 'BookController');

Route::resource('api/users.books', 'UserBookController', ['only'=>['index', 'update', 'destroy']]);

