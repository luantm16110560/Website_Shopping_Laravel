<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table='user_like_product';

    protected $fillable=['id_user','id_product','is_Like'];

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
