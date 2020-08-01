
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tìm kiếm hóa đơn theo tháng</title>
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
        <div class="left">
                <div class="row">
                    <div class="col-md-3" style="font-size: 18px; font-family:Arial, Helvetica, sans-serif">
                        <div id="sidebar" class="well sidebar-nav" style="height: 100%">
                            <h6><i style="font-size: 14px" class="glyphicon glyphicon-home"></i>
                                        <a href="{{route('admin')}}">
                                            <b style="font-size: 14px;font-family: Arial, Helvetica, sans-serif">Về trang quản trị</b>
                                            </a>
                                        </h6>
                            <ul class="nav nav-pills nav-stacked" >
                                <li class="active"><a>Hóa đơn</a></li>
                                <li><a href="{{route('list_bill_confirmed')}}">Quản lý hóa đơn</a></li>
                                {{-- <li><a href="{{route('ship')}}">Hóa đơn đang vận chuyển</a></li> --}}
                              <li><a href="{{route('search_bill')}}">Tra cứu hóa đơn</a></li>
                              <li><a href="{{route('list_bill_wait_confirm')}}">Hóa đơn chờ xác nhận</a></li>
                                <li class="active"><a>Tìm kiếm hóa đơn</a></li>
                                <li><a href="{{route('get_bill_by_day')}}">Hóa đơn theo ngày</a></li>
                            <li><a href="{{route('get_bill_by_month')}}">Hóa đơn theo tháng</a></li>
                                <li>
                                    <div class="pull-right">
                                        <a href="{{route('logout')}}">
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
                   
                <form autocomplete="off" action="{{route('result_bill_month')}}" method="get">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                    <label style="font-size: 20px">Ngày bắt đầu</label>
                                    <input type="date" name="id_search_start"  style="font-weight: bold" >
                                    <label style="font-size: 20px">Ngày kết thúc</label>
                                    <input type="date" name="id_search_end"  style="font-weight: bold" >
                                    <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Tìm kiếm</button>
                             </div>
                             
                        </form>
                        @if(Session::has('ngaynull'))
                        <div class="col-sm-6">
                        <div id="nottrue" style="text-align: center;font-weight: bold" id="message" class="alert alert-danger">
                            {{Session::get('ngaynull')}}  
                        </div>     
                      </div>   
                        @endif
                        @if(Session::has('khongtimthay'))
                        <div class="col-sm-6">
                        <div id="result_search" style="text-align:center;font-weight: bold" class="alert alert-danger">
                            {{Session::get('khongtimthay')}}
                        </div>
                        @endif
                        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
                        <script type="text/javascript"> 
                          $(document).ready( function() {
                            $('#result_search').delay(1500).fadeOut();
                          });
                          $(document).ready( function() {
                            $('#nottrue').delay(1500).fadeOut();
                          });
                        </script>
                         </div>
                    </div>
                </div>
                <div>
                          
                     
                  
</body>
</html>
   
