
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sửa hóa đơn</title>
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <!--customjs-->

    
</head>
<body>
        <div class="left">

                <div class="row">
                    <div class="col-md-3" style="font-size: 18px; font-family:Arial, Helvetica, sans-serif">
                        <div id="sidebar" class="well sidebar-nav" style="height: 100%">
                            <h6><i style="font-size: 14px" class="glyphicon glyphicon-home"></i>
                                        <a href="{{route('manager-page')}}">
                                            <b style="font-size: 14px;font-family: Arial, Helvetica, sans-serif">Về trang quản trị</b>
                                            </a>
                                        </h6>
                            <ul class="nav nav-pills nav-stacked" >
                                <li class="active"><a>Hóa đơn</a></li>
                                <li><a href="{{route('crud-bill')}}">Quản lý hóa đơn</a></li>
                                <li><a href="#">Tra cứu hóa đơn</a></li>
                                <li><a href="#">Hóa đơn chờ xác nhận</a></li>
                                <li class="active"><a>Thống kê hóa đơn</a></li>
                                <li><a href="#">Hóa đơn theo ngày</a></li>
                                <li><a href="#">Hóa đơn theo quý</a></li>
                                <li>
                                    <div class="pull-right">
                                        <a href="{{route('dangxuat')}}">
                                            <button type="button" class="btn btn-danger">Đăng xuất</button>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div style="text-align: center" class="pull-left"> {{ $myDate = Carbon\Carbon::now()->format('d/m/Y')}}</div>
                                </li>
                            </ul>
                        </div>
        
                    </div>
                    <div class="col-md-9">
                        <div class="col-sm-4">
                          </div>
                      <div class="col-sm-4">
                            <h2 style="text-align: center">Sửa hóa đơn</h2>
                            <br>
                            <form autocomplete="off" method="post" >
                              <div class="form-group">
                                  <label>ID</label>
                                  <input style="width: 100px" type="text" name="id" id="id" value="{{$bill->id}}" class="form-control" disabled>
                              </div>
                              <div class="form-group">
                                  <label>Ngày đặt</label>
                                  <input style="width: 200px" type="datetime" name="date_order" id="date_order" value="{{$bill->date_order}}" class="form-control">
                              </div>
                              <div class="form-group">
                                  <label>Tổng tiền</label>
                                
                              <input style="width: 150px" type="number" min="0" name="total" id="total" value="{{$bill->total}}" class="form-control">VND
                              </div>
                          
                              <div class="form-group">
                                  <label>Thanh toán</label>
                                  <select id="payment" >
                                     <option value="COD">COD</option>
                                     <option value="ATM">ATM</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Ghi chú</label>
                              <textarea style="width: 200px" name="note" id="note" class="form-control">{{$bill->note}}</textarea>
                              </div>
                              <div class="form-group">
                                  <label>Khách hàng</label>
                               
                                  <button type="button" style="width: 200px" name="id_user" id="id_user" onclick="getUser();" class="btn btn-primary" value="{{$user->id}}">{{$user->name}}</button>
                                  <input type="hidden" id="name" value="{{$user->name}}">
                                  <input type="hidden" id="email" value="{{$user->email}}">
                                  <input type="hidden" id="address" value="{{$user->address}}">
                                  <input type="hidden" id="gender" value="{{$user->gender}}">
                                  <input type="hidden" id="phone" value="{{$user->phone}}">
                              </div>
                              <div class="form-group">
                                  <select id="isFinish" >
                                      <option value="1" style="color: green"><b>Xác nhận</b></option>
                                      <option value="0" style="color: red"><b>Hủy xác nhận</b></option>
                                   </select>
                              </div>
                          
                              <input type="submit" value="Lưu thay đổi" class="btn btn-success">
                          </form>
                        </div>
                        <div class="col-sm-4">
                        </div>

                        <script>
                          function getUser()
                              {
                              
                               var name=document.getElementById("name").value;
                               var gender=document.getElementById("gender").value;
                               var email=document.getElementById("email").value;
                               var address=document.getElementById("address").value;
                               var phone=document.getElementById("phone").value;
                                alert(name +"\n" +gender+"\n"+email+"\n"+address+"\n"+phone);
                              
                            }
                        </script>
                      </div>
                </div>
        
            </div>
</body>
</html>
   
