<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table='attribute';

    protected $fillable=['name'];

    public $timestamps=false;

    public function attribute_value()
    {
        return $this->hasMany('App\Attribute_Value');
    }
    
}
