<?php namespace App\Http\Controllers\APIController;

class API {

	public function getCURL($endpoint,$data=array(),$type="get")
	{
		$URL = env('RO_URL_API');
		$curl = new \Curl\Curl();
		$curl->setopt(CURLOPT_SSL_VERIFYPEER, FALSE);
		$data+=array('key'=>env('RO_API_KEY'));
		if($type=="get"){
			$curl->get($URL.$endpoint,$data);
		}else if($type=="post"){
			$curl->post($URL.$endpoint,$data);
		}
		if ($curl->error) {
		    die("Error:".$curl->error_code);
		}
		else {
			$json = json_decode($curl->response);
		    return $json;
		}
	}

}
