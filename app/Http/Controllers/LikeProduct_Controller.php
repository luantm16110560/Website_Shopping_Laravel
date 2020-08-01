<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Like;
use DB;
class LikeProduct_Controller extends Controller
{
    public function like_Product(Request $req, $id_pro)
    {
        if(Auth::check())
      {  
        $like =new Like();
        $like->id_user=Auth::user()->id;
        $like->id_product=$id_pro;
        $like->isLike=1;
        $like->save();

        $count=Like::where('id_user',Auth::user()->id)->count();
        return response('like_success');

      }
      else
      {
          return view('page.account.login');
      }

    }
    public function countLike(Request $req)
    {
        $count=Like::where('id_user',Auth::user()->id)->count();
        return response($count);
    }
    public function dislike_Product(Request $req,$id_pro)
    {
         $dislike = Like::where('id_product',$id_pro)->where('id_user',Auth::user()->id)->first();
         $dislike->delete();
         return response('dislike_success');
    }

    public function get_like()
    {
        if (Auth::check())
        {
            $like_sp = DB::table('user_like_product')
            ->select(
            'products.id as product_id',
            'products.name as product_name',
            'products.unit_price as unit_price',
            'products.image as product_image',
            'products.unit_price as price',
            'products.promotion_price as promotion_price')
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->get();
        //dd($like_sp);
    
           return view('page.like_product.list_like')->with('like_sp', $like_sp);
        }
    }
    public function getBestLike()
    {
        if(!Auth::check())//If not log in
        {
        
            $bestlike = DB::table('user_like_product')
                        ->join('products', 'products.id', '=','user_like_product.id_product' )
                        ->groupBy('products.id', 'products.name', 'products.image','products.unit_price','products.promotion_price')
                        ->select('products.id', 'products.name','products.image','products.unit_price','products.promotion_price', DB::raw('Count(id_product) as count'))
                        ->orderBy('count','desc')
                        ->take(10)
                        ->get();

            //echo($bestlike);
            return view('page.best_like')->with('best_like',$bestlike);
        }
        else
        {
                $like_list = DB::table('user_like_product')
                ->select(
                'user_like_product.id_product as id_product_like'
                )
            ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
            ->join('products','user_like_product.id_product','=','products.id')->get();

                $bestlike = DB::table('user_like_product')
                ->join('products', 'products.id', '=','user_like_product.id_product' )
                ->groupBy('products.id', 'products.name', 'products.image','products.unit_price','products.promotion_price')
                ->select('products.id', 'products.name','products.image','products.unit_price','products.promotion_price', DB::raw('Count(id_product) as count'))
                ->orderBy('count','desc')
                ->take(10)
                ->get();

        //echo($bestlike);
                return view('page.best_like')->with('best_like',$bestlike)->with('like_list',$like_list);
        }
    }
}
