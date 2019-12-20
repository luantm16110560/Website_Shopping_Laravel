@extends('master') @section('content')
<div class="inner-header">
   <div class="container">
      <div class="pull-left">
         <div class="beta-breadcrumb">
            <h6><a href="{{route("home-page")}}">Trang chủ</a> / <span>Đăng nhập</span></h6>
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<div class="center">
   <h6 class="inner-title">Đăng nhập</h6>
</div>
<div class="container">
   <div id="content">
      <div class="row">
         <div class="col-sm-4"></div>
        
         <div class="col-sm-4">
            <div class="card rounded shadow shadow-sm">
               {{-- 
               <div class="card-header">
                  <h3 class="mb-0">Đăng nhập</h3>
               </div>
               --}}
               @if(Session::has('flag'))
               <div class="center">
               <div style="font-size: 20px;  font-weight: bold;" class="allert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
            </div>
               @endif
               <div class="card-body">
                  <form action="{{route('dangnhap')}}" method="post" class="beta-form-checkout" autocomplete="off">
                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <div class="form-group">
                        <label style="font-size: 17px">Tên đăng nhập</label>
                        <input type="text" class="form-control form-control-lg rounded-0" name="username" required>
                     </div>
                     <div class="form-group">
                        <label style="font-size: 17px">Mật khẩu</label>
                        <input type="password" class="form-control form-control-lg rounded-0" name="password" required>
                     </div>
                     {{-- 
                     <div>
                        <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description small text-dark">Remember me on this computer</span>
                        </label>
                     </div>
                     --}}
                     <button  style="height: 40px;font-size: 15px" type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Đăng nhập</button>
                 
                  </form>
                 
               </div>
               
               <!--/card-block-->
            </div>
          
         </div>
        
         <div class="col-sm-4">
          
         </div>
        
      </div>
     
   </div>
   <div class="center">
      <a href="{{ url('auth/google') }}" class="btn btn-danger">
         <i style="font-size: 20px" class="fa fa-google-plus" aria-hidden="true"></i></span> Đăng nhập với Google
       </a>
      </div>
   <!-- #content -->
</div>
<!--/container-->
@endsection
