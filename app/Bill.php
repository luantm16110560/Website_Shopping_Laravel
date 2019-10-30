<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table='bills';

    protected $fillable=['date_order','total','payment','note','status','id_customer'];

    public $timestamps=false;

}
