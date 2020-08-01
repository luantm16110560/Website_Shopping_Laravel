<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';

    protected $fillable=['name','description','unit_price','promotion_price','image','isNew','status','id_type'];

    public $timestamps=false;

    public function product_type()
    {
        return $this->belongTo('App\Type_Product');
    }
    public function good_receipt()
    {
        return $this->belongTo('App\Good_Receipt');
    }
    public function bill_detail()
    {
        return $this->hasMany('App\Bill_Detail');
    }
    public function attribute_value()
    {
        return $this->hasMany('App\Attribute_Value');
    }
    public function like()
    {
        return $this->hasMany('App\Like');
    }
    public function product_review()
    {
        return $this->hasMany('App\User_Review');
    }

    public function listcard()
    {
        return $this->hasMany('App\ListCard');
    }

}
