@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			{{-- <div class="pull-left">
				<h6 class="inner-title">Đặt hàng</h6>
			</div> --}}
			<div class="pull-left">
				<div class="beta-breadcrumb">
					<h6><a href="{{route("home-page")}}">Trang chủ</a> / <span>Đặt hàng</span></h6>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>

<div class="container">
	<div id="content">
		@if(Session::has('message'))
		<div style="text-align: center;font-weight: bold;font-size: 25px" class="alert alert-danger">
			{{Session::get('message')}}
		</div>
		@endif
		<form autocomplete="off" action="{{route('dathang')}}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">
				@if(Session::has('thongbao')){{Session::get('thongbao')}}
				@endif
			
			</div>
			<div class="row">
				<div class="col-sm-6">
				<div class="your-order" >
					<div class="your-order-head"><h5><strong>Thông tin khách hàng</strong></h5></div>
					<div class="space20">&nbsp;</div>
					<div class="your-order-body" style="padding: 0px 10px">
					@if(Auth::check())
					<div class="form-block">
						<label for="name" style="font-size: 17px;font-weight: bold"><i>Họ tên</i></label>
						<input style="font-weight: bold"  type="text" class="form-control form-control-lg rounded-0" name="name" placeholder="Họ tên" value="{{Auth::user()->name}}" required>
					</div>
					@endif
					@if(Auth::check())
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
					@endif
					@if(Auth::check())
					<div class="form-block" hidden="true">
						<label for="name" style="font-size: 17px"><i>Mã Khách Hàng</i></label>
						<input type="text" class="form-control form-control-lg rounded-0" name="id_customer" placeholder="Họ tên" value="{{Auth::user()->id}}" required>
					</div>
					@endif
					@if(Auth::check())
					<div class="form-block">
						<label for="email" style="font-size: 17px;font-weight: bold"><i>Email</i></label>
						<input style="font-weight: bold" type="email" class="form-control form-control-lg rounded-0" id="email" name="email" required  value="{{Auth::user()->email}}">
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
						<input style="font-weight: bold" type="number" min="0" class="form-control form-control-lg rounded-0" id="phone" name="phone" required value="{{Auth::user()->phone}}">
					</div>
					@endif
					<div class="form-block">
						<label for="notes" style="font-size: 17px;font-weight: bold"><i>Ghi chú</i></label>
						<textarea id="notes" class="form-control form-control-lg rounded-0" name="notes" placeholder="Hãy để lại ghi chú nếu cần thiết"></textarea>
					</div>
					</div>
				</div>
				</div>
				<div class="col-sm-6">
					<div class="your-order">
						<div class="your-order-head"><h5><strong>Thông tin đơn hàng</strong></h5></div>
						<div class="your-order-body" style="padding: 0px 10px">
							<div class="your-order-item">
								<div>
								@if(Session::has('cart'))
								@foreach($product_cart as $cart)
								<!--  one item	 -->
									<div class="media">
										<a  class="pull-left" href="{{route('product-detail',$cart['item']['id'])}}"><img src="source/image/product/{{$cart['item']['image']}}" alt="" height="30px"></a>
										<div class="media-body">
											<p class="font-large">{{$cart['item']['name']}}</p>
											<table >
												<tr>
												   <th >Số lượng: 
												   </th>
												   <th style="color: white" class="text-center"> Nhân:
												   </th>
												   <th style="width:50%">Đơn giá:
												   </th>
												</tr>
												<tr>
												   <td class="text-center">
														<span class="cart-item-amount" >
																{{$cart['qty']}}
														{{-- <input type="number" name="Qty" id="sl"  class="text-left" width="1000px" min="1" value="{{$cart['qty']}}" onchange="myFunction();"> --}}

														</span>
												   </td>
												   <td class="text-center">
												   <p>X</p>
												   </td>
												   <td >
												   <span class="cart-total-value" id="dongia"> 
													@if($cart['price2']==0) {{number_format($cart['price']/$cart['qty'])}}@else	{{number_format($cart['price2']/$cart['qty'])}}@endif	VND </span><br/>
													<span class="flash-del">@if($cart['price2']!=0){{number_format($cart['price']/$cart['qty'])}}	VND @endif</span>
												   </td>
												</tr>
											 </table>
											 <label>Size:</label><i>   {{$cart['size']}}</i>
											{{-- <span class="color-gray your-order-info">Đơn giá:@if($cart['price2']==0) {{number_format($cart['price'])}}@else	{{number_format($cart['price2'])}}@endif	VND</span>
											<span class="color-gray your-order-info">Số lượng: {{$cart['qty']}}</span> --}}
										</div>
									</div>
								<!-- end one item -->
								@endforeach
								@endif
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="your-order-item">
								<div class="pull-left">
									<label class="your-order-f18">Tạm tính:</label>
									<i style="color:black;font-weight: bold">(Đơn vị tính VND)</i>
								</div>
								<div class="pull-right"><h5 id="tamtinh" class="color-black">@if(Session::has('cart')){{number_format($totalPrice)}} @else 0 @endif</h5></div>
								
							{{-- <div class="pull-right"><input type="text" class="color-black" id="abc" value="{{number_format($totalPrice)}}">
							@else 
							<div class="pull-right"><input type="text" class="color-black" id="abc" value="0"> --}}
							{{-- @endif VND</h5></div> --}}
								{{-- <script>
									function myFunction()
									{
									alert(document.getElementById("abc").value);
									alert(document.getElementById("dongia").value);// sai cái này ok để lát t xem về cái... útna2yok =ôk
									alert(document.getElementById("sl").value);
									}
								</script> --}}
								<div class="clearfix"></div>
							</div>
							
							<div class="your-order-item">
								<div class="form-group" >
									<label style="font-size: 17px" class="color-black"><select id="khuvuc"  onchange="Ship(this)">
										<option value=""> -- Chọn khu vực -- </option>
										<option value="1">Khu vực ngoại thành</option>
										<option value="0"> Khu vực nội thành </option>
									</select></label>
								</div>
							</br>
								<div class="pull-left">
									<label style="font-size: 17px">Phí vận chuyển: 	</label>
									<i style="color:black;font-weight: bold">(Đơn vị tính VND)</i>
								</div>
								<div class="pull-right">
									@if(Session::has('cart'))
									<h5 class="color-black" id="ship"></h5>
									@else <h5 class="color-black">0</h5> 
									@endif
								</div>
								<div class="clearfix"></div>
									
									{{-- <br/>
									<br/>
									<input id="ship" type="radio" class="input-radio" name="ship" value="20000" checked="checked" style="width: 10%"><span>Q9, Q1, Q2,Q5, Q10, Q.Gò Vấp, Q.Phú Nhuận</span><br/>
									<input id="ship" type="radio" class="input-radio" name="ship" value="30000" style="width: 10%"><span>Các quận/huyện còn lại</span><br/>
									<input id="ship" type="radio" class="input-radio" name="ship" value="35000" style="width: 10%"><span>Các tỉnh</span><br/>	 --}}
							</div>
							{{-- <div class="your-order-item">
								<div class="pull-left"><label class="your-order-f18">Giá đã giảm:</label></div>
								<div class="pull-right"><h5 class="color-black">@if(Session::has('cart')){{number_format($totalPrice2-$totalPrice)}}@else 0 @endif VND</h5></div>
								<div class="clearfix"></div>
							</div> --}}
							<div class="your-order-item">
								<div class="pull-left">
									<label class="your-order-f18">Tổng cộng:</label>
									<i style="color:black;font-weight: bold">(Đơn vị tính VND)</i>
								</div>
								<div class="pull-right">
								
										@if(Session::has('cart'))
								<h5 id="fee" class="color-black" value={{number_format($totalPrice)}}></h5>
											@else
											<h5>0</h5>
										@endif
								
									</div><br/>
								<div class="clearfix"></div>
							</div>
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
							<script language="javascript">
								function Ship(obj)
									{
										var message = document.getElementById('ship');
										var temp=document.getElementById("fee");
										var value = obj.value;
										if (value === ''){
											message.innerText = "Chọn khu vực ship";
											kq={{$totalPrice}}
											document.getElementById("fee").innerHTML =kq.toLocaleString('us', {maximumFractionDigits: 2});;
										}
										else if (value === '1'){
											var x=40000;
											ship=document.getElementById("ship").innerHTML =x.toLocaleString('us', {maximumFractionDigits: 2});
											kq={{$totalPrice}}+x
											document.getElementById("fee").innerHTML =kq.toLocaleString('us', {maximumFractionDigits: 2});;
										// document.getElementById("fee").innerHTML = "<p style="hidden">40000</p>";
										// alertdocument.getElementById("fee").value().toLocaleString('us', {maximumFractionDigits: 2});

										}
										else if (value === '0'){
											var x=35000;
											ship=document.getElementById("ship").innerHTML = x.toLocaleString('us', {maximumFractionDigits: 2});
											kq={{$totalPrice}}+x;
											document.getElementById("fee").innerHTML =kq.toLocaleString('us', {maximumFractionDigits: 2});
										}
									}
							</script>
						</div>
						<div class="your-order-head"><h5><strong>Hình thức thanh toán</strong></h5></div>
						
						<div class="your-order-body">
							<ul class="payment_methods methods">
								<li class="payment_method_bacs">
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD(35000VND)" checked="checked" data-order_button_text="">
									<label style="font-weight: bold" for="payment_method_bacs">Thanh toán khi nhận hàng </label>
									<div class="payment_box payment_method_bacs" style="display: block; font-weight: bold">
										Đơn hàng sẽ được giao đến địa chỉ của bạn trong khoảng 3-5 ngày.
									</div>						
								</li>

								<li class="payment_method_cheque">
									<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
									<label style="font-weight: bold" for="payment_method_cheque">Chuyển khoản </label>
									<div class="payment_box payment_method_cheque" style="display: none; font-weight: bold">
										Chuyển tiền đến tài khoản sau:
										<br>- Số tài khoản: 0381000431582
										<br>- Chủ TK: Nguyễn Đức Quy
										<br>- Vietcombank Chi nhánh Thủ Đức
									</div>						
								</li>
								
							</ul>
						</div>

						<div class="text-center"><button type="submit" class="beta-btn primary" href="#">Thanh toán<i class="fa fa-chevron-right"></i></button></div>
					</div> <!-- .your-order -->
				</div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection