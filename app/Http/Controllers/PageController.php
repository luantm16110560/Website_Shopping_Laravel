<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
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
use Carbon;
use DateTime;
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
       $type_product=Product::where([['id_type',$type], ['status','=',1],])->get();
       $product_other=Product::where([['id_type','<>',$type],['status','=',1],])->paginate(3);
       $loai=Type_Product::all();
       $loai_sp=Type_Product::where('id',$type)->first();
       return view('page.loai_sanpham')->with("type_product",$type_product)->with("product_other",$product_other)->with("loai",$loai)->with("loai_sp",$loai_sp);
   }
   public function getProductDetail(Request $res)
   {
        $sanpham=Product::where('id',$res->id)->first();
        $sp_tuongtu=Product::where([['id_type',$sanpham->id_type],['id','<>',$sanpham->id],['status','=',1],])->paginate(3);
        $sp_sale=Product::where([['promotion_price','<>',0],['id','<>',$sanpham->id],['status','=',1],['amount','=',1],])->paginate(5);
        return view('page.chitiet_sanpham')->with("sanpham",$sanpham)->with("sp_tuongtu",$sp_tuongtu)->with("sp_sale",$sp_sale);
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

   public function getDelItem($id){
    $oldCart=Session::has('cart')?Session::get('cart'):null;
    $cart=new Cart($oldCart);
    $cart->reduceByOne($id);
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

   public function getinfor()
   {
       return view('page.infor');
   }

   public function postinfor(Request $req)
   {
        $user=User::where('id',Auth::user()->id)->first();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->phone=$req->phone;
        $user->gender=$req->gender;
        $user->address=$req->address;
        $user->update();
        return redirect()->back();
   }


   public function getOrder(){
    return view('page.dat_hang');
    }

   public function postOrder(Request $req)
   {
       $cart=Session::get('cart');
       
       $bill=new Bill;
       $bill->id_user=$req->id_customer;
       $now = new DateTime();
    
       $bill->date_order=$now;
       $bill->total=$cart->totalPrice;
       $bill->payment=$req->payment_method;
       $bill->note=$req->notes;
       $bill->status=1;
       $bill->isFinish=0;
       $bill->save();
       foreach($cart->items as $key=>$value){
        $bill_detail=new Bill_Detail;
        $bill_detail->id_bill=$bill->id;
        $bill_detail->id_product=$key;
        $bill_detail->amount=$value['qty'];
        if($value['price2']==0){$bill_detail->unit_price=$value['price']/$value['qty'];}
        else{$bill_detail->unit_price=$value['price2']/$value['qty'];}
        $bill_detail->status=1;
        $product=Product::where('id',$key)->first();
        $product->amount=$product->amount-$value['qty'];
        $bill_detail->size=$value['size'];
        $bill_detail->save();
        $product->update();
        
       }
       Session::forget('cart');
       return redirect()->route('home-page');
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
                                    ])->paginate(4);
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
                                        ])->paginate(4);
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

   //
   public function uploadProduct()
   {
    $type = Type_Product::where('status','=',1)->get();
       return view('page.upload_product')->with('type',$type);
   }
   public function crudProduct()
   {
       return view('page.crud_product');
   }
   public function saleOfProduct()
   {
    return view('page.sale_of_product');
   }
   public function crudCate()
   {
       return view('page.crud_cate');
   }
  
   public function createProduct(Request $req)
   {
       $product = new Product();
       $product->name=$req->name;
       $product->gender=$req->gender;
       $product->id_type=$req->select;
       $product->description=$req->description;
       $product->status=1;
       $product->isNew=1;
       $product->unit_price=$req->unit_price;
       $product->promotion_price=$req->promotion_price;

      

       if($req->hasFile('imageInput'))// input type name=""
       {
           $myDate = Carbon\Carbon::now()->toDateString();

           $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";

           $myFile=$req->imageInput->getClientOriginalName(); //input type name=""

           $filename =$myDate."_".$myTime."_".$myFile;
       
           $image= $req->file('imageInput');
           $image_resize = Image::make($image->getRealPath());
           $image_resize->resize(270, 320);
           $product->image=$filename;
           $image_resize->save(public_path('source/image/product/'.$filename));
       }
       else
       {
         $product->image="defaul_product.png";
       }
       if($req->hasFile('imageInput1'))// input type name=""
       {
           $myDate = Carbon\Carbon::now()->toDateString();

           $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";

           $myFile=$req->imageInput1->getClientOriginalName(); //input type name=""

           $filename =$myDate."_".$myTime."_".$myFile;;
       
           $image= $req->file('imageInput1');
           $image_resize = Image::make($image->getRealPath());
           $image_resize->resize(90, 90);
           $product->img1=$filename;
           $image_resize->save(public_path('source/image/product/'.$filename));
       }
       else
       {
           echo "error";
       }
       if($req->hasFile('imageInput2'))// input type name=""
       {
           $myDate = Carbon\Carbon::now()->toDateString();

           $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";

           $myFile=$req->imageInput2->getClientOriginalName(); //input type name=""

           $filename =$myDate."_".$myTime."_".$myFile;;
       
           $image= $req->file('imageInput2');
           $image_resize = Image::make($image->getRealPath());
           $image_resize->resize(90, 90);
           $product->img2=$filename;
           $image_resize->save(public_path('source/image/product/'.$filename));
       }
       else
       {
           echo "error";
       }
        $product->amount=1;
        $product->size=$req->size;
        $product->save();
        return redirect()->back()->with('thongbao','Thêm sản phẩm thành công');
    }
    public function crudView()
    {
        $bill = Bill::where([
            ['status', '=', 1],
            ['isFinish', '=', 1],
          
            ])
            ->orderBy('date_order', 'desc')->paginate(8);
           return view('page.crud_bill')->with('bill',$bill);
    }
    public function geteditBill($id_bill)
    {
        $bill = Bill::find($id_bill);
        $user_by_id = $bill->id_user;
        $user = User::find($user_by_id);
           return view('page.edit_bill')->with('bill',$bill)->with('user',$user)
         ;
    }
    public function posteditBill(Request $req,$id)
    {
        $bill_want_edit = Bill::find($id);
      
        $bill_want_edit->total = $req->total;
        $bill_want_edit->payment= $req->payment;
        $bill_want_edit->date_order =$req->date_order;
        $bill_want_edit->note =$req->note;
        $bill_want_edit->isFinish=$req->isFinish;

        $bill_want_edit->save();

        return redirect()->back()->with('thanhcong','Sửa thành công');

    }
    public function getBill()
    {
        return view('page.search_bill');
    }
    public function searchBill(Request $req)
    {
        $id_bill_want_search=$req->id_search;
        $bill_want_search=Bill::where('status',1)
        ->where('id','=',$id_bill_want_search)
        ->where('isFinish','<',2)
        ->first();

        
        $count=Bill::where('status',1)
        ->where('id','=',$id_bill_want_search)
        ->where('isFinish','<',2)
        ->count();

        if($count<=0)
        {
            return redirect()->back()->with('khongtimthay','Mã hóa đơn không tồn tại');
        }
        else
        {
        $user_by_id = $bill_want_search->id_user;
        $user = User::find($user_by_id);
            return view('page.result_tracuu')
            ->with('bill',$bill_want_search)
            ->with('user',$user);
        }
       //return Response::json($bill_want_search, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }
    public function postdeleteBill($id)
    {
     
        Bill::where('id',$id )
        ->update(['status' => 0]);
       return redirect()->back()->with('xoathanhcong','Xóa thành công');


    }
    public function viewTraCuu()
    {
        return view('page.tracuu');
    }
    public function billConfirm()
    {
        // $bill = Bill::where([
        //     ['status', '=', 1],
        //     ['isFinish', '=', 0],
          
        //     ])
        //     ->orderBy('date_order', 'desc')->paginate(2);
           
        // return view('page.wait_confirm')->with('bill',$bill);
    }
}