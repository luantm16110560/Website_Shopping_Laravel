<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type_Product;
use DB;
class Type_Product_Controller extends Controller
{
     
    public function get_edit_type_product($id_cate)
    {
        $cate=Type_Product::where('id',$id_cate)->first();
        return view('page.type_product.edit_type_product')->with('cate',$cate);
    }
    public function post_edit_type_product(Request $req,$id_cate)
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
    public function get_list_type_product()
    {
         $cate=Type_Product::where('status',1)->paginate(10);
        return view('page.type_product.list_type_product')->with('cate',$cate);
    }
 
    public function get_add_type_product()
    {
        return view('page.type_product.add_type_product');
    }
    public function post_add_type_product(Request $req)
    {

       $type = new Type_Product();
       $type->name=$req->name;
        $type->status=1;
        $type->save();
        return redirect()->back()->with('add_type_success','Đã thêm thành công');
    }
}
