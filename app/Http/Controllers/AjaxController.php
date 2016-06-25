<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Input;

class AjaxController extends Controller {

	public function get_city_province_id()
	{
		echo json_encode(\App\City::where('id_provinsi',Input::get('id_province'))->get());
	}
	public function get_make_id()
	{
		$a = \App\Kategori::where('id_jenis',\App\JKategori::where('code','make')->first()['id'])->where('id_induk',Input::get('id_induk'))->get();
		if(sizeof($a)==0){
			echo json_encode(array());
		}else{
			echo json_encode($a);
		}
	}	public function get_model_id()
	{
		$a = \App\Kategori::where('id_jenis',\App\JKategori::where('code','model')->first()['id'])->where('id_induk',Input::get('id_induk'))->get();
		if(sizeof($a)==0){
			echo json_encode(array());
		}else{
			echo json_encode($a);
		}
	}

}
