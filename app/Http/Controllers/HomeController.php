<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Product;
class HomeController extends Controller
{
    public function getIndex()
    {
            if(!Auth::check())//If not log in
            {
                $slide = DB::table('slides')->get();
                $product = Product::where('status','=',1)->paginate(24);
                $count =  Product::where('status','=',1)->count();
                
                return view('page.homepage.homepage')->with('my_slide',$slide)->with('product',$product)->with('_count',$count);
            }
            else
            {
                $like_list = DB::table('user_like_product')
                ->select(
                'user_like_product.id_product as id_product_like'
                )
            ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
            ->join('products','user_like_product.id_product','=','products.id')->get();

            $slide = DB::table('slides')->get();
            $product = Product::where('status','=',1)->paginate(24);
            $count =  Product::where('status','=',1)->count();
            return view('page.homepage.homepage')->with('my_slide',$slide)->with('product',$product)->with('currentUser', Auth::user()->id)
            ->with('_count',$count)->with('like_list',$like_list);

            }
   
    }
    public function sortASC()
    {
        if(!Auth::check())//If not log in
        {
            $slide = DB::table('slides')->get();
            $product = Product::where('status','=',1)->orderBy('unit_price','ASC')->paginate(24);
            $count =  Product::where('status','=',1)->count();
            
            return view('page.homepage.homepage')->with('my_slide',$slide)->with('product',$product)->with('_count',$count);
        }
        else
        {
            $like_list = DB::table('user_like_product')
            ->select(
            'user_like_product.id_product as id_product_like'
            )
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->get();

        $slide = DB::table('slides')->get();
        $product = Product::where('status','=',1)->orderBy('unit_price','ASC')->paginate(24);
        $count =  Product::where('status','=',1)->count();
        return view('page.homepage.homepage')->with('my_slide',$slide)->with('product',$product)->with('currentUser', Auth::user()->id)
        ->with('_count',$count)->with('like_list',$like_list);

        }
    }
    public function sortDESC()
    {
        if(!Auth::check())//If not log in
        {
            $slide = DB::table('slides')->get();
            $product = Product::where('status','=',1)->orderBy('unit_price','DESC')->paginate(24);
            $count =  Product::where('status','=',1)->count();
            
            return view('page.homepage.homepage')->with('my_slide',$slide)->with('product',$product)->with('_count',$count);
        }
        else
        {
            $like_list = DB::table('user_like_product')
            ->select(
            'user_like_product.id_product as id_product_like'
            )
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->get();

        $slide = DB::table('slides')->get();
        $product = Product::where('status','=',1)->orderBy('unit_price','DESC')->paginate(24);
        $count =  Product::where('status','=',1)->count();
        return view('page.homepage.homepage')->with('my_slide',$slide)->with('product',$product)->with('currentUser', Auth::user()->id)
        ->with('_count',$count)->with('like_list',$like_list);

        }
    }
    public function getContact()
    {
       return view('page.contact.contact');
    }
   public function getAbout()
    {
       return view('page.about.about');
    }
   public function getLogin()
    {
       return view('page.account.login');
    }

}
