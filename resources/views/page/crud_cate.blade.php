<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý danh mục sản phẩm</title>
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
                        <li class="active"><a>Sản phẩm</a></li>
                        <li><a href="{{route('upload_product')}}">Đăng bán sản phẩm mới</a></li>
                        <li><a href="{{route('crud_product')}}">Quản lý sản phẩm</a></li>
                        <li><a href="{{route('sale_of_product')}}">Sản phẩm khuyến mãi</a></li>
                        <li class="active"><a>Danh mục sản phẩm</a></li>
                        <li><a href="{{route('cate_product')}}">Quản lý danh mục</a></li>
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
                    @if(Session::has('xoathanhcong'))
                    <div id="message" style="text-align: center;font-weight: bold" id="message" class="alert alert-success">
                        {{Session::get('xoathanhcong')}}  
                    </div>     
                    @endif
                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
                    <script type="text/javascript"> 
                      $(document).ready( function() {
                        $('#message').delay(1500).fadeOut();
                      });
                    </script>
                    <h2 style="text-align: center">Quản danh mục sản phẩm</h2>
                    <br>
        
                    <div style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <div class="col-sm-4">
                                            <th>ID</th>
                                        </div>
                                        <div class="col-sm-4">
                                            <th>Danh mục sản phẩm</th>
                                        </div>                           
                                        <div class="col-sm-4">
                                            <th>Tùy chọn</th>
                                        </div>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cate as $c)
                                    <tr>
                                            <div class="col-sm-4">
                                                    <th>{{$c->id}}</th>
                                                </div>
                                                <div  class="col-sm-4">
                                                    <th>{{$c->name}}</th>
                                                </div>
                                               
                                        <div class="col-sm-2">
                                            <td>    
                                            {{-- <a href="{{route('deleteproduct',['id_product'=>$p->id])}}" type="button" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa')"><span class="glyphicon glyphicon-trash"></span>   
                                            <a href="{{route('edit_product',['id_product'=>$p->id,'id_user'=>$p->id_type])}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> --}}
                                            <a href="{{route('deletecate',['id_cate'=>$c->id])}}" type="button" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa')"><span class="glyphicon glyphicon-trash"></span>   
                                            <a href="{{route('edit_cate',['id_cate'=>$c->id])}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>
                                            <a href="" type="button" class="btn btn-info"><span class="  glyphicon glyphicon-th-list"></span>
                                              
                                            </td>
                                        </div>
                                        <div class="col-sm-2">
                                             
                                        </div>
                                    </tr>
                                    @endforeach
                                   
                                    
                                </tbody>
                                
                            </table>
                          
                                 <div> 
                                     {{$cate->links()}}
                                </div>
                         
                        </div>
               

            </div>
        </div>

    </div>
</body>

</html>