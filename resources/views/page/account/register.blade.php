@extends('master') 
@section('content')
<div class="container">
    @if(count($errors)>0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
        <div class="center" style="font-size: 16px; font-weight: bold">{{$err}}</div>
        @endforeach
    </div>
@endif
    <form class="form-horizontal" action="{{route('register')}}" method="post" autocomplete="off">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
<fieldset>

<!-- Form Name -->
<legend><center><h2><b>Đăng ký</b></h2></center></legend><br>

<!-- Text input-->
@if(Session::has('thanhcong'))
<div style="font-size: 20px" class="alert alert-success" role="alert" id="success_message">{{Session::get('thanhcong')}} <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>
@endif
<div class="form-group">
  <label class="col-md-4 control-label">Họ tên</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input required style="font-weight: bold;font-size:20px" name="name"  class="form-control"  type="text" autocomplete="off">
    </div>
  </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Giới tính</label>  
    <div class="col-md-4 inputGroupContainer">
 
    <label style="font-size: 17px;">Nam</label><input id="gender" type="radio" class="input-radio" name="gender" checked="true" value="Nam" checked="checked" style="width: 10%">
    <label style="font-size: 17px;">Nữ</label><input id="gender" type="radio" class="input-radio" name="gender" value="Nữ" style="width: 10%">
   
    </div>
  </div>

	
<div class="form-group"> 
  <label class="col-md-4 control-label">Tỉnh / Thành phố</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
        <select style="font-size:20px" class="province" name="province" id="province">
          <option value=""></option>
          @foreach($list_city as $city)
          <option value="{{$city->id}}">{{$city->name}}</option>
          @endforeach
        </select>
  </div>
</div>
</div>
<div class="form-group"> 
    <label class="col-md-4 control-label">Quận / Huyện</label>
      <div class="col-md-4 selectContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
          <select  style="font-size:20px"  class="district" name="district" id="district">
            <option></option>
          </select>
    </div>
  </div>
  </div>
  
<!-- Text input-->
<div class="form-group"> 
    <label class="col-md-4 control-label">Phường / Xã</label>
      <div class="col-md-4 selectContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
          <select style="font-size:20px"  class="ward" name="ward" id="ward">
            <option value=""></option>
            <option></option>
          </select>
    </div>
  </div>
  </div>


  

<div class="form-group">
  <label class="col-md-4 control-label">Địa chỉ</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input style="font-weight: bold;font-size:20px" required  name="address" class="form-control"  type="text" autocomplete="off">
    </div>
  </div>
  <span style="margin-top: 10px;font-size:18px" class="pull-right" >
    <span id="ward_" name="ward_" style="font-weight:bold"></span>,
    <span id="district_" name="district_" style="font-weight:bold"></span>,
    <span id="province_" name="ward_" style="font-weight:bold"></span>
  </span>
</div>
<div class="form-group">
  <label class="col-md-4 control-label">Tên đăng nhập</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input style="font-weight: bold;font-size:20px" required  name="username" class="form-control"  type="text" autocomplete="off">
    </div>
  </div>
  <span style="margin-top: 10px;font-size:18px" class="pull-right" >
    <span id="ward_" name="ward_" style="font-weight:bold"></span>,
    <span id="district_" name="district_" style="font-weight:bold"></span>,
    <span id="province_" name="ward_" style="font-weight:bold"></span>
  </span>
</div>
<input type="hidden" id="arr" name="arr" value="c">
<script>
  var array = {province_id: "", province: "", district_id:"",district: "", ward_id: "",ward: ""};

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
    var myJSON = JSON.stringify(array);
    $('#arr').val(myJSON);
  });


  $("select.district").change(function(){

    $("#district_" ).text($("#district option:selected").text());

    array.district=$("#district option:selected").text();
    
    var id_district = $(".district option:selected").val();

    array.district_id=id_district;


    //console.log(array);

    $("#ward").empty();
    $.get("/district/ward/" + id_district, function(data, status) {
      //console.log(data);

      $('#ward').append($('<option >', { 
          value: '0',
          text : ' ' 
        }));
     
       for(let i=0;i<data.length;i++)
      {
        //console.log(data[i].name);
        $('#ward').append($('<option>', { 
          value: data[i].id,
          text : data[i].name 
        }));
      }
     
      
    });
    //alert(id_district)
    var myJSON = JSON.stringify(array);
    $('#arr').val(myJSON);
  });
  

  

  $("select.ward").change(function(){
    
    $("#ward_" ).text($("#ward option:selected").text());

    array.ward=$("#ward option:selected").text();

    var id_ward = $(".ward option:selected").val();

    array.ward_id=id_ward;


   // console.log(array);

    var myJSON = JSON.stringify(array);
    $('#arr').val(myJSON);
  });
    

</script>
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Mật khẩu</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input style="font-weight: bold;font-size:20px" required name="password" id="password" class="form-control"  type="password" autocomplete="off">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Xác nhận mật khẩu</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input style="font-weight: bold;font-size:20px" required name="cpassword" id="confirm_password" class="form-control"  type="password" autocomplete="off" onkeyup="check()">
    </div>
  </div>
  <span style="font-size: 15px;  font-weight: bold;" class="right" id='message'></span>
</div>

<!-- Text input-->
       <div class="form-group">
  <label class="col-md-4 control-label">E-Mail</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input style="font-weight: bold;font-size:20px" required name="email"  class="form-control"  type="email" autocomplete="off">
    </div>
  </div>
</div>


<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">Điện thoại</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input style="font-weight: bold;font-size:20px" required name="phone"  class="form-control" type="number" autocomplete="off">
    </div>
  </div>
</div>

<!-- Select Basic -->

<!-- Success message -->


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
  
    <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Đăng ký</button>
    <script>
        var check = function() {
            if (document.getElementById('password').value == document.getElementById('confirm_password').value)
            {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = '<i class="fa fa-check"></i> Mật khẩu trùng khớp';
                document.getElementById("btnLogin").disabled = false;
            } 
            else 
            {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = '<i class="fa fa-times"></i> Mật khẩu không khớp';
                document.getElementById("btnLogin").disabled = true;
            }
        }
    </script>
</div>
</div>

</fieldset>

</form>

</div>
    </div><!-- /.container -->
@endsection