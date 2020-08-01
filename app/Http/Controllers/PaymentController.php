<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bill;
use DateTime;
use Auth;
use App\Bill_Detail;
use App\Attribute_Value;
use App\ListCard;
class PaymentController extends Controller
{
   public function get_handleOrder()
   {

            if (Auth::check() && Auth::user()->user_city!=null)
                {
                    $list_sp = DB::table('list_cart')
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

                $list_city = DB::table('provinces')
            ->select(
                'provinces.id as id',
                'provinces.name as name',

            )->get();

            $list_district = DB::table('districts')
            ->select(
                'districts.id as id',
                'districts.name as name',

            )->where('districts.province_id',json_decode(Auth::user()->user_city)->province_id)
            ->get();

            $list_ward = DB::table('wards')
            ->select(
                'wards.id as id',
                'wards.name as name',

            )->where('wards.district_id',json_decode(Auth::user()->user_city)->district_id)
            ->get();


                return view('page.order.order')
                ->with('list_sp', $list_sp)
                ->with('list_city',$list_city)
                ->with('list_district',$list_district)
                ->with('list_ward',$list_ward);
                }
                else
                {
                    $list_sp = DB::table('list_cart')
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

                $list_city = DB::table('provinces')
            ->select(
                'provinces.id as id',
                'provinces.name as name',

            )->get();

            $list_district = DB::table('districts')
            ->select(
                'districts.id as id',
                'districts.name as name',

            )
            ->get();

            $list_ward = DB::table('wards')
            ->select(
                'wards.id as id',
                'wards.name as name',

            )
            ->get();


                return view('page.order.order')
                ->with('list_sp', $list_sp)
                ->with('list_city',$list_city)
                ->with('list_district',$list_district)
                ->with('list_ward',$list_ward);
                }
   }

    public function handleOrder(Request $req)
   {
        $sum=$req->sum;
    if ($req->payment_method=='COD')
    {
        $list_sp = DB::table('list_cart')
        ->select(
        'list_cart.value as size',
        'list_cart.amount as amount',
        'products.id as product_id',
        'products.name as product_name',
        'products.unit_price as unit_price',
        'products.image as product_image',
        'products.promotion_price as promotion_price')
        ->where([['id_user',  '=', Auth::user()->id],['list_cart.status','=',1]])
        ->join('products','list_cart.id_product','=','products.id')->get();

        // $json_product_order=$list_sp->toJson();
        $product_order = json_encode($list_sp,JSON_UNESCAPED_UNICODE );
        

        $bill=new Bill;
        $bill->id_user=$req->id_customer;//id tài khoản người đặt hàng 
        $now = new DateTime();

        $bill->date_order=$now;
        $bill->product_order= $product_order;
        // $bill->ship=$req->ship;
        $bill->total=$req->sum;//tổng số tiền
        $bill->payment='COD';// phương thức thanh toán
        $bill->note=$req->notes;// ghi chú của khách hàng
        $bill->status=1;//trạng thái bill
        $bill->isFinish=0;// xác nhận/chưa xác nhận

        //thông tin người đăt hàng
        $infor = $req->only(['name', 'gender','phone','email']);
        $cus_infors = json_encode($infor,JSON_UNESCAPED_UNICODE );
  
        $bill->cus_infor=$cus_infors;

        $bill->cus_address=$req->arr ;
        // $user->user_city=$req->arr;

        $bill->save();
        foreach($list_sp as $sp)
        {
            $bill_detail=new Bill_Detail;
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$sp->product_id;

            $bill_detail->amount=$sp->amount;

            if($sp->promotion_price==0)
                {
                $bill_detail->unit_price=$sp->unit_price;
                $bill_detail->promotion_price=0;
                }
            else
                {  
                    $bill_detail->unit_price=$sp->unit_price;
                $bill_detail->promotion_price=$sp->promotion_price;
                }
            $bill_detail->size=$sp->size;
            $bill_detail->status=1;
            $product=Attribute_Value::where([['id_product',$sp->product_id],['value',$sp->size]])->first();
            $product->amount=$product->amount-$sp->amount;
            $spcart=ListCard::where([['id_product','=',$sp->product_id],['value','=',$sp->size],['id_user','=',Auth::user()->id],['status','=',1],])->first();
            $spcart->status=0;
            $bill_detail->save();
            $spcart->delete();
            $product->update();
        }
       return redirect()->route('home-page')->with("order_success","Đã xác nhận thanh toán");
      
        
    }
    else
    {
        if($req->payment_method=='ATM')
        {
            session(['cost_id' => $req->id]);
            session(['url_prev' => url()->previous()]);
            $vnp_TmnCode = "YIB8OLX9"; //Mã website tại VNPAY 
            $vnp_HashSecret = "PRBTRQRFLJGELADYEGPZCTOSZJVPTUAI"; //Chuỗi bí mật
            $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://tomshoe.cc/returnvnpay";
            $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $sum*100;
            $vnp_Locale = 'vn';
            $vnp_IpAddr = request()->ip();
    
            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );
    
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
    
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
               // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect($vnp_Url)
            ->with('note',$req->note)
            ->with('total',$req->sum)
            ->with('name',$req->name)
            ->with('gender',$req->gender)
            ->with('phone',$req->phone)
            ->with('email',$req->email)
            ->with('arr',$req->arr)
            ->with('arr',$req->arr)
            ->with('id_customer',$req->id_customer);
        }
    }
      
   }
   public function return(Request $req)
   {
       $url = session('url_prev','/');
       if($req->vnp_ResponseCode == "00") {


           $list_sp = DB::table('list_cart')
           ->select(
           'list_cart.value as size',
           'list_cart.amount as amount',
           'products.id as product_id',
           'products.name as product_name',
           'products.unit_price as unit_price',
           'products.image as product_image',
           'products.promotion_price as promotion_price')
           ->where([['id_user',  '=', Auth::user()->id],['list_cart.status','=',1],['list_cart.amount','<>',0]])
           ->join('products','list_cart.id_product','=','products.id')->get();
           $bill=new Bill;

           $bill->id_user=session()->get('id_customer');//id tài khoản người đặt hàng 
           $now = new DateTime();
   
           $bill->date_order=$now;
           $product_order = json_encode($list_sp,JSON_UNESCAPED_UNICODE );
            $bill->product_order= $product_order;

           // $bill->ship=$req->ship;
           $bill->total=session()->get('total');//tổng số tiền
           $bill->payment='ATM';// phương thức thanh toán
           $bill->note=$req->session()->get('note');// ghi chú của khách hàng
           $bill->status=1;//trạng thái bill
           $bill->isFinish=1;// xác nhận/chưa xác nhận
   
           //thông tin người đăt hàng
           $infor =array(
               'name'=>session()->get('name'),
               'gender'=>session()->get('gender'),
               'phone'=>session()->get('phone'),
               'email'=>session()->get('email')
           );
           $cus_infors = json_encode($infor,JSON_UNESCAPED_UNICODE );
     
           $bill->cus_infor=$cus_infors;
   
           $bill->cus_address=session()->get('arr') ;
           // $user->user_city=$req->arr;
   
           $bill->save();
           foreach($list_sp as $sp)
           {
               $bill_detail=new Bill_Detail;
               $bill_detail->id_bill=$bill->id;
               $bill_detail->id_product=$sp->product_id;
   
               $bill_detail->amount=$sp->amount;
   
               if($sp->promotion_price==0)
                   {
                   $bill_detail->unit_price=$sp->unit_price;
                   $bill_detail->promotion_price=0;
                   }
               else
                   {  
                       $bill_detail->unit_price=$sp->unit_price;
                   $bill_detail->promotion_price=$sp->promotion_price;
                   }
               $bill_detail->size=$sp->size;
               $bill_detail->status=1;
               $product=Attribute_Value::where([['id_product',$sp->product_id],['value',$sp->size]])->first();
               $product->amount=$product->amount-$sp->amount;
               $spcart=ListCard::where([['id_product','=',$sp->product_id],['value','=',$sp->size],['id_user','=',Auth::user()->id],['status','=',1],])->first();
               $spcart->delete();
               $bill_detail->save();
          
               $product->update();
           }
           return redirect()->route('home-page')->with("order_success","Đã thanh toán thành công");
       //echo(session()->get('number'));
       }
      
   }

}
