<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Type_Product;
use App\Cart;
use App\Like;
use App\ListCard;
use DB;
use Auth;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('header',function($view){
            $loai_sp = Type_Product::all();
            $view->with('loai_sp',$loai_sp);
        });

        view()->composer('header',function($view){
            if(Auth::check())
            {  
                $sp = DB::table('list_cart')
                ->select(
                'list_cart.value as size',
                'list_cart.amount as amount',
                'products.id as product_id',
                'products.name as product_name',
                'products.unit_price as unit_price',
                'products.image as product_image',
                'products.unit_price as price',
                'products.promotion_price as promotion_price')
                ->where([['id_user',  '=', Auth::user()->id],['list_cart.status','=',1],['list_cart.amount','<>',0]])
                ->join('products','list_cart.id_product','=','products.id')->get();
                $view->with('sp',$sp);
            } 
        });

        view()->composer('header',function($view){
            if(Auth::check())
            {  
                $totalQty = DB::table('list_cart')
                ->where([['id_user',  '=', Auth::user()->id],['list_cart.status','=',1]])
                ->join('products','list_cart.id_product','=','products.id')->sum('list_cart.amount');
                $view->with('totalQty',$totalQty);
            } 
        });

        view()->composer('header',function($view){
            if (Auth::check())
        {
            $totalLike = DB::table('user_like_product')
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->count('user_like_product.id_user');
        $view->with('totalLike',$totalLike);
        }
        });

    //    

        view()->composer(['header','page.order.order','page.product.product_detail'],function($view){
            if(Session('cart')){
                $oldcart = Session::get('cart');
                $cart=new Cart($oldcart);
                $view->with(['cart'=>Session::get('cart'), 'product_cart'=>$cart->items, 'totalPrice'=>$cart->totalPrice, 'totalQty'=>$cart->totalQty,'totalPrice2'=>$cart->totalPrice2,]);
            }
        });

    }
}
