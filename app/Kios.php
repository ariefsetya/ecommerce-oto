<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Kios extends Model {

	//
	public function product()
    {
        return $this->hasMany('App\Product');
    }

}
