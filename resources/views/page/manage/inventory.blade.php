<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang quản trị sản phẩm</title>
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
                        <li class="active"><a>Kho hàng TomShoe</a></li>
                        <li><a href="{{route('upload_product')}}">Chức năng kho hàng 1</a></li>
                        <li><a href="{{route('get_list_product')}}">Chức năng kho hàng 2</a></li>
                        <li><a href="{{route('sale_of_product')}}">Chức năng kho hàng 3</a></li>
                        <li class="active"><a>Kho hàng TomShoe</a></li>
                        <li><a href="{{route('get_list_type_product')}}">Kho hàng TomShoe</a></li>
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
            <div class="col-md-8">
               
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col"></th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Loại sản phẩm</th>
                            <th scope="col">
                                Số lượng size<br>
                                <span >
                                    <font style="background-color:green ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> >50
                                  
                                  
                                    <font style="background-color:orange">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> >=10
                                   
                                  
                                    <font style="background-color:red ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> <10
                                    </span>
                                    
                             </th>
                            {{-- <th scope="col">
                              
                            </th> --}}
                          </tr>
                        </thead>
                  
                        <tbody>
                            @foreach($product as $p)
                          <tr>
                        
                            <th scope="row">{{$p->id}}</th>
                            <td>{{$p->name}}</td>
                            <td><img id="myimage" src="{{asset('')}}source/image/product/{{$p->image}}" alt="your image" style="width:70px;height:70px"/></td>        
                            <td>{{$p->gender}}</td>
                            <td>{{$p->name_type}}</td>
                            <td> 
                                @foreach($size_amount as $size)   
                                @if($size->id_product == $p->id)
                                    @if($size->amount>50 )   
                                <a href="{{route('product_inventory',['id_product'=>$size->id_product,'id_type'=>$p->id_type])}}">
                                    <button style="color: green;font-weight:bold"  title='{{$size->amount}}'> {{$size->size}}</p></button>
                                    </a>
                                    @endif
                                    @if($size->amount<50 && $size->amount>10 )
                                    <a href="{{route('product_inventory',['id_product'=>$size->id_product,'id_type'=>$p->id_type])}}">
                                    <button style="color: orange;font-weight:bold" title='{{$size->amount}}'> {{$size->size}}</p></button>
                                    </a>
                                    @endif
                                    @if($size->amount<=10)
                                    <a href="{{route('product_inventory',['id_product'=>$size->id_product,'id_type'=>$p->id_type])}}">
                                        <button style="color: red;font-weight:bold" title='{{$size->amount}}'> {{$size->size}}</p></button>
                                    </a>
                                    @endif
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                      
                      </table>
                      <div style="text-align: center">
						{{$product->links()}}
					</div>
                     
                   
                     
            </div>
        
            </div>
        </div>

    </div>
</body>

</html>