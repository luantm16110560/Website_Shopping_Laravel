<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use Hash;
use Session;
use App\Bill;
class UserController extends Controller
{
      
   public function getSignin()
   {
    $list_city = DB::table('provinces')
    ->select(
        'provinces.id as id',
        'provinces.name as name',

    )->get();
    
       return view('page.account.register')->with('list_city',$list_city);
   }
   public function getinfor()
   {
    
    if(Auth::user()->user_city=='')
    {
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
        return view('page.account.infor')
        ->with('list_city',$list_city)
        ->with('list_ward',$list_ward)
        ->with('list_district',$list_district);
    }
    
    if((Auth::user()->user_city!=null))
    {
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
      return view('page.account.infor')
      ->with('list_city',$list_city)
      ->with('list_ward',$list_ward)
      ->with('list_district',$list_district);
    }
      
   }
   public function postinfor(Request $req)
   {
        $user=User::where('id',Auth::user()->id)->first();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->phone=$req->phone;
        $user->gender=$req->gender;
        $user->address=$req->address;
        $user->user_city=$req->arr;
        $user->save();
        return redirect()->back();
       // echo $req->arr;
   }
   public function postSignin(Request $req)
   {
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
        $user->user_city=$req->arr;
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
    $credentials = array('username'=>$req->username,'password'=>$req->password,'status'=>1);
    if(Auth::attempt($credentials))
    {
        // return redirect()->back()->with(['flag'=>'success','type_gender_success'=>'Đăng nhập thành công']);

        return redirect()->route('home-page');
    }
    else
    {
        return redirect()->back()->with(['flag'=>'danger','message'=>'Tên đăng nhập hoặc mật khẩu không đúng']);
    }
   }
   public function getLogout()
   {
        Auth::logout();
        Session::flush();
        return redirect()->route('home-page');
   }
   public function changePassword()
   {
       return view('page.account.change_password');
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
   public function getOrderHistory()
   {
       $order_history=Bill::where('status','>=',0)
   ->where('id_user',Auth::user()->id)
   ->orderBy('created_at', 'DESC')
   ->get();

       return view('page.order.order_history')->with('order_history',$order_history);
   }

}