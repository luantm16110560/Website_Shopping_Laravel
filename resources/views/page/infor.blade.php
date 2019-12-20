@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			{{-- <div class="pull-left">
				<h6 class="inner-title">Đặt hàng</h6>
			</div> --}}
			<div class="pull-left">
				<div class="beta-breadcrumb">
					<h6><a href="{{route("home-page")}}">Trang chủ</a> / <span>Cập nhật thông tin</span></h6>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>



		
<div class="container">
	<div id="content" class="center">
			
		<form action="{{route('infor')}}" method="post" class="beta-form-checkout" autocomplete="off">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif</div>
			<div class="row" >
				<div class="col-sm-6" >
				<div class="your-order" >
					<div class="your-order-head"><h5><strong>Thông tin cá nhân</strong></h5></div>
					<div class="space20">&nbsp;</div>
					<div class="your-order-body" style="padding: 0px 10px">
					@if(Auth::check())
					<div class="form-block">
						<label for="name" style="font-size: 17px;font-weight: bold"><i>Họ tên</i></label>
						<input style="font-weight: bold" type="text" class="form-control form-control-lg rounded-0" name="name" placeholder="Họ tên" value="{{Auth::user()->name}}" required>
					</div>
					@endif
                    <div class="form-block">
												<label for="gender" style="font-size: 17px; font-weight: bold"><i>Giới tính</i></label>
												@if(Auth::user()->gender=="Nam")
                        <p>Nam</p><input id="gender" type="radio" class="input-radio" name="gender" value="Nam" checked="true" style="width: 10%">					        
												<p>Nữ</p><input id="gender" type="radio" class="input-radio" name="gender" value="Nữ" style="width: 10%">
												@else
												<p>Nam</p><input id="gender" type="radio" class="input-radio" name="gender" value="Nam"  style="width: 10%">					        
												<p>Nữ</p><input id="gender" type="radio" class="input-radio" name="gender" value="Nữ" checked="true" style="width: 10%">
												@endif
                    </div>
					@if(Auth::check())
					<div class="form-block">
						<label for="email" style="font-size: 17px;font-weight: bold"><i>Email</i></label>
						<input style="font-weight: bold" type="email" class="form-control form-control-lg rounded-0" id="email" name="email" required value="{{Auth::user()->email}}">
					</div>
					@endif
					@if(Auth::check())
					<div class="form-block">
						<label for="adress" style="font-size: 17px;font-weight: bold"><i>Địa chỉ</i></label>
						<input style="font-weight: bold" type="text" class="form-control form-control-lg rounded-0" id="address" name="address"  required value="{{Auth::user()->address}}">
					</div>
					@endif
					@if(Auth::check())
					<div class="form-block">
						<label for="phone" style="font-size: 17px;font-weight: bold"><i>Điện thoại</i></label>
						<input style="font-weight: bold" type="number" min="" class="form-control form-control-lg rounded-0" id="phone" name="phone" required value="{{Auth::user()->phone}}">
					</div>
					@endif
							</div>
							<div class="col-sm-6">
							
							<div class="text-center"><button type="submit" class="beta-btn primary" href="#">Cập nhật<i class="fa fa-chevron-right"></i></button></div>
						</div>
						@if(Auth::user()->phone  and Auth::user()->address)
						<div class="col-sm-6">
								<a href="{{route('change_password')}}">
										<div class="right">
											<button type="button" class="btn btn-success">Đổi mật khẩu</button>
										</div>
									</a>
											
						</div>
						@endif
				</div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection