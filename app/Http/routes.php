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
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', 'WelcomeController@getIndex');

//HOME ROUTE
Route::get('/', 'HomeController@getIndex');
Route::post('/search','HomeController@postIndex');


//REGISTRATION ROUTE
Route::controller('users', 'UsersController');
	Route::get('/registration', 'UsersController@getRegistration');
	Route::post('/validate', 'UsersController@getValidate');
