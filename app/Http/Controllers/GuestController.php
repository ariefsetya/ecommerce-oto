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
			$s = "%";
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

		return redirect(route($pilar,[$q,$s,]));
	}
	public function services($place="",$where="",$price_min="",$price_max="",$make="")
	{

		if(substr($place, 0,8)=="Provinsi"){
			$data['place'] = ($place!="")?\App\Province::where('nama',str_replace("Provinsi ","",$place))->first()['id']."-0":0;
		}else{
			$data['place'] = ($place!="")?\App\City::whereRaw('concat(type," ",nama)="'.$place.'"')->first()['id']."-1":0;
		}
		$data['show'] = 1;
		$data['id_p'] = \App\Pilar::where('code','services_pilar')->first()['id'];
		$data['data'] = \App\Product::with(['kios','product_categories'])->whereHas('kios',function($q) use ($data,$place,$price_min,$price_max){ if($price_min==0){$q->where('price','>=',$price_min);} if($price_max==0){$q->where('price','<=',$price_max);} if($place!=""){if(explode('-',$data['place'])[1]=="0"){$q->where('id_province',explode("-",$data['place'])[0]);}else{$q->where('id_city',explode("-",$data['place'])[0]);}}})->where('id_pilar',\App\Pilar::where('code','services_pilar')->first()['id'])->where('name','like','%'.$where.'%')->where('status',1)->paginate(10);
		$data['name'] = "Services";
		$data['bret'] = "Ads";
		$data['brer'] = "pilars";
		$data['query'] = $where;
		return view('product.lists')->with($data);
	}
	public function motorcycles($place="",$where="",$price_min="",$price_max="",$make="")
	{
		if(substr($place, 0,8)=="Provinsi"){
			$data['place'] = ($place!="")?\App\Province::where('nama',str_replace("Provinsi ","",$place))->first()['id']."-0":0;
		}else{
			$data['place'] = ($place!="")?\App\City::whereRaw('concat(type," ",nama)="'.$place.'"')->first()['id']."-1":0;
		}
		$data['show'] = 1;
		$data['id_p'] = \App\Pilar::where('code','motorcycles_pilar')->first()['id'];
		$data['data'] = \App\Product::with(['kios','product_categories'])->whereHas('kios',function($q) use ($data,$place){ if($place!=""){if(explode('-',$data['place'])[1]=="0"){$q->where('id_province',explode("-",$data['place'])[0]);}else{$q->where('id_city',explode("-",$data['place'])[0]);}}})->where('id_pilar',\App\Pilar::where('code','motorcycles_pilar')->first()['id'])->where('name','like','%'.$where.'%')->where('status',1)->whereHas('product_categories',function($r)
		{
		})->paginate(10);
		// dd($data['data']);
		$data['name'] = "Motorcycles";
		$data['bret'] = "Ads";
		$data['brer'] = "pilars";
		$data['query'] = $where;
		return view('product.lists')->with($data);
	}
	public function cars($place="",$where="",$price_min="",$price_max="",$make="")
	{
		if(substr($place, 0,8)=="Provinsi"){
			$data['place'] = ($place!="")?\App\Province::where('nama',str_replace("Provinsi ","",$place))->first()['id']."-0":0;
		}else{
			$data['place'] = ($place!="")?\App\City::whereRaw('concat(type," ",nama)="'.$place.'"')->first()['id']."-1":0;
		}
		$data['show'] = 1;
		$data['id_p'] = \App\Pilar::where('code','cars_pilar')->first()['id'];
		$data['data'] = \App\Product::with(['kios','product_categories'])->whereHas('kios',function($q) use ($data,$place,$price_min,$price_max){ if($price_min==0){$q->where('price','>=',$price_min);} if($price_max==0){$q->where('price','<=',$price_max);} if($place!=""){if(explode('-',$data['place'])[1]=="0"){$q->where('id_province',explode("-",$data['place'])[0]);}else{$q->where('id_city',explode("-",$data['place'])[0]);}}})->where('id_pilar',\App\Pilar::where('code','cars_pilar')->first()['id'])->where('name','like','%'.$where.'%')->where('status',1)->paginate(10);
		$data['name'] = "Cars";
		$data['bret'] = "Ads";
		$data['brer'] = "pilars";
		$data['query'] = $where;
		return view('product.lists')->with($data);
	}
	public function accessories($place="",$where="",$price_min="",$price_max="",$make="")
	{
		if(substr($place, 0,8)=="Provinsi"){
			$data['place'] = ($place!="")?\App\Province::where('nama',str_replace("Provinsi ","",$place))->first()['id']."-0":0;
		}else{
			$data['place'] = ($place!="")?\App\City::whereRaw('concat(type," ",nama)="'.$place.'"')->first()['id']."-1":0;
		}
		$data['show'] = 1;
		$data['id_p'] = \App\Pilar::where('code','accessories_pilar')->first()['id'];
		$data['data'] = \App\Product::with(['kios','product_categories'])->whereHas('kios',function($q) use ($data,$place,$price_min,$price_max){ if($price_min==0){$q->where('price','>=',$price_min);} if($price_max==0){$q->where('price','<=',$price_max);} if($place!=""){if(explode('-',$data['place'])[1]=="0"){$q->where('id_province',explode("-",$data['place'])[0]);}else{$q->where('id_city',explode("-",$data['place'])[0]);}}})->where('id_pilar',\App\Pilar::where('code','accessories_pilar')->first()['id'])->where('name','like','%'.$where.'%')->where('status',1)->paginate(10);
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
