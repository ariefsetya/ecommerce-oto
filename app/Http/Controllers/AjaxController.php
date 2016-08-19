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
	}	
	public function get_model_id()
	{
		$a = \App\Kategori::where('id_jenis',\App\JKategori::where('code','model')->first()['id'])->where('id_induk',Input::get('id_induk'))->get();
		if(sizeof($a)==0){
			echo json_encode(array());
		}else{
			echo json_encode($a);
		}
	}
	public function get_product_id_kios()
	{
		$a = \App\Product::where('id_kios',Input::get('id_kios'))->where('status',1)->where('promo',0)->get();
		if(sizeof($a)==0){
			echo json_encode(array(array('id'=>"",'name'=>'No Product')));
		}else{
			echo json_encode($a);
		}
	}
	public function get_product_id()
	{
		$a = \App\Product::where('id',Input::get('id'))->where('status',1)->first();
		echo json_encode($a);
	}

	public function chat_set_data()
	{
		if(\Session::get('uniqid')==""){
			\Session::set('uniqid',uniqid()); 
		}
		\Session::set(Input::get('key'),Input::get('value'));
		echo json_encode(array('uniqid'=>\Session::get('uniqid')));
	}
	public function chat_send()
	{
		$options = array(
			'encrypted' => false
		);
		$pusher = new \Pusher(
			'5476ad624b397dfd30f3',
			'4add8987eb54be9fabe9',
			'233376',
			$options
		);



		$data['pesan'] = Input::get('pesan');
		$data['uniqid'] = \Session::get('uniqid');
		$data['mova'] = Input::get('mova');
		$pusher->trigger('chat', 'chat_z_'.Input::get('to'), $data);

		$x = new \App\Chat;
		$x->id_user = 0;
		$x->tmp_name = \Session::get('nama');
		$x->tmp_email = \Session::get('email');
		$x->tmp_phone = \Session::get('phone');
		$x->uniqid = \Session::get('uniqid');
		if(Auth::check()){
			$x->id_user = Auth::user()->id;
			$x->tmp_name = Auth::user()->name;
			$x->tmp_email = Auth::user()->email;
			$x->tmp_phone = Auth::user()->phone;
		}
		$x->to = $data['mova'];
		$x->message = $data['pesan'];
		$x->save();

	}
	public function m_chat_send()
	{
		$options = array(
			'encrypted' => false
		);
		$pusher = new \Pusher(
			'5476ad624b397dfd30f3',
			'4add8987eb54be9fabe9',
			'233376',
			$options
		);

		$data['pesan'] = Input::get('pesan');
		$uniqid = Input::get('uniqid');
		$pusher->trigger('chat', 'chat_x_'.$uniqid, $data);


		$x = new \App\Chat;
		$x->uniqid = $uniqid;
		$x->id_user = Auth::user()->id;
		$x->tmp_name = Auth::user()->name;
		$x->tmp_email = Auth::user()->email;
		$x->tmp_phone = Auth::user()->phone;
		$x->to = 0;
		$x->message = $data['pesan'];
		$x->save();
	}

}
