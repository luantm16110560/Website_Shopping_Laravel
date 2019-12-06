
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý hóa đơn</title>
    <link rel="icon" href="{!! asset('source/image/icon/icon-web-title.png') !!}"/>
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
    <link rel="stylesheet" href="source/assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="source/assets/dest/css/huong-style.css">
    <script src="source/assets/dest/js/jquery.js"></script>
    <script src="source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
    <script src="source/assets/dest/vendors/animo/Animo.js"></script>
    <script src="source/assets/dest/vendors/dug/dug.js"></script>
 


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
                            <h2 style="text-align: center">Quản lý hóa đơn</h2>
                            <br>
                            
                            <div class="col-sm-6">       
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label>Mã hóa đơn</label>
                                    <input type="text" disabled class="form-control" id="id" >
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label>Tổng tiền</label>
                                    <input type="number" min="0" class="form-control" id="total">
                                  </div>
                                </div>
                              </div>
                                
                            <div class="col-sm-6">    
                                <div class="form-group">
                                  <label for="inputAddress">Ngày đặt</label >
                                  <input style="width: 250px"; type="datetime-local" class="form-control" id="date_order" placeholder="1234 Main St">
                                </div>
                              </div>
                              <div class="col-sm-4">    
                                <div class="form-group">
                                  <label >Note</label>
                                  <textarea style="margin-left: 10px"  class="form-control" id="note"></textarea>
                                </div>
                              </div>
                              <div class="col-sm-3"> 
                             
                              
                                    <label>Thanh toán</label>
                                    <input type="text" class="form-control" id="payment" style="width: 100px">
                                    <div class="col-sm-3"> 
                                  
                                <div class="col-sm-3"> 
                                <button style="margin-top: 10px" type="submit" class="btn btn-primary">Thay đổi</button>
                                <div class="col-sm-5"> 
                              </form>
                    </div>
                </div>
        
            </div>
</body>
</html>
   
