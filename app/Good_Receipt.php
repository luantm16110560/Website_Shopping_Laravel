<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good_Receipt extends Model
{
    protected $table='goods_receipt';

    protected $fillable=['amount','unit_price','total','date','status','id_product'];

    public $timestamps=false;

}
