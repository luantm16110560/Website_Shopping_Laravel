<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <title>Trang quản lý sản phẩm</title>
</head>
<body>
        <div class="left">
                <div class="row">
                    <div class="col-md-3" style="font-size: 18px">
                        <div id="sidebar" class="well sidebar-nav" style="height: 100%">
                            <h5><i class="glyphicon glyphicon-home"></i>
                            <a href="{{route('home-page')}}">
                                <b>Về trang chủ</b>
                                </a>
                            </h5>
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a>Sản phẩm</a></li>
                                <li><a href="{{route('upload_product')}}">Đăng bán sản phẩm mới</a></li>
                                <li><a href="{{route('crud_product')}}">Quản lý sản phẩm</a></li>
                                <li><a href="{{route('sale_of_product')}}">Sản phẩm khuyến mãi</a></li>
                                <li class="active"><a>Danh mục sản phẩm</a></li>
                                <li><a href="{{route('cate_product')}}">Quản lý danh mục</a></li>
                              
                            </ul>
                            {{-- <h5><i class="glyphicon glyphicon-user"></i>
                                <b>Tài khoản</b>
                            </h5>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">List</a></li>
                                <li><a href="#">Manage</a></li>
                            </ul> --}}
                            <br>
                            <div class="pull-right">
                            <a href="{{route('dangxuat')}}">
                            <button type="button" class="btn btn-danger">Đăng xuất</button>
                             </a>
                            </div>
                            <br>
                            <br>
                            
                            <br>
                            <br>
                            <div style="text-align: center"> {{ $myDate = Carbon\Carbon::now()->format('d/m/Y')}}
        
                            </div>
                        </div>
                  
                    </div>
                    <div class="col-md-9">
                
                    <h2 style="text-align: center">Trang quản lý sản phẩm</h2>
               
                    </div>
                </div>
        </div>
        
</body>
</html>



