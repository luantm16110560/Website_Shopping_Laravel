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
use App\Attribute;
use App\Attribute_Value;
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
    $product = Product::where('status','=',1)->paginate(24);
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
        $sp_sale=Product::where([['promotion_price','<>',0],['id','<>',$sanpham->id],['status','=',1],])->paginate(5);
        
        $sl=Attribute_Value::where('id_product','=',$res->id)->first();
        if (empty( $sl ))
        {
           
            $slsp = 0;
        }else{
            $slsp = $sl->amount;
           
        }
       $size=Attribute_Value::where('id_product','=',$res->id)->get();
       return view('page.chitiet_sanpham')->with("sanpham",$sanpham)->with("sp_tuongtu",$sp_tuongtu)->with("sp_sale",$sp_sale)->with("slsp",$slsp)->with("sizes",$size);
   }
   public function getContact()
   {
       return view('page.lienhe');
   }
   public function getAbout()
   {
       return view('page.gioithieu');
   }

   public function getAddtoCard(Request $req, $id)
   {
       $product=Product::find($id);
       $oldCart=Session('cart')?Session::get('cart'):null;
       $cart=new Cart($oldCart);
       $cart->add($product, $id, $req->sl);
       $req->session()->put('cart',$cart);
       // echo "server working";
      //  return view('page.chitiet_sanpham');
     
   }

   public function AddByOne(Request $res, $id)
   {
       $product=Product::find($id);
       $oldCart=Session('cart')?Session::get('cart'):null;
       $cart=new Cart($oldCart);
       $cart->AddByOne($product, $id);
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
        $user->save();
        return redirect()->back();
   }


   public function getOrder(){
    return view('page.dat_hang');
    }

   public function postOrder(Request $req)
   {
       $cart=Session::get('cart');

       if (Session::has('cart')) {
        $bill=new Bill;
        $bill->id_user=$req->id_customer;
        $now = new DateTime();
     
        $bill->date_order=$now;
        $bill->total=$cart->totalPrice;
        $bill->payment=$req->payment_method;
        $bill->note=$req->notes;
        $bill->status=1;
        $bill->isFinish=0;
        
        $input = $req->only(['name', 'gender','phone','address','email']);
        $cus_infor = json_encode($input,JSON_UNESCAPED_UNICODE );
        $bill->cus_infor=$cus_infor ;

      
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
       else
       {
        return redirect()->back()->with('message','Giỏ hàng của bạn đang trống');
       }
       
       

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

    if($req->client_gender!=null)
    {
     $productgender = Product::where([
                                    ['gender', 'like', $req->client_gender],
                                    ['status', '=', 1]
                                    ])->paginate(4);
     $countProductByGender = Product:: where([
                                    ['gender', 'like','%'.$req->client_gender.'%'],
                                    ['status', '=', 1],
                                  ])->count();
     return view('page.gender')->with('pro', $productgender)->with('_count', $countProductByGender);
    }
    else
    {
        return back();
    }
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
   
    //$mytime = Carbon\Carbon::now()->toDateString('Y-m-d');
 //   $today_start=$mytime.' 00:00:00';
   // $today_end=$mytime.' 23:59:59';

    
    
    $bill = Bill::where('status',1)
    ->where('isFinish','=',0)->get();
  //  ->where('date_order','>=',$today_start)
    //->where('date_order','<=',$today_end)->get();
   
        return view('page.manager')->with('bill',$bill);
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
       $product=DB::table('products')
       ->select(
           'products.id as id',
           'products.name as name',
           'products.gender as gender',
           'products.unit_price as unit_price',
           'products.promotion_price as promotion_price',
           'products.size as size',
           'products.id_type as id_type',
           'products.image as image',
           'type_products.name as name_type'
           )
           ->where('products.status',  '=', 1)
           ->join('type_products','products.id_type','=','type_products.id')
           ->orderBy('products.id','desc')
           ->paginate(8);
    
    return view('page.crud_product')->with('product',$product);
   }
   public function saleOfProduct()
   {
    $sale_of = Product::where('status',1)
    ->where('promotion_price','<>',0)
    ->paginate(8);
    return view('page.sale_of_product')->with('product',$sale_of);
   }
   public function crudCate()
   {
        $cate=Type_Product::where('status',1)->paginate(10);
       return view('page.crud_cate')->with('cate',$cate);
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

        //$cus_infor = $bill->cus_infor;
       // echo($cus_infor);
       return view('page.edit_bill')->with('bill',$bill);
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
        $bill = Bill::where([
            ['status', '=', 1],
            ['isFinish', '=', 0],
          
            ])
            ->orderBy('date_order', 'desc')->paginate(8);
           
        return view('page.wait_confirm')->with('bill',$bill);
    }
    public function getDetail($id_bill)
    {
    //     //lấy ra trong chi tiết hđ những hóa đơn có id=$id_bill
         $bill_detail = Bill_Detail::where('id_bill','=',$id_bill);
    //     ->join('product')
        
    $bill_detail = DB::table('bill_detail')
    ->select(
        'products.id as product_id',
        'products.name as product_name',
        'products.unit_price as unit_price',
        'products.size as size',
        'products.amount as amount',
        'products.image as product_image',
        'bill_detail.unit_price',
        'bill_detail.amount',
        'bill_detail.size')
    ->where('id_bill',  '=', $id_bill)
    ->join('products','bill_detail.id_product','=','products.id')->get();
    
       return view('page.bill_detail')
       ->with('billdetail', $bill_detail);
    //  return Response::json($bill_detail, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        
    }
    public function bill_day()
    {
        return view ('page.bill_day');
    }
    public function get_bill_day(Request $req)
    {
        //if($req->id_search >=10)
        if($req->id_search =="")
        {
            return redirect()->back()->with('ngaynull','Ngày không hợp lệ');
        }

        $bill_day=Bill::where('date_order','like','%'.$req->id_search.'%')->paginate(3);
        return view('page.result_bill_day')->with('bill',$bill_day)->with('day',$req->id_search);
        //return Response::json($bill_day, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }
    public function get_bill_quy()
    {
        return view('page.bill_quy');
    }
    public function result_bill_quy(Request $req)
    {
        $fromDate= $req->id_search_start.' 00:00:00'; 
        $toDate= $req->id_search_end.' 23:59:59';

        $from= $req->id_search_start; 
        $to= $req->id_search_end;

        $bill = Bill::where('status',1)
        ->where('date_order','>=',$fromDate)
        ->where('date_order','<=',$toDate)->get();
       // return Response::json($bill, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        // $bill_day=Bill::where('date_order','like','%'.$req->id_search.'%')->paginate(3);
         return view('page.result_bill_quy')->with('bil',$bill)->with('start',$from)->with('end',$to);
    }
    public function changePassword()
    {
        return view('page.change_password');
    }
    public function postChangePassword(Request $req)
    {
        if (!(Hash::check($req->get('old_password'), Auth::user()->password))) {
            // The passwords not matches
            return redirect()->back()->with("error","Mật khẩu cũ không đúng");
        }
   
        if(strcmp($req->get('old_password'), $req->get('new_password')) == 0){
            //Current password and new password are same
           return redirect()->back()->with("error","Mật khẩu mới không được giống mật khẩu cũ");
            //return response()->json(['errors' => ['current'=> ['New Password cannot be same as your current password']]], 422);
        }
        if(($req->get('confirm_password')!=$req->get('new_password'))){
            //Current password and new password are same
           return redirect()->back()->with("error","Mật khẩu xác nhận phải giống mật khẩu mới");
            //return response()->json(['errors' => ['current'=> ['New Password cannot be same as your current password']]], 422);
        }
        $validatedData = $req->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($req->get('new_password'));
        $user->save();
        return redirect()->back()->with("success","Đổi mật khẩu thành công, hãy đăng nhập lại");
    }
    public function get_editProduct(Request $req,$id_product,$id_type_product)
    {
      
        $product = Product::where('status',1)
        ->where('id',$id_product)->first();
        
        $type=Type_Product::where('status',1)->get();
        $type_by_id=Type_Product::where('id',$id_type_product)->first();
      
        return view('page.edit_product')
        ->with('p',$product)
        ->with('t',$type)
        ->with('tid',$type_by_id);
       // return Response::json($product, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }
    public function post_editProduct(Request $req,$id_product)
    {
        //echo $id_product;
        $product_want_edit = Product::find($id_product);
      
        $product_want_edit->name = $req->name;
        $product_want_edit->description = $req->description;
        $product_want_edit->unit_price = $req->unit_price;
        $product_want_edit->promotion_price = $req->promotion_price;
        $product_want_edit->gender = $req->gender;
        $product_want_edit->size = $req->size;
        $product_want_edit->id_type = $req->select;








      

       if($req->hasFile('imageInput'))// input type name=""
       {
           $myDate = Carbon\Carbon::now()->toDateString();

           $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";

           $myFile=$req->imageInput->getClientOriginalName(); //input type name=""

           $filename =$myDate."_".$myTime."_".$myFile;
       
           $image= $req->file('imageInput');
           $image_resize = Image::make($image->getRealPath());
           $image_resize->resize(270, 320);
           $product_want_edit->image=$filename;
           $image_resize->save(public_path('source/image/product/'.$filename));
       }
       else
       {
         $product_want_edit->image="defaul_product.png";
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
           $product_want_edit->img1=$filename;
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
           $product_want_edit->img2=$filename;
           $image_resize->save(public_path('source/image/product/'.$filename));
       }
       else
       {
           echo "error";
       }
        $product_want_edit->save();
        return redirect()->back()->with("success","Sửa thành công");
        
    }
    public function postdeleteProduct($id)
    {
        Product::where('id',$id )
        ->update(['status' => 0]);
       return redirect()->back()->with('xoathanhcong','Xóa thành công');
    }
    public function geteditCate($id_cate)
    {
        $cate=Type_Product::where('id',$id_cate)->first();
        return view('page.edit_cate')->with('cate',$cate);
    }
    public function posteditcate(Request $req,$id_cate)
    {
        $cate_want_edit = Type_Product::find($id_cate);
      
        $cate_want_edit->name = $req->name;
      

        $cate_want_edit->save();

        return redirect()->back()->with('thanhcong','Sửa thành công');
    }
    public function deletecate($id_cate)
    {
        Type_Product::where('id',$id_cate )
        ->update(['status' => 0]);
       return redirect()->back()->with('xoathanhcong','Xóa thành công');
    }
    public function getOrderHistory()
    {
        return view('page.order_history');
    }
}