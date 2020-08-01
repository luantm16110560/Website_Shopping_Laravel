<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Review extends Model
{
    protected $table='user_review';

    protected $fillable=['content','rate','id_product','id_user'];

    public $timestamps=true;
    public function product_review()
    {
        return $this->belongTo('App\Product');
    }
    public function user_review()
    {
        return $this->belongTo('App\User');
    }
}
