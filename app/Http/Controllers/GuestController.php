<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Input;
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

	public function pilars()
	{
		$data['pilar'] = \App\Pilar::all();
		return view('ads.pilars')->with($data);
	}
	public function store_detail($id)
	{
		$data['show'] = 1;
		$data['id_p'] = 0;
		$data['id_u'] = \App\Kios::find($id)['id_user'];
		$data['bret'] = "Store";
		$data['name'] = \App\Kios::find($id)['name'];
		$data['brer'] = "store";
		$data['data'] = \App\Product::where('id_user',$data['id_u'])->where('id_kios',$id)->where('status',1)->paginate(10);
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
	public function ads_download($id)
	{
		$data['deta'] = \App\Product::where('slug',$id)->first();
		$data['name'] = $data['deta']->name;
		$data['bret'] = \App\Kios::find(\App\Product::find($data['deta']->id)['id_kios'])['name'];
		$data['brer'] = "store_detail";
		$data['kios'] = \App\Kios::find($data['deta']->id_kios);
		$pdf = \PDF::loadView('ads.download', $data);
		return $pdf->stream();
		return view('ads.download')->with($data);
	}
	public function post_search()
	{
		$q = Input::get('city');
		$r = Input::get('pilar');
		$s = Input::get('query');
		if($s==""){
			$s = "_";
		}

		$place = "";

		if(explode("-", $q)[1]=="0"){
			$q = explode("-", $q)[0];
			$q = "Provinsi ".\App\Province::find($q)['nama'];
		}else{
			$q = explode("-", $q)[0];
			$q = \App\City::find($q)['type']." ".\App\City::find($q)['nama'];
		}

		$pilar = \App\Pilar::find($r)['code'];

		return redirect(route($pilar,[$q,$s]));
	}	
	public function parseURI()
	{
		$q = Input::get('city');
		$r = Input::get('pilar');
		$s = Input::get('query');
		if($s==""){
			$s = "_";
		}

		$place = "";

		if(explode("-", $q)[1]=="0"){
			$q = explode("-", $q)[0];
			$q = "Provinsi ".\App\Province::find($q)['nama'];
		}else{
			$q = explode("-", $q)[0];
			$q = \App\City::find($q)['type']." ".\App\City::find($q)['nama'];
		}

		$pilar = \App\Pilar::find($r)['code'];

		$price_min = Input::get('min_price');
		$t = (int)$price_min;
		$price_max = Input::get('max_price');
		$u = (int)$price_max;

		$make = Input::get('make');
		$v = \App\Kategori::where('id_jenis',\App\JKategori::where('code','make')->first()['id'])->where('id',$make)->first()['name'];

		if($make=="All"){
			$v = '_'; 
		}

		$postable = $this->postable($pilar,$q,$s,$t,$u,$v);
		$html = $postable['html'];
		$data = $postable['data'];

		echo json_encode(array("url"=>route($pilar,[$q,$s,$t,$u,$v]),'html'=>$html,'data'=>$data));
	}
	public function services($place="",$where="",$price_min="",$price_max="",$make="")
	{
		if($where=="_"){
			$where = "";
		}
		if($make==""){
			$make = "_";
		}
		if($make !="_"){
			$make = \App\Kategori::where('name',$make)->first()['id'];
		}

		if(substr($place, 0,8)=="Provinsi"){
			$data['place'] = ($place!="")?\App\Province::where('nama',str_replace("Provinsi ","",$place))->first()['id']."-0":0;
		}else{
			$data['place'] = ($place!="")?\App\City::whereRaw('concat(type," ",nama)="'.$place.'"')->first()['id']."-1":0;
		}
		$data['show'] = 1;
		$data['make'] = $make;
		$data['price_min'] = $price_min;
		$data['price_max'] = $price_max;
		$data['id_p'] = \App\Pilar::where('code','services_pilar')->first()['id'];
		$data['data'] = \App\Product::with(['kios','product_categories'])->whereHas('kios',function($q) use ($data,$place){ if($place!=""){if(explode('-',$data['place'])[1]=="0"){$q->where('id_province',explode("-",$data['place'])[0]);}else{$q->where('id_city',explode("-",$data['place'])[0]);}}})->where('id_pilar',\App\Pilar::where('code','services_pilar')->first()['id'])->where('status',1)->whereHas('product_categories',function($r) use ($make)
		{	
			if($make!="_"){
				$r->where('id_kategori',\App\JKategori::where('code','make')->first()['id']);
				$r->where('value',$make);
			}	
		})->where(function($q) use ($where,$price_min,$price_max)
		{
			if($where!="_"){
				$q->where('name','like','%'.$where.'%');
			}	
			if($price_min>0 and $price_max > 0){
				$q->whereRaw('new_price BETWEEN '.$price_min.' AND '.$price_max);
			}
		})->paginate(10);	
		$data['name'] = "Services";
		$data['bret'] = "Ads";
		$data['brer'] = "pilars";
		$data['query'] = $where;
		return view('product.lists')->with($data);
	}
	public function postable($pilar="",$place="",$where="",$price_min=0,$price_max=0,$make="")
	{
		//dd(array($pilar,$place,$where,$price_min,$price_max,$make));
		$pilar = \App\Pilar::where('code',$pilar)->first()['id'];
		if($make !="_"){
			$make = \App\Kategori::where('name',$make)->first()['id'];
		}
		if($where=="_"){
			$where = "";
		}
		if(substr($place, 0,8)=="Provinsi"){
			$data['place'] = ($place!="")?\App\Province::where('nama',str_replace("Provinsi ","",$place))->first()['id']."-0":0;
		}else{
			$data['place'] = ($place!="")?\App\City::whereRaw('concat(type," ",nama)="'.$place.'"')->first()['id']."-1":0;
		}
		$data['show'] = 1;
		$data['id_p'] = $pilar;
		$data['data'] = \App\Product::with(['kios','product_categories'])->whereHas('kios',function($q) use ($data,$place){ if($place!=""){if(explode('-',$data['place'])[1]=="0"){$q->where('id_province',explode("-",$data['place'])[0]);}else{$q->where('id_city',explode("-",$data['place'])[0]);}}})->where('id_pilar',$pilar)->where('status',1)->whereHas('product_categories',function($r) use ($make)
		{
			if($make!="_"){
				$r->where('id_kategori',\App\JKategori::where('code','make')->first()['id']);
				$r->where('value',$make);
			}	
		})->where(function($q) use ($where,$price_min,$price_max)
		{
			if($where!="_"){
				$q->where('name','like','%'.$where.'%');
			}	
			if($price_min>0 and $price_max > 0){
				$q->whereRaw('new_price BETWEEN '.$price_min.' AND '.$price_max);
			}
		})->paginate(10);
		// dd($data);
		$data['name'] = "Services";
		$data['bret'] = "Ads";
		$data['brer'] = "pilars";
		$data['query'] = $where;
		return array('html'=>view('product.listsable')->with($data)->render(),'data'=>sizeof($data['data']));
	}
	public function motorcycles($place="",$where="",$price_min="",$price_max="",$make="")
	{
		if($where=="_"){
			$where = "";
		}
		if($make==""){
			$make = "_";
		}
		if($make !="_"){
			$make = \App\Kategori::where('name',$make)->first()['id'];
		}
		if(substr($place, 0,8)=="Provinsi"){
			$data['place'] = ($place!="")?\App\Province::where('nama',str_replace("Provinsi ","",$place))->first()['id']."-0":0;
		}else{
			$data['place'] = ($place!="")?\App\City::whereRaw('concat(type," ",nama)="'.$place.'"')->first()['id']."-1":0;
		}
		$data['show'] = 1;
		$data['make'] = $make;
		$data['price_min'] = $price_min;
		$data['price_max'] = $price_max;
		$data['id_p'] = \App\Pilar::where('code','motorcycles_pilar')->first()['id'];
		$data['data'] = \App\Product::with(['kios','product_categories'])->whereHas('kios',function($q) use ($data,$place){ if($place!=""){if(explode('-',$data['place'])[1]=="0"){$q->where('id_province',explode("-",$data['place'])[0]);}else{$q->where('id_city',explode("-",$data['place'])[0]);}}})->where('id_pilar',\App\Pilar::where('code','motorcycles_pilar')->first()['id'])->where('status',1)->whereHas('product_categories',function($r) use ($make)
		{	
			if($make!="_"){
				$r->where('id_kategori',\App\JKategori::where('code','make')->first()['id']);
				$r->where('value',$make);
			}	
		})->where(function($q) use ($where,$price_min,$price_max)
		{
			if($where!="_"){
				$q->where('name','like','%'.$where.'%');
			}	
			if($price_min>0 and $price_max > 0){
				$q->whereRaw('new_price BETWEEN '.$price_min.' AND '.$price_max);
			}
		})->paginate(10);
		$data['name'] = "Motorcycles";
		$data['bret'] = "Ads";
		$data['brer'] = "pilars";
		$data['query'] = $where;
		return view('product.lists')->with($data);
	}
	public function cars($place="",$where="",$price_min="",$price_max="",$make="")
	{
		if($where=="_"){
			$where = "";
		}
		if($make==""){
			$make = "_";
		}
		if($make !="_"){
			$make = \App\Kategori::where('name',$make)->first()['id'];
		}
		if(substr($place, 0,8)=="Provinsi"){
			$data['place'] = ($place!="")?\App\Province::where('nama',str_replace("Provinsi ","",$place))->first()['id']."-0":0;
		}else{
			$data['place'] = ($place!="")?\App\City::whereRaw('concat(type," ",nama)="'.$place.'"')->first()['id']."-1":0;
		}
		$data['show'] = 1;
		$data['make'] = $make;
		$data['price_min'] = $price_min;
		$data['price_max'] = $price_max;
		$data['id_p'] = \App\Pilar::where('code','cars_pilar')->first()['id'];
		$data['data'] = \App\Product::with(['kios','product_categories'])->whereHas('kios',function($q) use ($data,$place){ if($place!=""){if(explode('-',$data['place'])[1]=="0"){$q->where('id_province',explode("-",$data['place'])[0]);}else{$q->where('id_city',explode("-",$data['place'])[0]);}}})->where('id_pilar',\App\Pilar::where('code','cars_pilar')->first()['id'])->where('status',1)->whereHas('product_categories',function($r) use ($make)
		{	
			if($make!="_"){
				$r->where('id_kategori',\App\JKategori::where('code','make')->first()['id']);
				$r->where('value',$make);
			}	
		})->where(function($q) use ($where,$price_min,$price_max)
		{
			if($where!="_"){
				$q->where('name','like','%'.$where.'%');
			}	
			if($price_min>0 and $price_max > 0){
				$q->whereRaw('new_price BETWEEN '.$price_min.' AND '.$price_max);
			}
		})->paginate(10);		
		$data['name'] = "Cars";
		$data['bret'] = "Ads";
		$data['brer'] = "pilars";
		$data['query'] = $where;
		return view('product.lists')->with($data);
	}
	public function accessories($place="",$where="",$price_min="",$price_max="",$make="")
	{
		if($where=="_"){
			$where = "";
		}
		if($make==""){
			$make = "_";
		}
		if($make !="_"){
			$make = \App\Kategori::where('name',$make)->first()['id'];
		}
		if(substr($place, 0,8)=="Provinsi"){
			$data['place'] = ($place!="")?\App\Province::where('nama',str_replace("Provinsi ","",$place))->first()['id']."-0":0;
		}else{
			$data['place'] = ($place!="")?\App\City::whereRaw('concat(type," ",nama)="'.$place.'"')->first()['id']."-1":0;
		}
		$data['show'] = 1;
		$data['make'] = $make;
		$data['price_min'] = $price_min;
		$data['price_max'] = $price_max;
		$data['id_p'] = \App\Pilar::where('code','accessories_pilar')->first()['id'];
		$data['data'] = \App\Product::with(['kios','product_categories'])->whereHas('kios',function($q) use ($data,$place){ if($place!=""){if(explode('-',$data['place'])[1]=="0"){$q->where('id_province',explode("-",$data['place'])[0]);}else{$q->where('id_city',explode("-",$data['place'])[0]);}}})->where('id_pilar',\App\Pilar::where('code','accessories_pilar')->first()['id'])->where('status',1)->whereHas('product_categories',function($r) use ($make)
		{	
			if($make!="_"){
				$r->where('id_kategori',\App\JKategori::where('code','make')->first()['id']);
				$r->where('value',$make);
			}	
		})->where(function($q) use ($where,$price_min,$price_max)
		{
			if($where!="_"){
				$q->where('name','like','%'.$where.'%');
			}	
			if($price_min>0 and $price_max > 0){
				$q->whereRaw('new_price BETWEEN '.$price_min.' AND '.$price_max);
			}
		})->paginate(10);	
		$data['name'] = "Accessories";
		$data['bret'] = "Ads";
		$data['brer'] = "pilars";
		$data['query'] = $where;
		return view('product.lists')->with($data);
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
