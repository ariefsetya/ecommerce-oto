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
Route::get('get_ongkir', 'GuestController@get_ongkir');

Route::get('home', 'WelcomeController@index');
//pilars
Route::get('services', ['as'=>'services_pilar','uses'=>'GuestController@services']);
Route::get('motorcycles', ['as'=>'motorcycles_pilar','uses'=>'GuestController@motorcycles']);
Route::get('cars', ['as'=>'cars_pilar','uses'=>'GuestController@cars']);
Route::get('trucks', ['as'=>'trucks_pilar','uses'=>'GuestController@trucks']);

//account
Route::get('account/settings', ['as'=>'account_settings','uses'=>'HomeController@account_settings']);
Route::get('account', ['as'=>'account','uses'=>'HomeController@account']);

//ads
Route::get('ads', ['as'=>'ads','uses'=>'AdsController@ads_home']);
Route::get('ads/create', ['as'=>'ads_create','uses'=>'AdsController@ads_create']);
Route::get('ads/published', ['as'=>'ads_published','uses'=>'AdsController@ads_published']);
Route::get('ads/moderation', ['as'=>'ads_moderation','uses'=>'AdsController@ads_moderation']);
Route::get('ads/declined', ['as'=>'ads_declined','uses'=>'AdsController@ads_declined']);

//promotions
Route::get('promotion', ['as'=>'promotion','uses'=>'AdsController@promotion']);
Route::get('promotion/create', ['as'=>'promotion_create','uses'=>'AdsController@promotion_create']);
Route::get('promotion/published', ['as'=>'promotion_published','uses'=>'AdsController@promotion_published']);
Route::get('promotion/requested', ['as'=>'promotion_requested','uses'=>'AdsController@promotion_requested']);
Route::get('promotion/declined', ['as'=>'promotion_declined','uses'=>'AdsController@promotion_declined']);