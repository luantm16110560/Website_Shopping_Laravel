@extends('master')
 @section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <div class="beta-breadcrumb">
                <h6><a href="{{route('home-page')}}">Trang chủ</a> / <span>Đổi mật khẩu</span></h6>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="center">
    <h6 class="inner-title">Đổi mật khẩu</h6>
</div>

<div class="container">
    <div id="content">

        <div class="row">
              
            <div class="col-sm-4"></div>
           
            <div class="col-sm-4">

                <div class="card rounded shadow shadow-sm">
                 
                    <div class="card-body">
                        <form action="{{route('postChangePassword')}}" method="post" class="beta-form-checkout" autocomplete="off">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label style="font-size: 17px;">Mật khẩu cũ</label>
                                <input type="password" class="form-control form-control-lg rounded-0" name="old_password" required style="font-weight: bold" >
                            </div>              
                            <div class="form-group">
                                <label style="font-size: 17px">Mật khẩu mới</label>
                                <input type="password"class="form-control form-control-lg rounded-0" name="new_password" required style="font-weight: bold">
                            </div>
                            <div class="form-group">
                                <label style="font-size: 17px">Xác nhận mật khẩu</label>
                                <input type="password" class="form-control form-control-lg rounded-0" name="confirm_password" required style="font-weight: bold">
                            </div>
                          
  						
                            <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Xác nhận</button>

                        </form>
                       
                        @if(Session::has('error'))
                        <div class="alert alert-danger" style="text-align: center; font-size: 16px; font-weight: bold">{{Session::get('error')}}</div>
                         @endif
                    @if(Session::has('success'))
                    <div id="success" class="alert alert-success" style="text-align: center; font-size: 16px; font-weight: bold">{{Session::get('success')}}</div>
                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
                    <script type="text/javascript"> 
                      $(document).ready( function() {
                        $('#success').delay(1000).fadeOut();
                        document.getElementById("temp").click();
                      });
                    </script>
                    @endif
                          
                    </div>
                    <!--/card-block-->
                </div>
            </div>
            <div class="col-sm-4">
              	<a href="{{route('logout')}}">
										<div class="right">
											<button id="temp"  style="display: none" type="button" class="btn btn-success">Đăng xuất</button>
										</div>
									</a>
            </div>
        </div>

    </div>
    <!-- #content -->
</div>

@endsection