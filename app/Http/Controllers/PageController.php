<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;
use DB;
use App\Product;
class PageController extends Controller
{
   public function getIndex()
   {
    $slide = DB::table('slides')->get();
    //echo $slide;
       //return view('page.trangchu',compact('my_slide'));

     //  $user = User::where('confirmation_code', '=', 123456, 'and')->where('id', '=', 5, 'or')->where('role', '=', 'admin')->first();

    $newProduct = Product::where('status','=',1,'and')->where('isNew', '=', '1')->paginate(8);
      //  dd($newProduct);
      $saleoff_product=Product::where('promotion_price','<>',0,'and')->where('status','=',1)->paginate(8);
       return view('page.trangchu')->with('my_slide',$slide)->with('new_product',$newProduct)->with('saleoff_product',$saleoff_product);
   }
   public function getProductType()
   {
       return view('page.loai_sanpham');
   }
   public function getProductDetail()
   {
    return view('page.chitiet_sanpham');
   }
   public function getContact()
   {
       return view('page.lienhe');
   }
   public function getAbout()
   {
       return view('page.gioithieu');
   }
}
