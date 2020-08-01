<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sản phẩm khuyến mãi</title>
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
                            <div style="text-align: center" class="pull-left"> {{ $myDate = Carbon\Carbon::now()->format('d/m/Y')}}</div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-md-9">
                    @if(Session::has('xoathanhcong'))
                    <div id="message" style="text-align: center;font-weight: bold" id="message" class="alert alert-danger">
                        {{Session::get('xoathanhcong')}}  
                    </div>     
                    @endif
                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
                    <script type="text/javascript"> 
                      $(document).ready( function() {
                        $('#message').delay(1500).fadeOut();
                      });
                    </script>
                    <h2 style="text-align: center">Sản phẩm đang khuyến mãi</h2>
                    <br>
        
                    <div style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <div class="col-sm-1">
                                            <th>ID</th>
                                        </div>
                                        <div class="col-sm-3">
                                            <th>Tên sản phẩm</th>
                                        </div>
                                        <div class="col-sm-2">
                                                <th></th>
                                            </div>
                                        <div class="col-sm-1">
                                             <th>Giới tính</th>
                                        </div>
                                        <div class="col-sm-1">
                                                <th>Loại sản phẩm</th>
                                           </div>
                                        <div class="col-sm-1">
                                            <th>Giá gốc</th>
                                        </div>
                                        <div class="col-sm-1">
                                            <th>Giá khuyến mãi</th>
                                        </div>                                  
                                        <div class="col-sm-1">
                                            <th>Size</th>
                                        </div>
                                        <div class="col-sm-1">
                                            <th>Tùy chọn</th>
                                        </div>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $p)
                                    <tr>
                                            <div class="col-sm-1">
                                                    <th>{{$p->id}}</th>
                                                </div>
                                                <div  class="col-sm-3">
                                                    <th style="width: 300px">{{$p->name}}</th>
                                                </div>
                                                <div class="col-sm-2">
                                                        <th>
                                                        <img id="myimage" src="{{asset('')}}source/image/product/{{$p->image}}" alt="your image" style="width:70px;height:70px" />          
                                                        </th>
                                                    </div>
                                                <div class="col-sm-1">
                                                     <th>{{$p->gender}}</th>
                                                </div>
                                                <div class="col-sm-1">
                                                        <th>{{$p->name_type}}</th>
                                                   </div>
                                                <div class="col-sm-1">
                                                    <th>{{$p->unit_price}}</th>
                                                </div>
                                                <div class="col-sm-1">
                                                    <th>{{$p->promotion_price}}</th>
                                             </div>
                                                <div class="col-sm-1">
                                                    <th>{{$p->size}}</th>
                                                </div>
                                        <div class="col-sm-1">
                                            <td>    
                                            <a href="{{route('delete_product',['id_product'=>$p->id])}}" type="button" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa')"><span class="glyphicon glyphicon-trash"></span>   
                                            <a href="{{route('edit_product',['id_product'=>$p->id,'id_user'=>$p->id_type])}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span>
                                           
                                            </td>
                                        </div>
                                    </tr>
                                    @endforeach
                                   
                                    
                                </tbody>
                                
                            </table>
                          
                                 <div> 
                                     {{$product->links()}}
                                </div>
                         
                        </div>
               

            </div>
        </div>

    </div>
</body>

</html>