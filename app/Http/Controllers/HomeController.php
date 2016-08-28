<?php namespace App\Http\Controllers;

use Auth;

use Illuminate\Support\Facades\Input;
class HomeController extends Controller {

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

	public function logout()
	{
		$a = \App\User::find(Auth::user()->id);
		$a->active_chat = "Offline";
		$a->save();

		Auth::logout();

		return redirect(url('/'));
	}
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function account()
	{
		$data['name'] = "Account";
		$data['num_store'] = sizeof(\App\Kios::where('id_user',Auth::user()->id)->get());
		$data['num_product'] = sizeof(\App\Product::where('id_user',Auth::user()->id)->whereIn('status',array(0,1,2,3))->get());
		$data['data'] = \App\Kios::where('id_user',Auth::user()->id)->get();
		
		return view('account/home')->with($data);
	}
	public function account_settings()
	{		
		$data['bret'] = "Account";
		$data['name'] = "Settings";
		$data['brer'] = "account";
		$data['user'] = \App\User::find(Auth::user()->id);
		$data['img'] = \App\Image::where('id_user',$data['user']->id)->where('code','profile')->where('used_for','profile_picture')->orderBy('id','desc')->first()['image'];
		$data['img'] = ($data['img']!="")?url('uploads/'.$data['img']):$data['img'];
		return view('account.settings')->with($data);
	}
	public function account_update()
	{
		$data = Input::all();

		$im = new \App\Image;
		$im->used_for = "profile_picture";
		$im->code = "profile";
		$im->image_type = "url";
		$im->image = $data['image_name'];
		$im->id_user = Auth::user()->id;
		$im->save();

		$a = \App\User::find(Auth::user()->id);
		$a->name = $data['name'];
		$a->email = $data['email'];
		$a->phone = $data['phone'];
		$a->active_chat = $data['active_chat'];
		$a->save();

		return redirect(route('account'));
	}

	public function messaging()
	{
		$data['user'] = \App\User::find(Auth::user()->id);
		return view('messaging.message')->with($data);
	}

}
