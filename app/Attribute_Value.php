<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_Value extends Model
{
    protected $table='attribute_value';

    protected $fillable=['value','amount','id_attribute','id_product'];

    public $timestamps=false;
    public function attribute()
    {
        return $this->belongTo('App\Attribute');
    }
    public function product()
    {
        return $this->belongTo('App\Product');
    }

}
