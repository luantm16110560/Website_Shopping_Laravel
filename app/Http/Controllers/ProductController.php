<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type_Product;
use Auth;
use App\Product;
use App\Attribute_Value;
use App\User_Review;
use App\Bill_Detail;
use App\Like;
use DB;
use Carbon;
use Intervention\Image\ImageManagerStatic as Image;
class ProductController extends Controller
{
    public function nav_getProductByType($type)
    {
        if(!Auth::check())
        {
        $type_product=Product::where([['id_type',$type], ['status','=',1],])->get();
        $product_other=Product::where([['id_type','<>',$type],['status','=',1],])->paginate(3);
        $loai=Type_Product::all();
        $loai_sp=Type_Product::where('id',$type)->first();
        return view('page.filter.type_product')
        ->with("type_product",$type_product)
        ->with("product_other",$product_other)
        ->with("loai",$loai)
        ->with("loai_sp",$loai_sp);
        }
        else
        {
         $like_list = DB::table('user_like_product')
         ->select(
         'user_like_product.id_product as id_product_like'
         )
     ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
     ->join('products','user_like_product.id_product','=','products.id')->get();
 
         $type_product=Product::where([['id_type',$type], ['status','=',1],])->get();
         $product_other=Product::where([['id_type','<>',$type],['status','=',1],])->paginate(3);
         $loai=Type_Product::all();
         $loai_sp=Type_Product::where('id',$type)->first();
         return view('page.filter.type_product')
         ->with("type_product",$type_product)
         ->with("product_other",$product_other)
         ->with("loai",$loai)
         ->with('like_list',$like_list)
         ->with("loai_sp",$loai_sp);
        }
 
    }
    public function getProductDetail(Request $req)
    {
     if(!Auth::check())
     {
         $sanpham=Product::where('id',$req->id)->first();
         $sp_tuongtu=Product::where([['id_type',$sanpham->id_type],['id','<>',$sanpham->id],['status','=',1],])->paginate(3);
         $sp_sale=Product::where([['promotion_price','<>',0],['id','<>',$sanpham->id],['status','=',1],])->get();
 
         $sl=Attribute_Value::where('id_product','=',$req->id)->first();
         if (empty( $sl ))
         {
 
             $slsp = 0;
         }else{
             $slsp = $sl->amount;
 
         }
        $count_review=User_Review::where('id_product',$req->id)->count();
        $count_star=User_Review::where('id_product',$req->id)->average('rate');
        $count_buy=Bill_Detail::where('id_product',$req->id)->count();
        $count_like=Like::where('id_product',$req->id)->count();
        $size=Attribute_Value::where('id_product','=',$req->id)->get();
        return view('page.product.product_detail')
        ->with("sanpham",$sanpham)
        ->with("sp_tuongtu",$sp_tuongtu)
        ->with("sp_sale",$sp_sale)
        ->with("slsp",$slsp)
        ->with('count_like',$count_like)
        ->with('count_star',$count_star)
        ->with('count_buy',$count_buy)
        ->with('count_review',$count_review)
        ->with("sizes",$size);
     }
     else
     {
         $sanpham=Product::where('id',$req->id)->first();
         $sp_tuongtu=Product::where([['id_type',$sanpham->id_type],['id','<>',$sanpham->id],['status','=',1],])->paginate(3);
         $sp_sale=Product::where([['promotion_price','<>',0],['id','<>',$sanpham->id],['status','=',1],])->get();
 
         $sl=Attribute_Value::where('id_product','=',$req->id)->first();
         if (empty( $sl ))
         {
 
             $slsp = 0;
         }else{
             $slsp = $sl->amount;
 
         }
         $like_list = DB::table('user_like_product')
         ->select(
         'user_like_product.id_product as id_product_like'
         )
     ->where('id_user',  '=', Auth::user()->id)
     ->where('isLike','=',1)
     ->join('products','user_like_product.id_product','=','products.id')->get();
     $count_review=User_Review::where('id_product',$req->id)->count();
     $count_star=User_Review::where('id_product',$req->id)->average('rate');
     $count_buy=Bill_Detail::where('id_product',$req->id)->count();
     $count_like=Like::where('id_product',$req->id)->count();
        $size=Attribute_Value::where('id_product','=',$req->id)->get();
        return view('page.product.product_detail')
        ->with("sanpham",$sanpham)
        ->with("sp_tuongtu",$sp_tuongtu)
        ->with("sp_sale",$sp_sale)
        ->with("slsp",$slsp)
        ->with('count_like',$count_like)
        ->with('count_review',$count_review)
        ->with('count_buy',$count_buy)
        ->with("like_list",$like_list)
        ->with('count_star',$count_star)
        ->with("sizes",$size);
     }
    }
    public function getProductByGender(Request $req)
    {
 
     if(!Auth::check())//If not log in
     {
     if($req->client_gender!=null)
     {
      $productgender = Product::where([
                                     ['gender', 'like', $req->client_gender],
                                     ['status', '=', 1]
                                     ])->paginate(8);
      $countProductByGender = Product:: where([
                                     ['gender', 'like','%'.$req->client_gender.'%'],
                                     ['status', '=', 1],
                                   ])->count();
      return view('page.filter.gender')
      ->with('pro', $productgender)
      ->with('gen',$req->client_gender)
      ->with('_count', $countProductByGender);
     }
     else
     {
         return back();
     }
     }
     else
     {
         $like_list = DB::table('user_like_product')
         ->select(
         'user_like_product.id_product as id_product_like'
         )
     ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
     ->join('products','user_like_product.id_product','=','products.id')->get();
 
     $productgender = Product::where([
         ['gender', 'like', $req->client_gender],
         ['status', '=', 1]
         ])->paginate(8);
         $countProductByGender = Product:: where([
                 ['gender', 'like','%'.$req->client_gender.'%'],
                 ['status', '=', 1],
             ])->count();
         return view('page.filter.gender')
         ->with('pro', $productgender)
         ->with('_count', $countProductByGender)
         ->with('gen',$req->client_gender)
         ->with('like_list',$like_list);
     }
    }
    public function getuploadProduct()
    {
       $type = Type_Product::where('status','=',1)->get();
        return view('page.product.upload_product')->with('type',$type);
    }
    public function postUploadProduct(Request $req)
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
         //    else
         //    {
         //      $product->image="defaul_product.png";
         //    }
             if($req->hasFile('imageInput1'))// input type name=""
             {
                 $myDate = Carbon\Carbon::now()->toDateString();
 
                 $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";
 
                 $myFile=$req->imageInput1->getClientOriginalName(); //input type name=""
 
                 $filename =$myDate."_".$myTime."_".$myFile;;
 
                 $image= $req->file('imageInput1');
                 $image_resize = Image::make($image->getRealPath());
             //  $image_resize->resize(100, 100);
                 $product->img1=$filename;
                 $image_resize->save(public_path('source/image/product/'.$filename));
             }
         //    else
         //    {
         //      $product->image="defaul_product.png";
         //    }
             if($req->hasFile('imageInput2'))// input type name=""
             {
                 $myDate = Carbon\Carbon::now()->toDateString();
 
                 $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";
 
                 $myFile=$req->imageInput2->getClientOriginalName(); //input type name=""
 
                 $filename =$myDate."_".$myTime."_".$myFile;;
 
                 $image= $req->file('imageInput2');
                 $image_resize = Image::make($image->getRealPath());
             //  $image_resize->resize(90, 90);
                 $product->img2=$filename;
                 $image_resize->save(public_path('source/image/product/'.$filename));
             }
         //    else
         //    {
         //        echo "error";
         //    }
             if($req->hasFile('imageInput3'))// input type name=""
             {
                 $myDate = Carbon\Carbon::now()->toDateString();
 
                 $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";
 
                 $myFile=$req->imageInput3->getClientOriginalName(); //input type name=""
 
                 $filename =$myDate."_".$myTime."_".$myFile;;
 
                 $image= $req->file('imageInput3');
                 $image_resize = Image::make($image->getRealPath());
             //   $image_resize->resize(100, 100);
                 $product->img3=$filename;
                 $image_resize->save(public_path('source/image/product/'.$filename));
             }
         //    else
         //    {
         //     $product->image="defaul_product.png";
         //    }
         //   //// $product->save();
             $saveSuccess=$product->save();
             if($saveSuccess)
             {
                 $size_amount = json_decode($req->data_arr, true);
                 foreach($size_amount as $value ) 
                 {
             
                         $attribute_value=new Attribute_Value();
                         $attribute_value->id_attribute=1;
                         $attribute_value->id_product=$product->id;
                         $attribute_value->value= $value['size'];
                         $attribute_value->amount= $value['amount'];
                         $attribute_value->save();
 
                 }
             }
             
             return redirect()->back()->with('thongbao','Thêm sản phẩm thành công');  
    }
    public function get_list_product()
    {
     $product=DB::table('products')
     ->select(
         'products.id as id',
         'products.name as name',
         'products.gender as gender',
         'products.unit_price as unit_price',
         'products.promotion_price as promotion_price',
      //    'products.size as size',
         'products.id_type as id_type',
         'products.image as image',
         'type_products.name as name_type'
         )
         ->where('products.status',  '=', 1)
         ->join('type_products','products.id_type','=','type_products.id')
         ->orderBy('products.id','desc')
         ->paginate(8);
         return view('page.product.list_product')->with('product',$product);
    }
    public function get_editProduct(Request $req,$id_product,$id_type_product)
    {

        $product = Product::where('status',1)
        ->where('id',$id_product)->first();

        $type=Type_Product::where('status',1)->get();
        $type_by_id=Type_Product::where('id',$id_type_product)->first();
        $list_size=Attribute_Value::where('id_product',$id_product)->get();

        return view('page.product.edit_product')
        ->with('p',$product)
        ->with('t',$type)
        ->with('list_size',$list_size)
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
     //   $product_want_edit->size = $req->size;
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

       if($req->hasFile('imageInput1'))// input type name=""
       {
           $myDate = Carbon\Carbon::now()->toDateString();

           $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";

           $myFile=$req->imageInput1->getClientOriginalName(); //input type name=""

           $filename =$myDate."_".$myTime."_".$myFile;;

           $image= $req->file('imageInput1');
           $image_resize = Image::make($image->getRealPath());
         //  $image_resize->resize(90, 90);
           $product_want_edit->img1=$filename;
           $image_resize->save(public_path('source/image/product/'.$filename));
       }

       if($req->hasFile('imageInput2'))// input type name=""
       {
           $myDate = Carbon\Carbon::now()->toDateString();

           $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";

           $myFile=$req->imageInput2->getClientOriginalName(); //input type name=""

           $filename =$myDate."_".$myTime."_".$myFile;;

           $image= $req->file('imageInput2');
           $image_resize = Image::make($image->getRealPath());
         //  $image_resize->resize(90, 90);
           $product_want_edit->img2=$filename;
           $image_resize->save(public_path('source/image/product/'.$filename));
       }

       if($req->hasFile('imageInput3'))// input type name=""
       {
           $myDate = Carbon\Carbon::now()->toDateString();

           $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";

           $myFile=$req->imageInput3->getClientOriginalName(); //input type name=""

           $filename =$myDate."_".$myTime."_".$myFile;;

           $image= $req->file('imageInput3');
           $image_resize = Image::make($image->getRealPath());
         //  $image_resize->resize(90, 90);
           $product_want_edit->img3=$filename;
           $image_resize->save(public_path('source/image/product/'.$filename));
       }

        $product_want_edit->save();
        return redirect()->back()->with("edit_pro_success","Sửa sản phẩm thành công ");

    }
    public function postdeleteProduct($id)
    {
        Product::where('id',$id )
        ->update(['status' => 0]);
       return redirect()->back()->with('xoathanhcong','Xóa thành công');
    }

    public function post_Delete_Size_Product(Request $req, $id_product,$size)
    {
        $del_size = Attribute_Value::where('id_product',$id_product)->where('value',$size)->first();
        $del_size->delete();
        return redirect()->back();
    }
    public function post_add_NewSize_Product(Request $req,$id_pro)
    {
       
       
        $attr_value=new Attribute_Value;
        $attr_value->value=$req->_size;
        $attr_value->id_attribute=1;
        $attr_value->id_product=$id_pro;
        $attr_value->amount=$req->_amount;
        $attr_value->save();
        return redirect()->back();
    }
    public function post_edit_Amount_Product(Request $req,$id_pro)
    {
       
        $attr_value=Attribute_Value::where('id_product',$id_pro)
        ->where('value',$req->edit_size)->first();
        $attr_value->amount=$req->edit_amount;
        $attr_value->save();
        return redirect()->back();
       
    }
    public function saleOfProduct()
    {
     $sale_of = Product::where('status',1)
     ->where('promotion_price','<>',0)
     ->paginate(8);
     return view('page.product.sale_of_product')->with('product',$sale_of);
    }
    public function admin_getSearchProduct()
    {
        return view ('page.search.product.product_by_id');
    }
    public function admin_searchProduct(Request $req)
    {

        $product=DB::table('products')
        ->select(
            'products.id as id',
            'products.name as name',
            'products.gender as gender',
            'products.unit_price as unit_price',
            'products.promotion_price as promotion_price',
         //    'products.size as size',
            'products.id_type as id_type',
            'products.image as image',
            'type_products.name as name_type'
            )
            ->where('products.status',  '=', 1)
            ->where('products.id',  '=', $req->id_search)
            ->join('type_products','products.id_type','=','type_products.id')
            ->first();

            $count=Product::where('status',1)
            ->where('id','=',$req->id_search)
        
            ->count();

            if($count<=0)
        {
            return redirect()->back()->with('khongtimthay','Sản phẩm không tồn tại');
        }
        else
        {
            return view('page.result_search.product.product_by_id')->with('product',$product);
            //return redirect()->back()->with('product',$product_want_search);
        }
    
           


    
        
    }
    public function getProduct_Sale()
    {
        if(!Auth::check())
        {
        $product = Product::where('status',1)
        ->where('promotion_price','<>',0)
        ->paginate(8);
        $slide = DB::table('slides')->get();
        return view('page.sale')
        ->with('product',$product)
        ->with('my_slide',$slide);
        }
        else
        {
            $product = Product::where('status',1)
            ->where('promotion_price','<>',0)
            ->paginate(8);

            $like_list = DB::table('user_like_product')
            ->select(
            'user_like_product.id_product as id_product_like'
            )
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->get();
        $slide = DB::table('slides')->get();
           return view('page.sale')
           ->with('product',$product)
           ->with('my_slide',$slide)
           ->with('like_list',$like_list);

        }
    }
    public function getAmount_Product($id_product,$size)
    {
        $amount=Attribute_Value::where('id_product',$id_product)->where('value',$size)->first();
        return $amount;
    }
    public function admin_getProductByType($id_type)
    {
      $product=DB::table('products')
        ->select(
            'products.id as id',
            'products.name as name',
            'products.gender as gender',
            'products.unit_price as unit_price',
            'products.promotion_price as promotion_price',
         //    'products.size as size',
            'products.id_type as id_type',
            'products.image as image',
            'type_products.name as name_type'
            )
            ->where('products.status',  '=', 1)
            ->where('type_products.id',$id_type)
            ->where('type_products.status',1)
            ->join('type_products','products.id_type','=','type_products.id')
            ->orderBy('products.id','desc')
            ->paginate(8);

            $count=Product::where('status',1)
            ->where('id_type',$id_type)->count();

            if($count>0)
            {
                return view('page.product.product_by_type')->with('pro_type',$product);
            } 
            else
            {
                return redirect()->back()->with('message','Hiện tại chưa có sản phẩm nào thuộc danh mục này');
            }
          //  echo($product);
    }
    public function getProductSaleByGender(Request $req)
    {
        if($req->client_gender!=null)
        {
            if(!Auth::check())
            { 
                $gender_sale = Product::where([
                                            ['gender', '=', $req->client_gender],
                                            ['status', '=', 1],
                                            ['promotion_price','<>',0]
                                            ])->paginate(8);
        
            return view('page.filter.gender_sale')->with('pro', $gender_sale);
             }
             else
             {
                $like_list = DB::table('user_like_product')
                ->select(
                'user_like_product.id_product as id_product_like'
                )
            ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
            ->join('products','user_like_product.id_product','=','products.id')->get();

                $gender_sale = Product::where([
                    ['gender', '=', $req->client_gender],
                    ['status', '=', 1],
                    ['promotion_price','<>',0]
                    ])->paginate(8);

                return view('page.filter.gender_sale')->with('like_list', $like_list)->with('pro', $gender_sale);
             }

        }
        else
        {
            return back();
        }
    }
    public function chatbot_getProductByGender_ByType($gender,$id_type)
    {
        $product = Product::where('status',1)
        ->where('id_type',$id_type)
        ->where('gender',$gender)
        ->paginate(4);
        return view('page.gender_type_product')->with('pro',$product);

    }
    public function user_getProductByType_ByGender(Request $req, $gender,$id_type)
    {
        if(!Auth::check())
        {
     

        $product=Product::where('status',1)
        ->where('id_type',$id_type)
        ->where('gender',$gender)->get();

        $product_other=Product::where([['id_type','<>',$id_type],['status','=',1],])->paginate(3);
        $loai=Type_Product::all();
        $loai_sp=Type_Product::where('id',$id_type)->first();

        return view('page.filter.type_gender_product')
        ->with("product_other",$product_other)
        ->with("loai",$loai)
        ->with("loai_sp",$loai_sp)
        ->with('type_product', $product)
        ->with('gen',$gender); 
        }
        else
        {
            $like_list = DB::table('user_like_product')
            ->select(
            'user_like_product.id_product as id_product_like'
            )
        ->where([['id_user',  '=', Auth::user()->id],['isLike','=',1]])
        ->join('products','user_like_product.id_product','=','products.id')->get();


        $product=Product::where('status',1)
        ->where('id_type',$id_type)
        ->where('gender',$gender)->get();

        $product_other=Product::where([['id_type','<>',$id_type],['status','=',1],])->paginate(3);
        $loai=Type_Product::all();
        $loai_sp=Type_Product::where('id',$id_type)->first();

       return view('page.filter.type_gender_product')
        ->with("product_other",$product_other)
        ->with("loai",$loai)
        ->with("loai_sp",$loai_sp)
        ->with('like_list',$like_list)
        ->with('type_product', $product)
        ->with('gen',$gender);
    
        }

    }
   
  

}
