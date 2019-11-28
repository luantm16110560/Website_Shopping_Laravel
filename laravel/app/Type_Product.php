<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Product extends Model
{
   protected $table='type_products';

   protected $fillable=['name','description','image','status'];

   public $timestamps=false;

   public function product(){
      return $this->hasMany('App\Product');
   }

}
