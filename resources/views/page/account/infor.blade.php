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
<div class="center">
    <h6 class="inner-title">Cập Nhật Thông Tin Cá Nhân</h6>
</div>
	<div id="content" class="center" >
		<form action="{{route('infor')}}" method="post" class="beta-form-checkout" autocomplete="off">
			@csrf
			<div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6" style="margin:0 auto; wight: 2000px " >
				<div class="your-order" >
					<div class="your-order-head"><h5><strong>Thông tin cá nhân</strong></h5></div>
					<div class="space20">&nbsp;</div>
					<div class="your-order-body" style="padding: 0px 10px">
					@if(Auth::check())
					<div class="form-block">
						<label for="name" style="font-size: 17px;font-weight: bold">Họ tên</label>
						<input style="font-weight: bold" type="text" class="form-control form-control-lg rounded-0" name="name" placeholder="Họ tên" value="{{Auth::user()->name}}" required>
					</div>
					@endif
                    <div class="form-block">
												<label for="gender" style="font-size: 17px; font-weight: bold">Giới tính</label>
												@if(Auth::user()->gender=="Nam")
                        						<strong>Nam</strong><input id="gender" type="radio" class="input-radio" name="gender" value="Nam" checked="true" style="width: 10%">					        
												<strong>Nữ</strong><input id="gender" type="radio" class="input-radio" name="gender" value="Nữ" style="width: 10%">
												@else
												<strong>Nam</strong><input id="gender" type="radio" class="input-radio" name="gender" value="Nam"  style="width: 10%">					        
												<strong>Nữ</strong><input id="gender" type="radio" class="input-radio" name="gender" value="Nữ" checked="true" style="width: 10%">
												@endif
					</div>
					{{-- @if(Auth::check())
					<div class="form-block">
						<label for="phone" style="font-size: 17px;font-weight: bold">Năm sinh</label>
					<input  style="font-weight: bold" type="date" class="form-control form-control-lg rounded-0" id="phone" name="phone" required value="{{Auth::user()->phone}}">
					</div>
					@endif --}}
					@if(Auth::check())
						@if(Auth::user()->provider=='google' || Auth::user()->provider=='facebook' )
							<div class="form-block">
								<label for="email" style="font-size: 17px;font-weight: bold">Email</label>
								<input style="font-weight: bold" type="email" class="form-control form-control-lg rounded-0" id="email" name="email" readonly="true" required value="{{Auth::user()->email}}">
							</div>
						@else
							<div class="form-block">
								<label for="email" style="font-size: 17px;font-weight: bold">Email</label>
								<input style="font-weight: bold" type="email" class="form-control form-control-lg rounded-0" id="email" name="email" required value="{{Auth::user()->email}}">
							</div>
						@endif
					@endif
				
				
					@if(Auth::check())

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
					<script>
							
 						var array = {
							 province_id: $("#province").val(), 
							 province: $("#province option:selected").text(), 
							 district_id:$("#district").val(),
							 district: $("#district option:selected").text(), 
							 ward_id: $("#ward").val(),
							 ward: $("#ward option:selected").text()
						
							 };
							 var myJSON = JSON.stringify(array);
							$('#arr').val(myJSON);

							 

						$("#province").click(function() {
							//alert($("#province").val()+'-'+$("#province option:selected").text())
							//$('option:selected').remove();
							array.province_id=$("#province").val();
							array.province=$("#province option:selected").text();

							//$("#province_" ).text('');
							
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
							
							var myJSON = JSON.stringify(array);
							$('#arr').val(myJSON);
							console.log(array)
						});
							
						
				
					</script>
				
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
					@if(Auth::check())
					<div class="form-block">
						<label for="phone" style="font-size: 17px;font-weight: bold">Điện thoại</label>
						<input style="font-weight: bold" type="number" min="" class="form-control form-control-lg rounded-0" id="phone" name="phone" required value="{{Auth::user()->phone}}">
					</div>
					@endif
							</div>
						<div class="col-sm-6">
							<div class="text-center"><button id="btnCapNhat" type="submit" class="btn btn-success" >Cập nhật</button></div>
						</div>
						@if(!(Auth::user()->provider=='google' || Auth::user()->provider=='facebook') )
						<div class="col-sm-6">
									<div class="right">
									<a href="{{route('change_password')}}">
										<button  type="button" enable="false" class="btn btn-success">Đổi mật khẩu</button>
										</a>
									</div>				
						</div>
						
						@endif
					
				</div>
				<div class="col-sm-3"></div>
			</div>
		
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection