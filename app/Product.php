<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';

    protected $fillable=['name','description','unit_price','promotion_price','amount','image','status','id_type'];

    public $timestamps=false;

    public function product_type()
    {
        return $this->belongTo('App\Type_Product');
    }
    public function good_receipt()
    {
        return $this->belongTo('App\Good_Receipt');
    }

}
