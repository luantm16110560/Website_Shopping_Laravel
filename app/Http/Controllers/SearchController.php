<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Auth;
use DB;
class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }
    public function autocomplete(Request $req)
    {
       $data=Product::where("status",1)
       ->where("name","LIKE","%{$req->id_search}%")
       ->take(5)
       ->get();
       return response()->json($data);
    }
    public function getSearch(Request $req)
    {
        if(!Auth::check())
        {     
             if($req->id_search=="")
                 {
                 return view('page.result_search.product.product_not_found');
                 }
                 $count = Product::where([
                 ['name','like','%'.$req->id_search.'%'],
                 ['status','=',1],
                 ])->count();
                 if($count<=0)
                 {
                     return view('page.result_search.product.product_not_found');
                 }
                 else
                 {
                     $product = Product::where([
                                             ['name','like','%'.$req->id_search.'%'],
                                             ['status','=',1],
                                             ])->get();
 
                     return view('page.result_search.product.search_product')
                     ->with("product",$product)
                     ->with('keyword',$req->id_search);
                 }
         }
         else
         {
             $like_list = DB::table('user_like_product')
             ->select(
             'user_like_product.id_product as id_product_like'
             )
         ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
         ->join('products','user_like_product.id_product','=','products.id')->get();
 
         if($req->id_search=="")
         {
         return view('page.result_search.product.product_not_found');
         }
         $count = Product::where([
         ['name','like','%'.$req->id_search.'%'],
         ['status','=',1],
         ])->count();
         if($count<=0)
         {
             return view('page.result_search.product.product_not_found');
         }
         else
         {
             $product = Product::where([
                                     ['name','like','%'.$req->id_search.'%'],
                                     ['status','=',1],
                                     ])->get();
 
             return view('page.result_search.product.search_product')
             ->with("product",$product)
             ->with('keyword',$req->id_search)
             ->with('like_list',$like_list);
         }
         }
    }
}
