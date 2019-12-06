<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang quản trị hóa đơn</title>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js">
    <script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
</head>

<body>
    <div class="left">

        <div class="row">
            <div class="col-md-3" style="font-size: 18px">
                <div id="sidebar" class="well sidebar-nav" style="height: 100%">
                    <h5><i class="glyphicon glyphicon-home"></i>
                                <a href="{{route('manager-page')}}">
                                    <b>Về trang quản trị</b>
                                    </a>
                                </h5>
                    <ul class="nav nav-pills nav-stacked">
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
                    <h2 style="text-align: center">Trang quản trị hóa đơn</h2>

                    <br>
               

            </div>
        </div>

    </div>
</body>

</html>