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
//cron

Route::get('vauth/logout','HomeController@logout');

Route::get('/', 'WelcomeController@index');
Route::get('cronGetProvince', 'CronController@cronGetProvince');
Route::get('cronGetCity', 'CronController@cronGetCity');
Route::get('get_ongkir', 'GuestController@get_ongkir');
Route::get('view_uniq', function()
{
	echo \Session::get('uniqid');
});

//master ajaxes
Route::post('ajax/get_city_province_id',['as'=>'get_city_province_id','uses'=>'AjaxController@get_city_province_id']);
Route::post('ajax/get_make_id',['as'=>'get_make_id','uses'=>'AjaxController@get_make_id']);
Route::post('ajax/get_model_id',['as'=>'get_model_id','uses'=>'AjaxController@get_model_id']);
Route::post('ajax/get_product_id_kios',['as'=>'get_product_id_kios','uses'=>'AjaxController@get_product_id_kios']);
Route::post('ajax/get_product_id',['as'=>'get_product_id','uses'=>'AjaxController@get_product_id']);
Route::post('ajax/chat_set_data',['as'=>'chat_set_data','uses'=>'AjaxController@chat_set_data']);
Route::post('ajax/chat_send',['as'=>'chat_send','uses'=>'AjaxController@chat_send']);
Route::post('ajax/m_chat_send',['as'=>'m_chat_send','uses'=>'AjaxController@m_chat_send']);
Route::post('ajax/active_chat',['as'=>'active_chat','uses'=>'AjaxController@active_chat']);

Route::get('home', 'WelcomeController@index');
//pilars
Route::get('categories', ['as'=>'pilars','uses'=>'GuestController@pilars']);
Route::get('services/{q?}/{r?}/{s?}/{t?}/{u?}', ['as'=>'services_pilar','uses'=>'GuestController@services']);
Route::get('motorcycles/{q?}/{r?}/{s?}/{t?}/{u?}', ['as'=>'motorcycles_pilar','uses'=>'GuestController@motorcycles']);
Route::get('cars/{q?}/{r?}/{s?}/{t?}/{u?}', ['as'=>'cars_pilar','uses'=>'GuestController@cars']);
Route::get('accessories/{q?}/{r?}/{s?}/{t?}/{u?}', ['as'=>'accessories_pilar','uses'=>'GuestController@accessories']);
Route::get('store/detail/{id}', ['as'=>'store_detail','uses'=>'GuestController@store_detail']);

Route::post('post_search',['as'=>'post_search','uses'=>'GuestController@post_search']);
Route::post('parseURI',['as'=>'parseURI','uses'=>'GuestController@parseURI']);
Route::post('feedback_save',['as'=>'feedback_save','uses'=>'GuestController@feedback_save']);
Route::get('feedback_done',['as'=>'feedback_done','uses'=>'GuestController@feedback_done']);

//account
Route::get('account/settings', ['as'=>'account_settings','uses'=>'HomeController@account_settings']);
Route::post('account/update', ['as'=>'account_update','uses'=>'HomeController@account_update']);
Route::get('account', ['as'=>'account','uses'=>'HomeController@account']);
Route::get('account/messaging', ['as'=>'messaging','uses'=>'HomeController@messaging']);

//ads
Route::get('ads', ['as'=>'ads','uses'=>'AdsController@ads_home']);
Route::get('ads/create', ['as'=>'ads_create','uses'=>'AdsController@ads_create']);
Route::get('ads/edit/{id?}', ['as'=>'ads_edit','uses'=>'AdsController@ads_edit']);
Route::get('ads/delete/{id?}', ['as'=>'ads_delete','uses'=>'AdsController@ads_delete']);
Route::post('ads/save', ['as'=>'ads_save','uses'=>'AdsController@ads_save']);
Route::post('ads/update', ['as'=>'ads_update','uses'=>'AdsController@ads_update']);
Route::get('ads/published', ['as'=>'ads_published','uses'=>'AdsController@ads_published']);
Route::get('ads/moderation', ['as'=>'ads_moderation','uses'=>'AdsController@ads_moderation']);
Route::get('ads/declined', ['as'=>'ads_declined','uses'=>'AdsController@ads_declined']);

//promotions
Route::get('promotion', ['as'=>'promotion','uses'=>'AdsController@promotion']);
Route::get('promotion/create', ['as'=>'promotion_create','uses'=>'AdsController@promotion_create']);
Route::post('promotion/save', ['as'=>'promotion_save','uses'=>'AdsController@promotion_save']);
Route::get('promotion/published', ['as'=>'promotion_published','uses'=>'AdsController@promotion_published']);
Route::get('promotion/requested', ['as'=>'promotion_requested','uses'=>'AdsController@promotion_requested']);
Route::get('promotion/declined', ['as'=>'promotion_declined','uses'=>'AdsController@promotion_declined']);

//store
Route::get('store', ['as'=>'store','uses'=>'StoreController@store']);
Route::get('store/create', ['as'=>'store_create','uses'=>'StoreController@store_create']);
Route::post('store/save', ['as'=>'store_save','uses'=>'StoreController@store_save']);
Route::get('store/published', ['as'=>'store_published','uses'=>'StoreController@store_published']);
Route::get('setup/store', ['as'=>'setup_store','uses'=>'StoreController@setup_store']);
Route::post('setup/store/save', ['as'=>'setup_store_save','uses'=>'StoreController@setup_store_save']);

Route::get('{ads_id}', ['as'=>'ad_detail','uses'=>'GuestController@ad_detail']);
Route::get('{ads_id}/download', ['as'=>'ads_download','uses'=>'GuestController@ads_download']);