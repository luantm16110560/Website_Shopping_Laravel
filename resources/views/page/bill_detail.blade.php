<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi tiết hóa đơn</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <base href="{{asset('')}}">
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
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a>Hóa đơn</a></li>
                        <li><a href="{{route('crud-bill')}}">Quản lý hóa đơn</a></li>
                        <li><a href="{{route('tracuu')}}">Tra cứu hóa đơn</a></li>
                        <li><a href="{{route('confirm')}}">Hóa đơn chờ xác nhận</a></li>
                        <li class="active"><a>Thống kê hóa đơn</a></li>
                    <li><a href="{{route('bill_day')}}">Hóa đơn theo ngày</a></li>
                    <li><a href="{{route('get_bill_quy')}}">Hóa đơn theo quý</a></li>
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
                <div class="col-sm-2">
                </div>
                <div class="col-sm-6">
                    <div style="padding: 8px; border: 10px inset #D44B47; word-wrap: break-word;">
                        <h2 style="text-align: center">Chi tiết hóa đơn</h2>
                        <br> @if(Session::has('thanhcong'))
                        <div class="alert alert-success">
                            {{Session::get('thanhcong')}}
                        </div>
                        @endif
                        @foreach($billdetail as $bd)
                        <form>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="col-sm-6">
                            <div class="form-group">
                                    <label>Sản phẩm</label>
                                    <br>
                                    <label style="text-align: center;color: royalblue"   name="name_product" id="name_product">{{$bd->product_name}}</label>
                            </div>
                            <img src="source/image/product/{{$bd->product_image}}" id="output_image" style="width:95px;height:95px" />
                            </div>
                       
                            <div class="form-group">
                                    <label>Mã sản phẩm</label>
                                    <br>
                                    <label style="text-align: center;color: royalblue"   name="id_product" id="id_product">{{$bd->product_id}}</label>                               
                            </div>
                            <div class="form-group">
                                    <label>Đơn giá</label>
                                    <br>
                                    <label style="text-align: center;color: royalblue"   name="unit_price" id="unit_price">{{$bd->unit_price}}</label>                               
                            </div>
                            <div class="form-group">
                                    <label>Số lượng</label>
                                    <br>
                                    <label style="text-align: center;color: royalblue"   name="amount" id="amount">{{$bd->amount}}</label>                               
                            </div>
                           
                      
                        </form>
                        @endforeach
                        <div class="center">
                                {{$billdetail->links()}}
                            </div>
                    </div>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>

    </div>
</body>

</html>