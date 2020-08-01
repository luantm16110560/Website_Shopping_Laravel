<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DB;
use App\Product;
use App\Type_Product;
use App\Cart;
use App\Customer;
use App\User;
use Redirect;
use App\Bill;
use App\Like;
use App\Bill_Detail;
use App\Attribute;
use App\Attribute_Value;
use App\ListCard;
use Session;
use Hash;
use Auth;
use Response;
use Carbon;
use DateTime;
class PageController extends Controller
{
   
   public function getProvince()
   {
    $list_city = DB::table('provinces')
    ->select(
        'provinces.id as id',
        'provinces.name as name',

    )->get();
    return $list_city;
   }
   public function managerPage()
   {
    $bill = Bill::where('status',1)
    ->where('isFinish','=',0)->get();
        return view('page.manage.manager')->with('bill',$bill);
   }
   public function manageProduct()
   {
       return view('page.manage.manage_product');
   }
   public function manageBill()
   {
    return view('page.manage.manage_bill');
   }
   public function manageUser()
   {
       return view('page.manage.manage_user');
   }
    public function postdeleteBill($id)
    {
        $bill=Bill::where('id',$id)->first();

        $bill_detail = Bill_Detail::where('id_bill', '=', $id)->get();

        foreach($bill_detail  as $billdetail)
        {
            $attribute_value=Attribute_Value::where('id_product',$billdetail->id_product)
            ->where('value','=',$billdetail->size)->first();

            

             $attribute_value->amount+=$billdetail->amount;
             $attribute_value->save();
            

        }
        $bill->status=0;
        $bill->save();
    


        return redirect()->back()->with('xoathanhcong','Đã hủy');




    }

    public function getInventory()
    {
        $product=DB::table('products')
        ->select(
        'products.id as id',
        'products.name as name',
        'products.gender as gender',
        'products.unit_price as unit_price',
        'products.promotion_price as promotion_price',
    
        'products.id_type as id_type',
        'products.image as image',
        'type_products.name as name_type'
        )
        ->where('products.status',  '=', 1)
        ->join('type_products','products.id_type','=','type_products.id')
     
        ->orderBy('products.id','desc')
        ->paginate(6);


        $size_amount=DB::table('attribute_value')
        ->select(
      
        'attribute_value.id_product as id_product',
        'attribute_value.value as size',
        'attribute_value.amount as amount',
    
      
        )
    
        ->orderBy('id_product','desc')
        ->get();
        
       // return view('page.manage.inventory')->with('product',$product);
   
       
        
        return view('page.manage.inventory')
        ->with('product',$product)
        ->with('size_amount',$size_amount);
    
    }
    // 
   
    public function district($id)
    {
       // echo($id);
        $list_district = DB::table('districts')
        ->select(
        'districts.id as id',
        'districts.name as name'
        )
        ->where('province_id','=',$id)
        ->get();
        //echo($list_district);
        //dd($list_district);
        return Response::json($list_district, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }
    public function ward($id)
    {
       // echo($id);
        $list_ward = DB::table('wards')
        ->select(
        'wards.id as id',
        'wards.name as name'
        )
        ->where('district_id','=',$id)
        ->get();
        //echo($list_district);
        //dd($list_district);
        return Response::json($list_ward, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }
   
    
    public function getListShip()
    {
        
        $bill = Bill::where('status',1)
        ->where('isFinish','=',1)
        ->where('ship',0)
        ->get();
    
            return view('page.ship.list_ship')->with('bill',$bill);
    }
    public function getBillDetailShip($id_bill)
    {
        $bill_detail = DB::table('bill_detail')
        ->select(
            'bill_detail.id_bill as id',
            'products.id as product_id',
            'products.name as product_name',
            'products.unit_price as unit_price',
            'products.image as product_image',
            'bill_detail.unit_price',
            'bill_detail.promotion_price',
            'bill_detail.amount',
            'bill_detail.size as size',
            'bills.total as total',
            'bills.ship as ship',
            'bills.date_order as date',
            'bills.payment as payment',
            'bills.cus_infor as cus_infor',
            'bills.cus_address as cus_address'
            )
        ->where('id_bill',  '=', $id_bill)
        ->join('bills','bill_detail.id_bill','=','bills.id')
        ->join('products','bill_detail.id_product','=','products.id')->get();



        $ship = DB::table('bill_detail')
        ->select(
            'bill_detail.id_bill as id',
            'products.id as product_id',
            'products.name as product_name',
            'products.unit_price as unit_price',
            'products.image as product_image',
            'bill_detail.unit_price',
            'bill_detail.promotion_price',
            'bill_detail.amount',
            'bill_detail.size as size',
            'bills.total as total',
            'bills.ship as ship',
            'bills.date_order as date',
            'bills.payment as payment',
            'bills.cus_infor as cus_infor',
            'bills.cus_address as cus_address'
            )
        ->where('id_bill',  '=', $id_bill)
        ->join('bills','bill_detail.id_bill','=','bills.id')
        ->join('products','bill_detail.id_product','=','products.id')->first();
    
           return view('page.ship.bill_detail')
           ->with('ship',$ship)
           ->with('billdetail', $bill_detail);
    }
    public function confirmShip($id)
    {
        
        $bill_want_edit = Bill::find($id);
        $bill_want_edit->ship=1;
        $bill_want_edit->save();
       return redirect()->back();
 
    }
    public function postcancelBill($id)
    {
        $bill=Bill::where('id',$id)->first();

        $bill_detail = Bill_Detail::where('id_bill', '=', $id)->get();

        foreach($bill_detail  as $billdetail)
        {
            $attribute_value=Attribute_Value::where('id_product',$billdetail->id_product)
            ->where('value','=',$billdetail->size)->first();

            

             $attribute_value->amount+=$billdetail->amount;
             $attribute_value->save();
            

        }
        $bill->status=0;
        $bill->save();
    


        return redirect()->back()->with('xoathanhcong','Đã hủy');

    }
  
      
}

