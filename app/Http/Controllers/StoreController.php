<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Input;
class StoreController extends Controller {

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

	public function store()
	{
		$data['num_store'] = sizeof(\App\Kios::where('id_user',Auth::user()->id)->get());
		$data['show'] = 0;
		$data['id_u'] = Auth::user()->id;
		$data['bret'] = "Store";
		$data['name'] = "Home";
		$data['brer'] = "store";
		return view('store.home')->with($data);
	}
	public function store_published()
	{
		$data['bret'] = "Store";
		$data['name'] = "Published Store";
		$data['brer'] = "store";
		$data['data'] = \App\Kios::where('id_user',Auth::user()->id)->get();
		return view('store/published')->with($data);
	}
	public function store_create()
	{	
		$data['num_foto'] = 1;
		$data['bret'] = "Store";
		$data['name'] = "Create New Store";
		$data['brer'] = "store";
		$data['setup'] = 0;
		return view('store/create')->with($data);
	}
	public function f_save_store()
	{
		$st = new \App\Kios;
		$st->name = Input::get('title');
		$st->description = Input::get('description');
		$st->id_province = Input::get('id_province');
		$st->id_city = Input::get('id_city');
		$st->address = Input::get('address');
		$st->save();

		$id = 0;
		for($i=0;$i<sizeof(Input::get('image_name'));$i++){
			if(Input::get('image_name')[$i]!=""){
				$img = new \App\Image;
				$img->image_type = 'url';
				$img->id_user = Auth::user()->id;
				$img->image = Input::get('image_name')[$i];
				$img->code = $st->id;
				$img->used_for = 'kios_photo';
				$img->description = "Photo of ".$st->name;
				$img->name = $st->name;
				$img->save();
				$id = $img->id;
			}
		}
		$st->phone = Input::get('phone');
		$st->bbm = Input::get('bbm');
		$st->accept_wa = Input::get('accept_wa');
		$st->photo = $id;
		$st->status = 'first';
		$st->id_user = Auth::user()->id;
		$st->confirmed = 0;
		$st->code = "OTO-".date("ymd").$id.$st->id;
		$st->save();
	}
	public function store_save()
	{
		//dd(Input::all());
		$this->f_save_store();

		return redirect(route('store_published'));
	}
	public function setup_store()
	{	
		$data['num_foto'] = 1;
		$data['bret'] = "Store";
		$data['name'] = "Create New Store";
		$data['brer'] = "store";
		$data['setup'] = 1;
		return view('store.create')->with($data);
	}
	public function setup_store_save()
	{
		$this->f_save_store();

		return redirect(route('account'));
	}

}
