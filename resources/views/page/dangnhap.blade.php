@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{route("home-page")}}">Trang chủ</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			<form action="{{route('dangnhap')}}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="row">
					<div class="col-sm-3"></div>
					@if(Session::has('flag'))
						<div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
					@endif
					<div class="col-sm-6">
						<h4>Đăng nhập</h4>
						<div class="space20">&nbsp;</div>
						<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
							<span class="label-input100">Email</span>
							<input class="input100" type="text" name="email">
							<span class="focus-input100"></span>		
						</div> 
						<div class="wrap-input100 validate-input" data-validate="Password is required">
							<span class="label-input100">Password</span>
							<input class="input100" type="password" name="pass">
							<span class="focus-input100"></span>	
						</div>      
						{{-- <div class="container-login100-form-btn">
							<button type="submit" class="btn btn-primary">Login</button>
						</div> --}}
					</br>
						<div class="text-center p-t-46 p-b-20">
							<span class="txt2">
								or sign up using
							</span>
						</div>
					</br>
						<div class="login100-form-social flex-c-m; text-center">
							<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
								<i class="fa fa-facebook-square" style="font-size:36px; color:blue" aria-hidden="true"></i>
							</a>              
							<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
								<i class="fa fa-google-plus-square" style="font-size:36px; color: blue" aria-hidden="true"></i>
							</a>
						</div>
						
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection