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
		$data['data'] = \App\Product::where('id_user',Auth::user()->id)->where('status',1)->paginate(10);
		return view('ads/lists')->with($data);
	}
	public function ads_moderation()
	{
		$data['bret'] = "Ads";
		$data['name'] = "Moderation Ads";
		$data['brer'] = "ads";
		$data['data'] = \App\Product::where('id_user',Auth::user()->id)->where('status',0)->paginate(10);
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
		//dd(Input::all());
		$ad = new \App\Product;
		$ad->name = Input::get('title');
		$ad->description = Input::get('description');
		$ad->id_pilar = Input::get('category');
		$ad->id_kios = Input::get('id_kios');
		$ad->id_user = Auth::user()->id;
		$ad->save();

		$pcma = new \App\ProductCategory;
		$pcma->id_product = $ad->id;
		$pcma->id_kategori = \App\JKategori::where('code','make')->first()['id'];
		if(Input::get('make')=="add_new"){
			$nk = new \App\Kategori;
			$nk->id_induk = Input::get('category');
			$nk->id_jenis = \App\JKategori::where('code','make')->first()['id'];
			$nk->name = Input::get('new_make');
			$nk->image = 0;
			$nk->status = 'pending';
			$nk->description = 'Category Make '.Input::get('new_make');
			$nk->save();
			$pcma->value = $nk->id;
		}else{
			$pcma->value = Input::get('make');
		}
		$pcma->save();

		$pcmo = new \App\ProductCategory;
		$pcmo->id_product = $ad->id;
		$pcmo->id_kategori = \App\JKategori::where('code','model')->first()['id'];
		if(Input::get('model')=="add_new"){
			$nk = new \App\Kategori;
			$nk->id_induk = $pcma->value;
			$nk->id_jenis = \App\JKategori::where('code','model')->first()['id'];
			$nk->name = Input::get('new_model');
			$nk->image = 0;
			$nk->status = 'pending';
			$nk->description = 'Category Make '.Input::get('new_model');
			$nk->save();
			$pcmo->value = $nk->id;
		}else{
			$pcmo->value = Input::get('model');
		}
		$pcmo->save();

		$pcec = new \App\ProductCategory;
		$pcec->id_product = $ad->id;
		$pcec->id_kategori = \App\JKategori::where('code','exterior_color')->first()['id'];
		$pcec->value = Input::get('exterior_color');
		$pcec->save();

		$pces = new \App\ProductCategory;
		$pces->id_product = $ad->id;
		$pces->id_kategori = \App\JKategori::where('code','engine_size')->first()['id'];
		$pces->value = Input::get('engine_size');
		$pces->save();

		for($i=0;$i<sizeof(Input::get('image_name'));$i++){
			if(Input::get('image_name')[$i]!=""){
				$im = new \App\Image;
				$im->id_user = Auth::user()->id;
				$im->image_type = 'url';
				$im->image = Input::get('image_name')[$i];
				$im->name = $ad->name." ".$i." ".uniqid();
				$im->name = "Image for ".$ad->name." ".$i;
				$im->code = "product-".$ad->id;
				$im->used_for = 'product_images';
				$im->save();
			}
		}

		return redirect(route('ads_moderation'));
	}
	public function ads_detail($ads_id)
	{
		
	}

}
