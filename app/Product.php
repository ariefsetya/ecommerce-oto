<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    public function kios()
    {
        return $this->belongsTo('App\Kios','id_kios');
    }	
    public function product_categories()
    {
        return $this->hasMany('App\ProductCategory','id_product');
    }

}
