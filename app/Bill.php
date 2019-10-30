<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table='bills';

    protected $fillable=['date_order','total','payment','note','status','id_customer'];

    public $timestamps=false;

    public function customer()
    {
        return $this->belongTo('App\Customer');
    }
    
    public function bill_detail()
    {
        return $this->hasMany('App\Bill_Detail');
    }

}
