<?php

namespace App\Http\Controllers;
use App\Product;
use App\Type_Product;
use App\Attribute_Value;
use Illuminate\Http\Request;
use DB;
class InventoryController extends Controller
{
    public function getProductInventory(Request $req,$id_product,$id_type_product)
    {
        $product = Product::where('status',1)
        ->where('id',$id_product)->first();

        $type=Type_Product::where('status',1)->get();
        $type_by_id=Type_Product::where('id',$id_type_product)->first();
        $list_size=Attribute_Value::where('id_product',$id_product)->get();

        return view('page.product.edit_product')
        ->with('p',$product)
        ->with('t',$type)
        ->with('list_size',$list_size)
        ->with('tid',$type_by_id);
    }
}
