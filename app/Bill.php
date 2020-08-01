<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table='bills';

    protected $fillable=['date_order','total','payment','note','status','cus_infor','cus_address'];

    public $timestamps=true;
//
    public function user()
    {
        return $this->belongTo('App\User');
    }
    
    public function bill_detail()
    {
        return $this->hasMany('App\Bill_Detail');
    }

}
