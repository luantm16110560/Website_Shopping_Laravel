<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table='bills';

    protected $fillable=['date_order','total','payment','note','status'];

    public $timestamps=false;
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
