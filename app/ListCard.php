<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListCard extends Model
{
    //
    protected $table='list_cart';

    protected $fillable=['id_user','id_product','value','amount','status'];

    public $timestamps=false;
    public function product()
    {
        return $this->belongTo('App\Product');
    }
    public function user()
    {
        return $this->belongTo('App\User');
    }
}
