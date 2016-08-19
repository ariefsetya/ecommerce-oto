<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use \App\Http\Controllers\APIController\API as API;

class CronController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function cronGetProvince()
	{
		$api = new API;
		$a = $api->getCURL('starter/province');
		\App\Province::truncate();

		foreach ($a->rajaongkir->results as $key) {	
			$n = new \App\Province;
			$n->id = $key->province_id;
			$n->nama = $key->province;
			$n->save();
		}
	}	
	public function cronGetCity()
	{
		$api = new API;
		$a = $api->getCURL('starter/city');
		\App\City::truncate();

		foreach ($a->rajaongkir->results as $key) {	
			$n = new \App\City;
			$n->id = $key->city_id;
			$n->id_provinsi = $key->province_id;
			$n->provinsi = $key->province;
			$n->nama = $key->city_name;
			$n->type = $key->type;
			$n->save();
		}
	}

}
