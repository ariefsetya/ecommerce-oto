<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Input;
class AdsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function ads_published()
	{
		$data['bret'] = "Ads";
		$data['name'] = "Published Ads";
		$data['brer'] = "ads";
		$data['data'] = \App\Product::where('id_user',Auth::user()->id)->get();
		return view('ads/lists')->with($data);
	}
	public function ads_create()
	{	
		$data['num_foto'] = 4;
		$data['bret'] = "Ads";
		$data['name'] = "Create New Ad";
		$data['brer'] = "ads";
		return view('ads/create')->with($data);
	}
	public function ads_save()
	{
		dd(Input::all());
		$ad = new \App\Product;
		$ad->name = Input::get('title');
		$ad->description = Input::get('description');
		$ad->description = Input::get('description');
	}

}
