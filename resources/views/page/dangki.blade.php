@extends('master') @section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{route('home-page')}}">Trang chủ</a> / <span>Đăng kí</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="center">
    <h6 class="inner-title">Đăng ký</h6>
</div>

<div class="container">
    <div id="content">

        <div class="row">
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    <div class="center" style="font-size: 16px; font-weight: bold">{{$err}}</div>
                    @endforeach
                </div>
            @endif
            @if(Session::has('thanhcong'))
            <div class="alert alert-success" style="text-align: center; font-size: 16px; font-weight: bold">{{Session::get('thanhcong')}}</div>
                @endif
            <div class="col-sm-4"></div>
           
            <div class="col-sm-4">

                <div class="card rounded shadow shadow-sm">
                    {{--
                    <div class="card-header">
                        <h3 class="mb-0">Đăng nhập</h3>
                    </div> --}}
                    <div class="card-body">
                        <form action="{{route('dangki')}}" method="post" class="beta-form-checkout" autocomplete="off">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label style="font-size: 17px;">Họ tên</label>
                                <input type="text" class="form-control form-control-lg rounded-0" name="name" required style="font-weight: bold" >

                            </div>
                            <div class="form-group">
                                <label style="font-size: 17px">Giới tính</label>
                        
                                <select style="width: 55px;height: 37px;font-weight: bold" name="gender" style="font-weight: bold">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label style="font-size: 17px">Điện thoại</label>
                                <input type="number" min="0" class="form-control form-control-lg rounded-0" name="phone" required style="font-weight: bold">

                            </div>
                            <div class="form-group">
                                <label style="font-size: 17px">Địa chỉ</label>
                                <input type="text" class="form-control form-control-lg rounded-0" name="address" required style="font-weight: bold">

                            </div>
                            <div class="form-group">
                                <label style="font-size: 17px">Email</label>
                                <input type="email" class="form-control form-control-lg rounded-0" name="email" required style="font-weight: bold">
                            </div>
                            <div class="form-group">
                                <label style="font-size: 17px">Tên đăng nhập</label>
                                <input type="text" class="form-control form-control-lg rounded-0" name="username" required style="font-weight: bold">

                            </div>
                            <div class="form-group">
                                <label style="font-size: 17px">Mật khẩu</label>
                                <input type="password" class="form-control form-control-lg rounded-0" id="password" name="password" required style="font-weight: bold">
                            </div>
                            <div class="form-group">
                                <label style="font-size: 17px">Xác nhận mật khẩu</label>
                                <input type="password" class="form-control form-control-lg rounded-0" id="confirm_password" name="cpassword" required  onkeyup="check()" style="font-weight: bold">

                            </div>
                          
                            <script>
                                var check = function() {
                                    if (document.getElementById('password').value ==
                                        document.getElementById('confirm_password').value) {
                                        document.getElementById('message').style.color = 'green';
                                        document.getElementById('message').innerHTML = '<i class="fa fa-check"></i> Mật khẩu trùng khớp';
										document.getElementById("btnLogin").disabled = false;
                                    } else {
                                        document.getElementById('message').style.color = 'red';
                                        document.getElementById('message').innerHTML = '<i class="fa fa-times"></i> Mật khẩu không khớp';
										document.getElementById("btnLogin").disabled = true;
                                    }
                                }
                            </script>
  													<span style="font-size: 15px;  font-weight: bold;" class="right" id='message'></span>
                            <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Đăng ký</button>

                        </form>
                          
                    </div>
                    <!--/card-block-->
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>

    </div>
    <!-- #content -->
</div>

@endsection