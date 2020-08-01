<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Redirect;
use DB;
class BillController extends Controller
{
    public function list_bill_confirmed()
    {
        $bill = Bill::where([
            ['status', '>=', 0],
            // ['isFinish', '=', 1],

            ])
            ->orderBy('date_order', 'desc')->paginate(8);
           return view('page.bill.list_bill_confirmed')->with('bill',$bill);
    }
    public function post_confirmBill(Request $req,$id)
    {
        $bill_want_edit = Bill::find($id);

        $bill_want_edit->isFinish=1;
        $bill_want_edit->ship=0;
        $bill_want_edit->save();

       return redirect()->back();
 
    }
    public function getSearchBill()
    {
        return view('page.search.bill.bill_by_id');
    }
    public function searchBill(Request $req)
    {
        
            $id_bill_want_search=$req->id_search;
            $bill_want_search=Bill::where('id','=',$id_bill_want_search)
            ->first();


            $count=Bill::where('id','=',$id_bill_want_search)
       
            ->count();

            if($count<=0)
            {
                return redirect()->route('search_bill')->with('khongtimthay','Mã hóa đơn không tồn tại');
            }
            else
            {
            // $url='http://tomshoe.cc/admin/bill/billdetail/'.$req->id_search;
            // return Redirect::to($url);
                return view('page.result_search.bill.result_bill_id')->with('b',$bill_want_search);
            }
    }
    public function user_getBillDetail(Request $req,$id_bill)
    {
       
        $bill=Bill::where('id',$id_bill)->first();
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

    
           return view('page.view_bill_detail')
           ->with('bill',$bill)
           ->with('ship',$ship)
           ->with('billdetail', $bill_detail);
    }
    public function list_bill_wait_confirm()
    {
        $bill = Bill::where([
            ['status', '=', 1],
            ['isFinish', '=', 0],

            ])
            ->orderBy('date_order', 'desc')->paginate(8);

        return view('page.order.order_list_wait_confirm')->with('bill',$bill);
    }
    public function bill_by_day(Request $req)
    {
        //if($req->id_search >=10)
        if($req->id_search =="")
        {
            return redirect()->back()->with('ngaynull','Ngày không hợp lệ');
        }

        $bill_day=Bill::where('date_order','like','%'.$req->id_search.'%')->paginate(3);

        return view('page.result_search.bill.result_bill_day')->with('bill',$bill_day)->with('day',$req->id_search);
        //return Response::json($bill_day, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }
    
    public function get_bill_by_day()
    {
        return view ('page.search.bill.bill_by_day');
    }
  
    
    public function get_bill_by_month()
    {
        return view('page.search.bill.bill_by_month');
    }
    public function result_bill_month(Request $req)
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
         return view('page.result_search.bill.result_bill_month')->with('bil',$bill)->with('start',$from)->with('end',$to);
    }
    public function admin_getBillDetail($id_bill)
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
                'bills.status as status',
                'bills.isFinish as isFinish',
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

        

            return view('page.bill.bill_detail')
            ->with('ship',$ship)

            ->with('billdetail', $bill_detail);
            //  return Response::json($bill_detail, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }
   
}
