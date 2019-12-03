<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Type_Product;
use App\Cart;
use App\Customer;
use App\User;
use App\Bill;
use App\Bill_Detail;
use Session;
use Hash;
use Auth;
use Response;
class PageController extends Controller
{
   public function getIndex()
   {
    $slide = DB::table('slides')->get();
    $product = Product::where('status','=',1)->paginate(4);
    $count =  Product::where('status','=',1)->count();
    return view('page.trangchu')->with('my_slide',$slide)->with('product',$product)->with('_count',$count);
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
        $sp_tuongtu=Product::where('id_type',$sanpham->id_type)->paginate(2);
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
       return view('page.dangnhap');
   }

   public function getSignin()
   {
       return view('page.dangki');
   }

   public function getOrder(){
    return view('page.dat_hang');
    }

   public function postOrder(Request $req)
   {
       $cart=Session::get('cart');
       
       $bill=new Bill;
       $bill->id_customer=$user->id;
       $bill->date_order=date('Y-m-d');
       $bill->total=$cart->totalPrice;
       $bill->payment=$req->payment_method;
       $bill->note=$req->notes;
       $bill->status=1;
       $bill->save();
       foreach($cart->items as $key=>$value){
        $bill_detail=new Bill_Detail;
        $bill_detail->id_bill=$bill->id;
        $bill_detail->id_product=$key;
        $bill_detail->amount=$value['qty'];
        if($value['price2']==0){$bill_detail->unit_price=$value['price']/$value['qty'];}
        else{$bill_detail->unit_price=$value['price2']/$value['qty'];}
        $bill_detail->status=1;
        $bill_detail->size=
        $bill_detail->save();
       }
       Session::forget('cart');
       return redirect()->back()->with('thongbao','Đặt hàng thành công');
   }
   public function postSignin(Request $req){
       $this->validate($req,
           [
                 'email'=>'required|email|unique:users,email',
                 'username'=>'unique:users,username',
           ],
           [
               
                'email.unique'=>'Email đã có người sử dụng',
                'username.unique'=>'Username đã có người đăng ký, hãy thử tên khác',
           ]);
           $user =new User();
           $user->name=$req->name;
           $user->phone=$req->phone;
           $user->address=$req->address;
           $user->username=$req->username;
           $user->email=$req->email;
           $user->gender=$req->gender;
           $user->password=Hash::make($req->password);
           $user->role=0;
           $user->status=1;
           $user->save();
           return redirect()->back()->with('thanhcong','Đã tạo tài khoản thành công');
   }
   public function postLogin(Request $req)
   {
    $this->validate($req,
    [
        
    ],
    [
        
    ]
    );
      $credentials = array('username'=>$req->username,'password'=>$req->password);
      if(Auth::attempt($credentials))
      {
         // return redirect()->back()->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
         return redirect()->route('home-page');
      }
      else
      {
        return redirect()->back()->with(['flag'=>'danger','message'=>'Tên đăng nhập hoặc mật khẩu không đúng']);
      }
   }
   public function getLogout(){
       Auth::logout();
       Session::flush();
       return redirect()->route('home-page');
   }
   public function getSearch(Request $req)
   {
        $product = Product::where([
                                  ['name','like','%'.$req->id_search.'%'],
                                  ['status','=',1],
                                  ])->get();                            
        return Response::json($product, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
   }
   public function getsearchView(Request $req)
   {
    $product = Product::where([
                             ['name','like','%'.$req->id_search.'%'],
                             ['status','=',1],                            
                             ])->get();                  
     return view('page.search')->with("sanpham",$product);
   }
   public function getProductByGender(Request $req)
   { 
    $productgender = Product::where([
                                    ['gender', 'like', $req->client_gender],
                                    ['status', '=', 1]
                                    ])->paginate(1);
        $countProductByGender = Product:: where([
                                    ['gender', 'like','%'.$req->client_gender.'%'],
                                    ['status', '=', 1],
                                  ])->count();
       return view('page.gender')->with('pro', $productgender)->with('_count',$countProductByGender);
   }
   public function getProductTypeByGender(Request $req)
   {
    $myurl = $req->url;
    $kq="";
    $temp="";
    for ($i=strlen($myurl)-1; $i>=0; $i=$i-1)
    {
        if(is_numeric($myurl[$i]))
        {
            $temp=$temp.$myurl[$i];
        }
    }
    for ($i=strlen($temp)-1; $i>=0; $i=$i-1)
    {
        if(is_numeric($temp[$i]))
        {
            $kq=$kq.$temp[$i];
        }
    }
      $id_type=(int)$kq;
    $productgendertype = Product::where([
                                        ['gender', 'like', $req->client_gender],
                                        ['status', '=', 1],
                                        ['id_type','=',$id_type]
                                        ])->paginate(2);
    $countproductgendertype = Product::where([
                                        ['gender', 'like', $req->client_gender],
                                        ['status', '=', 1],
                                        ['id_type','=',$id_type]
                                        ])->count();
        
         return view('page.gender_type_product')->with('pro', $productgendertype)->with('_count',$countproductgendertype);
   }
   public function managerPage()
   {
        return view('page.manager');
   }
   public function manageProduct()
   {
       return view('page.manage_product');
   }
   public function manageBill()
   {
       return view('page.manage_bill');
   }
   public function manageUser()
   {
       return view('page.manage_user');
   }

   
}
