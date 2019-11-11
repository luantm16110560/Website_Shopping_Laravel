<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Type_Product;
use App\Cart;
use Session;
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
   public function getProductType($type)
   {
       $type_product=Product::where('id_type',$type)->get();
       $product_other=Product::where('id_type','<>',$type)->paginate(3);
       $loai=Type_Product::all();
       $loai_sp=Type_Product::where('id',$type)->first();
       return view('page.loai_sanpham')->with("type_product",$type_product)->with("product_other",$product_other)->with("loai",$loai)->with("loai_sp",$loai_sp);
   }
   public function getProductDetail(Request $res)
   {
        $sanpham=Product::where('id',$res->id)->first();
        $sp_tuongtu=Product::where('id_type',$sanpham->id_type)->paginate(3);
        return view('page.chitiet_sanpham')->with("sanpham",$sanpham)->with("sp_tuongtu",$sp_tuongtu);
   }
   public function getContact()
   {
       return view('page.lienhe');
   }
   public function getAbout()
   {
       return view('page.gioithieu');
   }

   public function getAddtoCard(Request $res, $id)
   {
       $product=Product::find($id);
       $oldCart=Session('cart')?Session::get('cart'):null;
       $cart=new Cart($oldCart);
       $cart->add($product, $id);
       $res->session()->put('cart',$cart);
       return redirect()->back();
   }

   public function getDelItemCard($id){
       $oldCart=Session::has('cart')?Session::get('cart'):null;
       $cart=new Cart($oldCart);
       $cart->removeItem($id);
       if(count($cart->items)>0){
           Session::put('cart',$cart);
       }
       else
       {
           Session::forget('cart');
       }
       return redirect()->back();
   }

   public function getLogin()
   {
       return view('page.login');
   }

   public function getSignin()
   {
       return view('page.dangky');
   }
}
