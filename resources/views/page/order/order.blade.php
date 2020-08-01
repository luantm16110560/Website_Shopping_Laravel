@extends('master')
@section('content')
<?php  $sum=0; ?>

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
		<form autocomplete="off" action="{{route('order')}}" method="post" class="beta-form-checkout">
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
						<label for="name" style="font-size: 17px;font-weight: bold">Họ tên</label>
						<input style="font-weight: bold"  type="text" class="form-control form-control-lg rounded-0" name="name" placeholder="Họ tên" value="{{Auth::user()->name}}" required>
					</div>
					@endif
					@if(Auth::check())
					<div class="form-block">
						<label for="gender" style="font-size: 17px; font-weight: bold">Giới tính</label>
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
						<label for="name" style="font-size: 17px">Mã Khách Hàng</label>
						<input type="text" class="form-control form-control-lg rounded-0" name="id_customer" placeholder="Họ tên" value="{{Auth::user()->id}}" required>
					</div>
					@endif
					@if(Auth::check())
					<div class="form-block">
						<label for="email" style="font-size: 17px;font-weight: bold">Email</label>
						<input style="font-weight: bold" type="email" class="form-control form-control-lg rounded-0" id="email" name="email" required  value="{{Auth::user()->email}}">
					</div>
					@endif
					
					<div class="form-block">
						<label  style="font-size: 17px;font-weight: bold">Thành phố</label>
						<select  class="province" name="province" id="province">
							@if(Auth::user()->user_city!='')
							<option value="{{json_decode(Auth::user()->user_city)->province_id}}">{{json_decode(Auth::user()->user_city)->province}}</option>
							@endif 
							@foreach($list_city as $city)
							<option value="{{$city->id}}" onChange="getDistrict({{$city->id}})" >{{$city->name}}</option>
							@endforeach
						</select>
					
						
					</div>
					<div class="form-block">
						<label  style="font-size: 17px;font-weight: bold">Quận/Huyện</label>
						<select  class="district" name="district" id="district">
							@if(Auth::user()->user_city!='')
							<option value="{{json_decode(Auth::user()->user_city)->district_id}}">{{json_decode(Auth::user()->user_city)->district}}</option>
							@endif
							@foreach($list_district as $district)
							<option value="{{$district->id}}">{{$district->name}}</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-block">
						<label  style="font-size: 17px;font-weight: bold">Phường/Xã</label>
						<select  class="ward" name="ward" id="ward">
							@if(Auth::user()->user_city!='')
							<option value="{{json_decode(Auth::user()->user_city)->ward_id}}">{{json_decode(Auth::user()->user_city)->ward}}</option>
							@endif
							@foreach($list_ward as $ward)
							<option value="{{$ward->id}}">{{$ward->name}}</option>
							@endforeach
						</select>
					</div>
					<input type="hidden" id="arr" name="arr" value="c">
					

					@if(Auth::check())
					<div class="form-block">
						<label for="adress" style="font-size: 17px;font-weight: bold">Địa chỉ</label>
						<input style="font-weight: bold" type="text" class="form-control form-control-lg rounded-0" id="address" name="address"  required value="{{Auth::user()->address}}">
						@if(Auth::user()->user_city!='')
						<span class="pull-right" >
							<span id="ward_" name="ward_" style="font-weight:bold">{{json_decode(Auth::user()->user_city)->ward}}</span>,
							<span id="district_" name="district_" style="font-weight:bold">{{json_decode(Auth::user()->user_city)->district}}</span>,
							<span id="province_" name="province_" style="font-weight:bold">{{json_decode(Auth::user()->user_city)->province}}</span>
						</span>
						@endif
					</div>
					@endif
					<script>

						


						$("#address").mouseout(function() {
							//alert('out')
							array.address=$("#address").val()
							//console.log(array);
							var myJSON = JSON.stringify(array);
					  		 $('#arr').val(myJSON);
						});
						
						$("#address").change(function() {
							array.address=$("#address").val()
							//console.log(array);
							var myJSON = JSON.stringify(array);
					   	$('#arr').val(myJSON);
						});
						
							
						var array = {
						province_id: $("#province").val(), 
						province: $("#province option:selected").text(), 
						district_id:$("#district").val(),
						district: $("#district option:selected").text(), 
						ward_id: $("#ward").val(),
						ward: $("#ward option:selected").text(),
						address: $("#address").val()
						};
						//console.log(array);
						var myJSON = JSON.stringify(array);
					   $('#arr').val(myJSON);

						
				   
				   $("#province").click(function() {
					   //alert($("#province").val()+'-'+$("#province option:selected").text())
					   //$('option:selected').remove();
					   array.province_id=$("#province").val();
					   array.province=$("#province option:selected").text();

					   
				   });
				   $("#district").click(function() {
					   //alert($("#province").val()+'-'+$("#province option:selected").text())
					   //$('option:selected').remove();
					   array.district_id=$("#district").val();
					   array.district=$("#district option:selected").text();
					   //$("#district_" ).text('');
				   });
				   $("#ward").click(function() {
					   array.province_id=$("#province").val();
					   array.province=$("#province option:selected").text();
					   array.ward_id=$("#ward").val();
					   array.ward=$("#ward option:selected").text();
					   array.district_id=$("#district").val();
					   array.district=$("#district option:selected").text();
					   //$("#ward_" ).text('');
				   });
			   
				   $("select.province").change(function(){

					
					   $("#province_" ).text($("#province option:selected").text());



					   array.province=$("#province option:selected").text();

					   var id_province = $(".province option:selected").val();

					   array.province_id=id_province;

					   //console.log(array);
					   $("#district").empty();
					   $.get("/province/district/" + id_province, function(data, status) {
						   
						   
					   $('#district').append($('<option>', { 
						   value: '0',
						   text : ' ' 
						   }));
						   
						   for(let i=0;i<data.length;i++)
						   {
							   //console.log(data)
							   //console.log(data[i].id+' : '+data[i].name);
							   $('#district').append($('<option>', { 
								   value: data[i].id,
								   text : data[i].name 
							   }));
						   }
						   
					   });
					   array.province_id=$("#province").val();
					   array.province=$("#province option:selected").text();
					   var myJSON = JSON.stringify(array);
					   $('#arr').val(myJSON);
				   });
			   
				   $("select.district").change(function(){

					   $("#district_" ).text($("#district option:selected").text());

					   array.district=$("#district option:selected").text();
					   
					   var id_district = $(".district option:selected").val();

					   //console.log(array);
					   array.district_id=id_district;

					   $("#ward").empty();
					   $.get("/district/ward/" + id_district, function(data, status) {

						   $('#ward').append($('<option >', { 
							   value: '0',
							   text : ' ' 
							   }));
						   //console.log(data);
						   for(let i=0;i<data.length;i++)
						   {
							   //console.log(data[i].name);
							   $('#ward').append($('<option>', { 
								   value: data[i].id,
								   text : data[i].name 
							   }));
						   }
						   
					   });
					   array.province_id=$("#province").val();
					   array.province=$("#province option:selected").text();
					   //alert(id_district)
					   var myJSON = JSON.stringify(array);
					   $('#arr').val(myJSON);
					   console.log(array)
				   });
				   
				   $("select.ward").change(function(){
					   
					   $("#ward_" ).text($("#ward option:selected").text());

					   array.ward=$("#ward option:selected").text();

					   var id_ward = $(".ward option:selected").val();

					   array.ward_id=id_ward;
					   
					   var myJSON = JSON.stringify(array)
					   $('#arr').val(myJSON);
					   //console.log(array);
				   });
				   // $('#address').on('input', function() {
				   // 	alert('change');
				   // });
				   
		   
			   </script>
					@if(Auth::check())
					<div class="form-block">
						<label for="phone" style="font-size: 17px;font-weight: bold">Điện thoại</label>
						<input style="font-weight: bold" type="number" min="0" class="form-control form-control-lg rounded-0" id="phone" name="phone" required value="{{Auth::user()->phone}}">
					</div>
					@endif
					<div class="form-block">
						<label for="notes" style="font-size: 17px;font-weight: bold">Ghi chú</label>
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
								@if(Auth::check())
								@foreach($list_sp as $like)
								<!--  one item	 -->
									<div class="media">
										<a  class="pull-left" href="{{route('product-detail',$like->product_id)}}"><img src="source/image/product/{{$like->product_image}}" alt="" height="30px"></a>
										<div class="media-body">
											<p class="font-large">{{$like->product_name}}</p>
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
																{{$like->amount}}
														{{-- <input type="number" name="Qty" id="sl"  class="text-left" width="1000px" min="1" value="{{$cart['qty']}}" onchange="myFunction();"> --}}

														</span>
												   </td>
												   <td class="text-center">
												   <p>X</p>
												   </td>
												   <td >
												   <span class="cart-total-value" id="dongia"> 
													@if(($like->promotion_price)==0){{number_format($like->price)}}
													VND
													@else {{number_format($like->promotion_price)}} VND @endif</span></br>
													<span class="flash-del">@if(($like->price)!=0){{number_format($like->price)}}VND
                                             @endif </span>
												   </td>
												</tr>
												<?php
												$sum=0;
											 foreach($list_sp as $like)
											 { 
												if(($like->promotion_price)==0)
												   {
													  $sum=$sum+(($like->price)*($like->amount));
												   }
												else 
												   {
													  $sum=$sum+(($like->promotion_price)*($like->amount));
												   }
												
													
											}
											
										  ?>
											 </table>
											 <label>Size:</label><i>   {{$like->size}}</i>
										</div>
									</div>
								<!-- end one item -->
								@endforeach
								@endif
								</div>
								<div class="clearfix"></div>
								{{-- <div>
									{{$list_sp->links()}}
								</div> --}}
							</div>

							<div class="your-order-item">
								<div class="pull-left">
									<label class="your-order-f18">Tạm tính:</label>
								</div>
							<div class="pull-right"><h5 id="tamtinh" name="tamtinh" class="color-black">{{number_format($sum)}} VND</h5></div>
								<div class="clearfix"></div>
							</div>
							
							<div class="your-order-item">
								<div class="form-group" >
							
								</div>
					
								<div class="pull-left">
									<label style="font-size: 17px">Phí vận chuyển: 	</label>
								</div>
								<div class="pull-right">
								
										<h5  id="feeship"  name="ship" class="color-black" >{{number_format(35000)}} VND</h5>
								</div>
								<div class="clearfix"></div>
								
							</div>
							@if($sum!=null || $sum!=0)
							<?php $sum=$sum+35000?>
							<div class="your-order-item">
								<div class="pull-left">
									<label class="your-order-f18">Tổng cộng:</label>
								</div>
								<div class="pull-right">
								<h5 id="fee" class="color-black">{{number_format($sum)}} VND</h5>
								<input type="hidden" value="{{$sum}}" id="sum" name="sum">
									</div><br/>
								<div class="clearfix"></div>
							</div>
							@endif
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
						
						</div>
						<div class="your-order-head"><h5><strong>Hình thức thanh toán</strong></h5></div>
						
						<div class="your-order-body">
							<ul class="payment_methods methods">
								<li class="payment_method_bacs">
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
									<label style="font-weight: bold" for="payment_method_bacs">Thanh toán khi nhận hàng </label>
									<div class="payment_box payment_method_bacs" style="display: block; font-weight: bold">
										Đơn hàng sẽ được giao đến địa chỉ của bạn trong khoảng 3-5 ngày.
									</div>						
								</li>

								<li class="payment_method_cheque">
									<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
									<label style="font-weight: bold" for="payment_method_cheque">Thanh toán trực tuyến </label>
									<div class="payment_box payment_method_cheque" style="display: none; font-weight: bold">
									{{-- <a href="/payonline">
										<button type="button" class="beta-btn primary" >Thanh toán online<i class="fa fa-chevron-right"></i></button>
									</a> --}}
									
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