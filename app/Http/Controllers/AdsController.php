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

	public function ads_home()
	{
		$data['num_product'] = sizeof(\App\Product::where('id_user',Auth::user()->id)->get());
		$data['num_store'] = sizeof(\App\Kios::where('id_user',Auth::user()->id)->get());
		$data['num_product_moderate'] = sizeof(\App\Product::where('status',0)->where('id_user',Auth::user()->id)->get());
		$data['num_product_approved'] = sizeof(\App\Product::where('status',1)->where('id_user',Auth::user()->id)->get());
		$data['num_product_declined'] = sizeof(\App\Product::where('status',2)->where('id_user',Auth::user()->id)->get());
		$data['show'] = 0;
		$data['id_u'] = Auth::user()->id;
		$data['bret'] = "Ads";
		$data['name'] = "Summary";
		$data['brer'] = "ads";
		return view('ads.home')->with($data);
	}

	public function ads_published()
	{
		$data['show'] = 1;
		$data['id_u'] = Auth::user()->id;
		$data['bret'] = "Ads";
		$data['name'] = "Published Ads";
		$data['brer'] = "ads";
		$data['data'] = \App\Product::where('id_user',Auth::user()->id)->where('status',1)->paginate(10);
		return view('ads/lists')->with($data);
	}
	public function ads_moderation()
	{
		$data['show'] = 0;
		$data['id_u'] = Auth::user()->id;
		$data['bret'] = "Ads";
		$data['name'] = "Moderation Ads";
		$data['brer'] = "ads";
		$data['data'] = \App\Product::where('id_user',Auth::user()->id)->where('status',0)->paginate(10);
		return view('ads/lists')->with($data);
	}
	public function ads_declined()
	{
		$data['show'] = 0;
		$data['id_u'] = Auth::user()->id;
		$data['bret'] = "Ads";
		$data['name'] = "Declined Ads";
		$data['brer'] = "ads";
		$data['data'] = \App\Product::where('id_user',Auth::user()->id)->where('status',2)->paginate(10);
		return view('ads/lists')->with($data);
	}
	public function ads_create()
	{	
		if(sizeof(\App\Kios::where('id_user',Auth::user()->id)->get())==0){
			return redirect(route('setup_store'));
		}
		$data['num_foto'] = 4;
		$data['bret'] = "Ads";
		$data['name'] = "Create New Ad";
		$data['brer'] = "ads";
		return view('ads/create')->with($data);
	}	
	public function promotion_create()
	{	
		if(sizeof(\App\Kios::where('id_user',Auth::user()->id)->get())==0){
			return redirect(route('setup_store'));
		}
		if(sizeof(\App\Product::where('id_user',Auth::user()->id)->get())==0){
			return redirect(route('ads_create'));
		}
		$data['num_foto'] = 4;
		$data['bret'] = "Ads";
		$data['name'] = "Create New Promotion";
		$data['brer'] = "ads";
		return view('promotion/create')->with($data);
	}
	public function ads_edit($id)
	{	
		if(sizeof(\App\Kios::where('id_user',Auth::user()->id)->get())==0){
			return redirect(route('setup_store'));
		}
		if(\App\Product::find($id)['id_user']!=Auth::user()->id){
			return redirect(route('ads'));
		}
		$data['num_foto'] = 4;
		$data['bret'] = "Ads";
		$data['name'] = "Edit Ad";
		$data['brer'] = "ads";
		$data['deta'] = \App\Product::find($id);
		$data['foto'] = \App\Image::where('code','product-'.$id)->get();
		return view('ads/edit')->with($data);
	}
	public function ads_save()
	{
		//dd(Input::all());

		if(Input::get('id')!==null){
			$this->ads_delete(Input::get('id'));
		}

		$addon = sizeof(explode("-", Input::get('category')))==2?explode("-", Input::get('category'))[1]:0;
		$ad = new \App\Product;
		$ad->name = Input::get('title');
		$ad->description = Input::get('description');
		$ad->id_pilar = Input::get('category');
		$ad->pilar_addon = $addon;
		$ad->price = str_replace(array(".",","),"",Input::get('price'));
		$ad->id_kios = Input::get('id_kios');
		$ad->id_user = Auth::user()->id;
		$ad->slug = str_slug(Input::get('title'))."-".Auth::user()->id."-".uniqid();
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

		$pcec = new \App\ProductCategory;
		$pcec->id_product = $ad->id;
		$pcec->id_kategori = \App\JKategori::where('code','condition')->first()['id'];
		$pcec->value = Input::get('condition');
		$pcec->save();

		$pces = new \App\ProductCategory;
		$pces->id_product = $ad->id;
		$pces->id_kategori = \App\JKategori::where('code','engine_size')->first()['id'];
		$pces->value = Input::get('engine_size');
		$pces->save();

		$pces = new \App\ProductCategory;
		$pces->id_product = $ad->id;
		$pces->id_kategori = \App\JKategori::where('code','year')->first()['id'];
		$pces->value = Input::get('year');
		$pces->save();

		$pces = new \App\ProductCategory;
		$pces->id_product = $ad->id;
		$pces->id_kategori = \App\JKategori::where('code','part')->first()['id'];
		$pces->value = Input::get('part');
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
	public function ads_delete($value)
	{
		$a = \App\Product::find($value);
		$a->status = 4;
		$a->save();

		return redirect(route('ads_published'));
	}
	public function promotion_save()
	{
		$a = \App\Product::where('id',Input::get('product'))->where('id_kios',Input::get('kios'))->where('status',1)->where('promo',0)->first();
		$a->promo = 1;//request for promo
		$a->promotion_type = Input::get('type');
		if($a->promotion_type=="percent"){
		$a->discount = str_replace("%", "", Input::get('percent'));
		}else{
		$a->discount = str_replace(array('.',','), "", Input::get('price'));
		}
		$a->promotion_text = Input::get('promotion_text');
		$a->new_price = Input::get('new_price');
		$a->save();

		return redirect(route('promotion'));
	}
	public function promotion_requested()
	{
		$data['show'] = 0;
		$data['data'] = \App\Product::where('promo',1)->where('status',1)->paginate(10);
		$data['name'] = "Requested";
		$data['bret'] = "Promotion";
		$data['brer'] = "promotion";

		return view('promotion.lists')->with($data);
	}

	public function promotion_declined()
	{
		$data['show'] = 0;
		$data['id_u'] = Auth::user()->id;
		$data['data'] = \App\Product::where('promo',3)->where('status',1)->paginate(10);
		$data['name'] = "Declined";
		$data['bret'] = "Promotion";
		$data['brer'] = "promotion";

		return view('promotion.lists')->with($data);
	}
	public function promotion_published()
	{
		$data['show'] = 0;
		$data['id_u'] = Auth::user()->id;
		$data['data'] = \App\Product::where('promo',2)->where('status',1)->paginate(10);
		$data['name'] = "Published";
		$data['bret'] = "Promotion";
		$data['brer'] = "promotion";

		return view('promotion.lists')->with($data);
	}
	public function promotion()
	{
		$data['num_product'] = sizeof(\App\Product::where('id_user',Auth::user()->id)->where('status',1)->where('promo','<>',0)->get());
		$data['num_store'] = sizeof(\App\Kios::where('id_user',Auth::user()->id)->get());
		$data['num_product_moderate'] = sizeof(\App\Product::where('status',1)->where('id_user',Auth::user()->id)->where('promo',1)->get());
		$data['num_product_approved'] = sizeof(\App\Product::where('status',1)->where('id_user',Auth::user()->id)->where('promo',2)->get());
		$data['num_product_declined'] = sizeof(\App\Product::where('status',1)->where('id_user',Auth::user()->id)->where('promo',3)->get());
		$data['show'] = 0;
		$data['id_u'] = Auth::user()->id;
		$data['bret'] = "Promotion";
		$data['name'] = "Summary";
		$data['brer'] = "promotion";
		return view('promotion.home')->with($data);
	}
}
