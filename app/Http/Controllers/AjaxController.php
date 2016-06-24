<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Input;

class AjaxController extends Controller {

	public function get_city_province_id()
	{
		echo json_encode(\App\City::where('id_provinsi',Input::get('id_province'))->get());
	}

}
