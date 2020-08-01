<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng sản phẩm</title>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js">
    <base href="{{asset('')}}">
</head>

<body>
    <div class="left">

        <div class="row">
            <div class="col-md-3" style="font-size: 18px">
                <div id="sidebar" class="well sidebar-nav" style="height: 100%">
                    <h5><i class="glyphicon glyphicon-home"></i>
                        <a href="{{route('admin')}}">
                            <b>Về trang quản trị</b>
                        </a>
                    </h5>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a>Sản phẩm</a></li>
                        <li><a href="{{route('upload_product')}}">Đăng bán sản phẩm mới</a></li>
                        <li><a href="{{route('get_list_product')}}">Quản lý sản phẩm</a></li>
                        <li><a href="{{route('search_product')}}">Tra cứu sản phẩm</a></li>
                        <li><a href="{{route('sale_of_product')}}">Sản phẩm khuyến mãi</a></li>
                        <li class="active"><a>Danh mục sản phẩm</a></li>
                        <li><a href="{{route('get_list_type_product')}}">Quản lý danh mục</a></li>
                        <li>
                            <div class="pull-right">
                                <a href="{{route('logout')}}">
                                    <button type="button" class="btn btn-danger">Đăng xuất</button>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div style="text-align: center" class="pull-left">
                                {{ $myDate = Carbon\Carbon::now()->format('d/m/Y')}}</div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-md-9">

             
                <form autocomplete="off" action="{{route('search_product_by_id')}}" method="get">
                  @csrf
                    <div class="form-group">
                            <label style="font-size: 20px">Mã sản phẩm</label>
                            <input type="text" name="id_search"  style="font-weight: bold" >
                            <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Tìm kiếm</button>
                    </div>
                </form>
            
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
            </script>
            </div>
        </div>

    </div>
</body>

</html>