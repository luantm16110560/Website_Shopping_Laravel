
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đơn hàng giao hàng</title>
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
                {{-- <div class="col-md-3" style="font-size: 18px; font-family:Arial, Helvetica, sans-serif">
                    <div id="sidebar" class="well sidebar-nav" style="height: 100%">
                        <h6><i style="font-size: 14px" class="glyphicon glyphicon-home"></i>
                                    <a href="{{route('admin')}}">
                                        <b style="font-size: 14px;font-family: Arial, Helvetica, sans-serif">Về trang quản trị</b>
                                        </a>
                                    </h6>
                        <ul class="nav nav-pills nav-stacked" >
                            <li class="active"><a>Hóa đơn</a></li>
                            <li><a href="{{route('list_bill_confirmed')}}">Quản lý hóa đơn</a></li>
                            <li><a href="{{route('ship')}}">Hóa đơn đang vận chuyển</a></li>
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
    
                </div> --}}
                <div class="col-md-9">
                    <h2 style="text-align: center">Đơn hàng đang vận chuyển</h2>
                            <br>
                            <div style="overflow-x:auto;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <div class="col-sm-1">
                                                    <th>ID</th>
                                                </div>
                                                <div class="col-sm-2">
                                                    <th>Ngày đặt hàng</th>
                                                </div>
                                                {{-- <div class="col-sm-2">
                                                    <th>Tạm tính</th>
                                                </div>
                                                <div class="col-sm-2">
                                                    <th>Phí ship</th>
                                                </div> --}}
                                                <div class="col-sm-2">
                                                    <th>Tổng cộng</th>
                                                </div>
                                                <div class="col-sm-1">
                                                    <th>Thanh toán</th>
                                                </div>
                                                {{-- <div class="col-sm-2">
                                                    <th>Khách hàng</th>
                                                </div> --}}
                                                <div class="col-sm-1">
                                                    <th>Trạng thái</th>
                                                </div>
                                                <div class="col-sm-1">
                                                    <th>Tùy chọn</th>
                                                </div>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bill as $b)
                                            <tr>
                                                <div class="col-sm-1">
                                                    <td>{{$b->id}}</td>
                                                </div>
                                                <div class="col-sm-2">
                                                    <td>{{$b->date_order}}</td>
                                                </div>
                                                {{-- <div class="col-sm-2">
                                                    <td>{{$b->total-$b->ship}}</td>
                                                </div>
                                                <div class="col-sm-2">
                                                    <td>{{$b->ship}}</td>
                                                </div> --}}
                                                <div class="col-sm-2">
                                                    <td>{{$b->total}}</td>
                                                </div>
                                                <div class="col-sm-1">
                                                    <td style="font-weight:bold;color:green">{{$b->payment}}</td>
                                                </div>
                                                {{-- <div class="col-sm-2">
                                                    <td>{{$b->note}}</td>
                                                </div> --}}
                                                {{-- <div class="col-sm-2">
                                                    <td>{{$b->id_user}}</td>
                                                </div> --}}
                                                <div class="col-sm-1">
                                                    @if($b->isFinish==0)
                                                    <td>
                                                    <b class="left" style="color: red">Chờ xác nhận</b>
                                                    </td>
                                                    @else
                                                    <td>
                                                    <b class="left" style="color: green">Đã xác nhận</b>
                                                </td>
                                                    @endif
                                                </div>
                                                <div class="col-sm-1">
                                                    <td>       
                                                   {{-- <a href="{{route('delete_bill',['id_bill'=>$b->id])}}" type="button" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa')"><span class="glyphicon glyphicon-trash"></span> --}}
                                                    <a href="{{route('confirm_ship',['id_bill'=>$b->id])}}" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> 
                                                    <a href="{{route('ship_bill_detail',['id_bill'=>$b->id])}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span>
                                                    <a href="{{route('cancel_bill',['id_bill'=>$b->id])}}" type="button" class="btn btn-danger" onclick="return confirm('Xác nhận hủy đơn hàng')"><span class="glyphicon glyphicon-trash"></span>
                                                    </td>
                                                </div>
                                            </tr>
                                            @endforeach
                                           
                                            
                                        </tbody>
                                        
                                    </table>
                                  
                                          
                                 
                                </div>
                       
        
                </div>
            </div>
        </div>
</body>
</html>
   
