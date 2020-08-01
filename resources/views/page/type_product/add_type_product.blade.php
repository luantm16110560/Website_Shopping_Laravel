<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xem danh mục sản phẩm</title>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js">
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
                <h2 style="text-align: center">Danh mục</h2>
                <div class="col-sm-2">
                </div>
              <div class="col-sm-5">
                 <br>
                 <br>  
                

              <form autocomplete="off"  action="{{route('add_type_product')}}" method="post" class="pull-right" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
             
                      <div class="form-group">
                          <label>Thêm danh mục</label>
                          <input style="width: 200px" type="text" name="name" id="name"  class="form-control">
                      </div>
                   
                      
                      <input type="submit" value="Lưu thay đổi" class="btn btn-success">
                     
                    
                    
                   
                    
                  </form>
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
                  <script language="javascript">
                      function message()
                      {
                          Swal.fire({
                          icon: 'success',
                          title:   '{{Session::get('add_type_success')}}' ,
                          showConfirmButton: false,
                          timer: 2000
                          })
                                      
                      }
                  
                  </script>
                  @if(Session::has('add_type_success'))
                  <script>
                  message();
                  </script>
                  @endif
                
                </div>
            </div>
                <div class="col-sm-4">
                </div>

            </div>
        </div>
       
    </div>
</body>

</html>
