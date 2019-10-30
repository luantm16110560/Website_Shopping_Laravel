<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customers';

    protected $fillable=['name','gender','email','address','phone_number','note','status'];

    public $timestamps=false;

    public function bill()
    {
        return $this->hasMany('App\Bill');
    }
}
