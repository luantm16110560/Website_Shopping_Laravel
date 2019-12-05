@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đặt hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{route("home-page")}}">Trang chủ</a> / <span>Đặt hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>

<div class="container">
	<div id="content">
		
		<form action="{{route('dathang')}}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif</div>
			<div class="row">
				<div class="col-sm-6">
				<div class="your-order" >
					<div class="your-order-head"><h5><strong>Thông tin khách hàng</strong></h5></div>
					<div class="space20">&nbsp;</div>
					<div class="your-order-body" style="padding: 0px 10px">
					@if(Auth::check())
					<div class="form-block">
						<label for="name" style="font-size: 17px"><i>Họ tên</i></label>
						<input type="text" class="form-control form-control-lg rounded-0" name="name" placeholder="Họ tên" value="{{Auth::user()->name}}" required>
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
						<label for="email" style="font-size: 17px"><i>Email</i></label>
						<input type="email" class="form-control form-control-lg rounded-0" id="email" name="email" required placeholder="ducquy@gmail.com" value="{{Auth::user()->email}}">
					</div>
					@endif
					@if(Auth::check())
					<div class="form-block">
						<label for="adress" style="font-size: 17px"><i>Địa chỉ</i></label>
						<input type="text" class="form-control form-control-lg rounded-0" id="address" name="address" placeholder="Street Address" required value="{{Auth::user()->address}}">
					</div>
					@endif
					@if(Auth::check())
					<div class="form-block">
						<label for="phone" style="font-size: 17px"><i>Điện thoại</i></label>
						<input type="text" class="form-control form-control-lg rounded-0" id="phone" name="phone" required value="{{Auth::user()->phone}}">
					</div>
					@endif
					<div class="form-block">
						<label for="notes" style="font-size: 17px"><i>Ghi chú</i></label>
						<textarea id="notes" class="form-control form-control-lg rounded-0" name="notes" default="Hãy để lại ghi chú nếu cần thiết"></textarea>
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
								<div class="pull-left"><label class="your-order-f18">Tạm tính:</label></div>
								<div class="pull-right"><h5 class="color-black">@if(Session::has('cart')){{number_format($totalPrice)}} @else 0 @endif   VND</h5></div>
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
								<div class="pull-left"><label style="font-size: 17px">Phí vận chuyển:	</label></div>
								<div class="pull-right"><h5 class="color-black">@if(Session::has('cart')){{number_format(35000)}}@else 0 @endif VND</h5></div>
								<div class="pull-left"><i>**Chúng tôi áp dụng chính sách bình ổn phí vận chuyển cho tất cả các khu vực</i></div>
								<div class="clearfix"></div>
									
									{{-- <script language="javascript">

											document.getElementById("giaship").onclick = function ()
											{
												var checkbox = document.getElementsByName("ship");
                								for (var i = 0; i < checkbox.length; i++){
                   								if (checkbox[i].checked === true){
                        						alert(checkbox[i].value);
													}
												}
												<div class="pull-right"><h5 class="color-black"><span></span> VND</h5></div>
											};
									</script> --}}
									
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
								<div class="pull-left"><label class="your-order-f18">Tổng cộng:</label><i>(Đã bao gồm 10% VAT)</i></div>
								<div class="pull-right"><h5 class="color-black">@if(Session::has('cart')){{number_format($totalPrice+35000)}}@else 0 @endif VND</h5></div><br/>
								
								<div class="clearfix"></div>
							</div>
							
						</div>
						<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
						
						<div class="your-order-body">
							<ul class="payment_methods methods">
								<li class="payment_method_bacs">
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD(35000VND)" checked="checked" data-order_button_text="">
									<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
									<div class="payment_box payment_method_bacs" style="display: block;">
										Đơn hàng sẽ được giao đến địa chỉ của bạn trong khoảng 3-5 ngày.
									</div>						
								</li>

								{{-- <li class="payment_method_cheque">
									<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
									<label for="payment_method_cheque">Chuyển khoản </label>
									<div class="payment_box payment_method_cheque" style="display: none;">
										Chuyển tiền đến tài khoản sau:
										<br>- Số tài khoản: 123 456 789
										<br>- Chủ TK: Nguyễn A
										<br>- Ngân hàng ACB, Chi nhánh TPHCM
									</div>						
								</li> --}}
								
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