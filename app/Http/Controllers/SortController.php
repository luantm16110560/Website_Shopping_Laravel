<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Like;
use App\Type_Product;
use DB;
class SortController extends Controller
{
    public function genderASC(Request $req,$value)
    {
    
        if(!Auth::check())//If not log in
        {
        
          
      
         $productgender = Product::where([
                                        ['gender', 'like', $value],
                                        ['status', '=', 1]
                                        ])->orderBy('unit_price','ASC')->paginate(8);
         $countProductByGender = Product:: where([
                                        ['gender', 'like','%'.$value.'%'],
                                        ['status', '=', 1],
                                      ])->count();
        return view('page.filter.gender')
         ->with('pro', $productgender)
         ->with('gen',$value)
         ->with('_count', $countProductByGender);
        }
     
        
        else
        {
            $like_list = DB::table('user_like_product')
            ->select(
            'user_like_product.id_product as id_product_like'
            )
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->get();
    
        $productgender = Product::where([
            ['gender', 'like', $value],
            ['status', '=', 1]
            ])->orderBy('unit_price','ASC')->paginate(8);
            $countProductByGender = Product:: where([
                    ['gender', 'like','%'.$value.'%'],
                    ['status', '=', 1],
                ])->count();
            return view('page.filter.gender')
            ->with('pro', $productgender)
            ->with('_count', $countProductByGender)
            ->with('gen',$value)
            ->with('like_list',$like_list);
        }
    }
    public function genderDESC(Request $req,$value)
    {
        
        if(!Auth::check())//If not log in
        {
      
         $productgender = Product::where([
                                        ['gender', 'like', $value],
                                        ['status', '=', 1]
                                        ])->orderBy('unit_price','DESC')->paginate(8);
         $countProductByGender = Product:: where([
                                        ['gender', 'like','%'.$value.'%'],
                                        ['status', '=', 1],
                                      ])->count();
        return view('page.filter.gender')
         ->with('pro', $productgender)
         ->with('gen',$value)
         ->with('_count', $countProductByGender);
        }
     
        
        else
        {
            $like_list = DB::table('user_like_product')
            ->select(
            'user_like_product.id_product as id_product_like'
            )
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->get();
    
        $productgender = Product::where([
            ['gender', 'like', $value],
            ['status', '=', 1]
            ])->orderBy('unit_price','DESC')->paginate(8);
            $countProductByGender = Product:: where([
                    ['gender', 'like','%'.$value.'%'],
                    ['status', '=', 1],
                ])->count();
            return view('page.filter.gender')
            ->with('pro', $productgender)
            ->with('_count', $countProductByGender)
            ->with('gen',$value)
            ->with('like_list',$like_list);
        }
    }
    public function type_ASC($type)
    {
        if(!Auth::check())
        {
        $type_product=Product::where([['id_type',$type], ['status','=',1],])->orderBy('unit_price','ASC')
        ->paginate(10);
        $product_other=Product::where([['id_type','<>',$type],['status','=',1],])->paginate(3);
        $loai=Type_Product::all();
        $loai_sp=Type_Product::where('id',$type)->first();
        return view('page.filter.type_product')
        ->with("type_product",$type_product)
        ->with("product_other",$product_other)
        ->with("loai",$loai)
        ->with("loai_sp",$loai_sp);
        }
        else
        {
         $like_list = DB::table('user_like_product')
         ->select(
         'user_like_product.id_product as id_product_like'
         )
     ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
     ->join('products','user_like_product.id_product','=','products.id')->get();
 
     $type_product=Product::where([['id_type',$type], ['status','=',1],])->orderBy('unit_price','ASC')
     ->paginate(10);
         $product_other=Product::where([['id_type','<>',$type],['status','=',1],])->paginate(3);
         $loai=Type_Product::all();
         $loai_sp=Type_Product::where('id',$type)->first();
         return view('page.filter.type_product')
         ->with("type_product",$type_product)
         ->with("product_other",$product_other)
         ->with("loai",$loai)
         ->with('like_list',$like_list)
         ->with("loai_sp",$loai_sp);
        }
 
    }

    public function type_DESC($type)
    {
        if(!Auth::check())
        {
        $type_product=Product::where([['id_type',$type], ['status','=',1],])->orderBy('unit_price','DESC')
        ->paginate(10);
        $product_other=Product::where([['id_type','<>',$type],['status','=',1],])->paginate(3);
        $loai=Type_Product::all();
        $loai_sp=Type_Product::where('id',$type)->first();
        return view('page.filter.type_product')
        ->with("type_product",$type_product)
        ->with("product_other",$product_other)
        ->with("loai",$loai)
        ->with("loai_sp",$loai_sp);
        }
        else
        {
         $like_list = DB::table('user_like_product')
         ->select(
         'user_like_product.id_product as id_product_like'
         )
     ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
     ->join('products','user_like_product.id_product','=','products.id')->get();
 
     $type_product=Product::where([['id_type',$type], ['status','=',1],])->orderBy('unit_price','DESC')
     ->paginate(10);
         $product_other=Product::where([['id_type','<>',$type],['status','=',1],])->paginate(3);
         $loai=Type_Product::all();
         $loai_sp=Type_Product::where('id',$type)->first();
         return view('page.filter.type_product')
         ->with("type_product",$type_product)
         ->with("product_other",$product_other)
         ->with("loai",$loai)
         ->with('like_list',$like_list)
         ->with("loai_sp",$loai_sp);
        }
 
    }
    public function type_Gender_ASC(Request $req, $gender,$id_type)
    {
        if(!Auth::check())
        {
     

        $product=Product::where('status',1)
        ->where('id_type',$id_type)
        ->where('gender',$gender)
        ->orderBy('unit_price','ASC')
        ->paginate(10);

        $product_other=Product::where([['id_type','<>',$id_type],['status','=',1],])->paginate(3);
        $loai=Type_Product::all();
        $loai_sp=Type_Product::where('id',$id_type)->first();

        return view('page.filter.type_gender_product')
        ->with("product_other",$product_other)
        ->with("loai",$loai)
        ->with("loai_sp",$loai_sp)
        ->with('type_product', $product)
        ->with('gen',$gender); 
        }
        else
        {
            $like_list = DB::table('user_like_product')
            ->select(
            'user_like_product.id_product as id_product_like'
            )
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->get();


        $product=Product::where('status',1)
        ->where('id_type',$id_type)
        ->where('gender',$gender)
        ->orderBy('unit_price','ASC')
        ->paginate(10);

        $product_other=Product::where([['id_type','<>',$id_type],['status','=',1],])->paginate(3);
        $loai=Type_Product::all();
        $loai_sp=Type_Product::where('id',$id_type)->first();

       return view('page.filter.type_gender_product')
        ->with("product_other",$product_other)
        ->with("loai",$loai)
        ->with("loai_sp",$loai_sp)
        ->with('like_list',$like_list)
        ->with('type_product', $product)
        ->with('gen',$gender);
    
        }

    }
    public function type_Gender_DESC(Request $req, $gender,$id_type)
    {
        if(!Auth::check())
        {
     

        $product=Product::where('status',1)
        ->where('id_type',$id_type)
        ->where('gender',$gender)
        ->orderBy('unit_price','DESC')
        ->paginate(10);

        $product_other=Product::where([['id_type','<>',$id_type],['status','=',1],])->paginate(3);
        $loai=Type_Product::all();
        $loai_sp=Type_Product::where('id',$id_type)->first();

        return view('page.filter.type_gender_product')
        ->with("product_other",$product_other)
        ->with("loai",$loai)
        ->with("loai_sp",$loai_sp)
        ->with('type_product', $product)
        ->with('gen',$gender); 
        }
        else
        {
            $like_list = DB::table('user_like_product')
            ->select(
            'user_like_product.id_product as id_product_like'
            )
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->get();


        $product=Product::where('status',1)
        ->where('id_type',$id_type)
        ->where('gender',$gender)
        ->orderBy('unit_price','DESC')
        ->paginate(10);

        $product_other=Product::where([['id_type','<>',$id_type],['status','=',1],])->paginate(3);
        $loai=Type_Product::all();
        $loai_sp=Type_Product::where('id',$id_type)->first();

       return view('page.filter.type_gender_product')
        ->with("product_other",$product_other)
        ->with("loai",$loai)
        ->with("loai_sp",$loai_sp)
        ->with('like_list',$like_list)
        ->with('type_product', $product)
        ->with('gen',$gender);
    
        }

    }
}
