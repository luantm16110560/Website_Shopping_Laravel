<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_Detail extends Model
{
    protected $table='bill_detail';

    protected $fillable=['amount','unit_price','status','id_bill','id_product'];

    public $timestamps=false;

    public function product()
    {
        return $this->belongTo('App\Product');
    }
    public function bill()
    {
        return $this->belongTo('App\Bill');
    }
}