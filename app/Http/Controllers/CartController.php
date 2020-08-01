<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListCard;
use Auth;
use DB;
class CartController extends Controller
{
    
   public function getAddtoCard(Request $req)
   {
      if(Auth::check())
      {  
       $sp_cart=ListCard::where([['id_user',Auth::user()->id],['id_product','=',$req->id],['value','=',$req->size],['status','=',1]])->first();
       if($sp_cart)
       {
           $sp_cart2 = ListCard::find($sp_cart->id);
           $sp_cart2->amount += $req->sl ;
           $sp_cart2->save();
       }
       else
       { 
           $sp_cart =new ListCard();
           $sp_cart->id_user=Auth::user()->id;
           $sp_cart->id_product=$req->id;
           $sp_cart->value=$req->size;
           $sp_cart->amount=$req->sl;
           $sp_cart->status=1;
           $sp_cart->save();
       }

       //return response('Đã thêm vào giỏ hàng');
      }
   }
  public function getCountCard(Request $req)
  {
      $count=ListCard::where('id_user',Auth::user()->id)->count();
      return response($count);
  }

  public function AddByOne(Request $req,$id_pro,$size)
  {
       if(Auth::check())
        {  
           $sp_cart2 = ListCard::where('id_product',$id_pro)->where('id_user',Auth::user()->id)->where('value',$size)->where('status','=',1)->first();
           $sp_cart2->amount += 1 ;
           $sp_cart2->save();
        }
        return redirect()->back();
  }

  public function getDelItemCard(Request $req,$id_pro,$size)
  {
    if(Auth::check())
    {  
        $dislike = ListCard::where('id_product',$id_pro)->where('id_user',Auth::user()->id)->where('value',$size)->where('status','=',1)->first();
        $dislike->delete();
        return redirect()->back();
    }
  }

  public function getDelItem(Request $req,$id_pro,$size)
  {
           if(Auth::check())
       {  
           $sp_cart2 = ListCard::where('id_product',$id_pro)->where('id_user',Auth::user()->id)->where('value',$size)->where('status','=',1)->first();
           $sp_cart2->amount -= 1 ;
           $sp_cart2->save();
       }
       return redirect()->back();
  }
  public function ListCart()
  {
      if (Auth::check())
      {
          $list_sp = DB::table('list_cart')
          ->select(
          'list_cart.value as size',
          'list_cart.amount as amount',
          'products.id as product_id',
          'products.name as product_name',
          'products.image as product_image',
          'products.unit_price as price',
          'products.promotion_price as promotion_price')
      ->where([['id_user',  '=', Auth::user()->id],['list_cart.status','=',1],['list_cart.amount','<>',0]])
      ->join('products','list_cart.id_product','=','products.id')->get();
      //dd($like_sp);
  
         return view('page.listcart.listcart')->with('list_sp', $list_sp);
        
      }
  }

}
