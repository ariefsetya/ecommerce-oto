<?php namespace App\Http\Controllers;

use Auth;
use \App\Http\Controllers\APIController\API as API;
class GuestController extends Controller {

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
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function store_detail($id)
	{
		$data['show'] = 1;
		$data['id_u'] = \App\Kios::find($id)['id_user'];
		$data['bret'] = "Store";
		$data['name'] = \App\Kios::find($id)['name'];
		$data['brer'] = "store";
		$data['data'] = \App\Product::where('id_user',$data['id_u'])->where('id_kios',$id)->where('status',0)->paginate(10);
		return view('ads/lists')->with($data);
	}
	public function ad_detail($id)
	{
		$data['deta'] = \App\Product::where('slug',$id)->first();
		$data['name'] = $data['deta']->name;
		$data['bret'] = \App\Kios::find(\App\Product::find($data['deta']->id)['id_kios'])['name'];
		$data['brer'] = "store_detail";
		$data['kios'] = \App\Kios::find($data['deta']->id_kios);
		return view('ads.ad')->with($data);
	}
	public function services()
	{
		return view('product.lists');
	}
	public function motorcycles()
	{
		return view('product.lists');
	}
	public function cars()
	{
		return view('product.lists');
	}
	public function accessories()
	{
		return view('product.lists');
	}

	public function get_ongkir()
	{
		$data = []; //inisiasi array
		$data['origin'] = 154; //Jakarta Timur, DKI Jakarta
		$data['destination'] = 501; //Yogyakarta, DI Yogyakarta
		$data['weight'] = 1000; //berat kiriman
		$data['courier'] = 'jne'; //kurir: jne,pos,tiki

		//inisiasi class API
		$api = new API;
		//pakai post, aturan baku dari rajaongkir
		$hasil = $api->getCURL('starter/cost',$data,'post'); 
		//tampilkan hasil
		echo json_encode($hasil);
	}
}
