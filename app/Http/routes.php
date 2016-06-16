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


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/', 'WelcomeController@index');
Route::get('cronGetProvince', 'CronController@cronGetProvince');
Route::get('cronGetCity', 'CronController@cronGetCity');

Route::get('home', 'HomeController@index');
Route::get('services', ['as'=>'services_pilar','uses'=>'HomeController@services']);
Route::get('motorcycles', ['as'=>'motorcycles_pilar','uses'=>'HomeController@motorcycles']);
Route::get('cars', ['as'=>'cars_pilar','uses'=>'HomeController@cars']);
Route::get('trucks', ['as'=>'trucks_pilar','uses'=>'HomeController@trucks']);