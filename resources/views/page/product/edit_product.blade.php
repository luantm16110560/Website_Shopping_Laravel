<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin sản phẩm</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                            <div style="text-align: center" class="pull-left"> {{ $myDate = Carbon\Carbon::now()->format('d/m/Y')}}</div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-md-9">

            
                {{-- <div  id="success" class="alert alert-success" style="text-align: center; font-size: 16px; font-weight: bold">{{Session::get('edit_pro_success')}}</div> --}}
             
               
              
            
                   <h2 style="text-align: center">Thông tin sản phẩm</h2>
               
            <form action="{{route('editproduct',['id_product'=>$p->id])}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="col-sm-4">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <img id="img" name="img" src="source/image/product/{{$p->image}}" alt="your image" style="width:100%;height:100%" />
                   
                        <input style="display:none;" type='file' id="imageInput" name="imageInput" accept="
                                    image/*"  />
                        <br>
                        <div style="text-align: center">
                        <input type="button" id="button"  name="button" class="btn btn-primary" value="Hình" onclick="document.getElementById('imageInput').click();" />
                        </div>
                        <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function(e) {
                                        $('#img').attr('src', e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                            $("#imageInput").change(function() {
                                readURL(this);
                            });
                        </script>
                        <br>
                        <br>
                        <div class="col-sm-3">
                            <div>
                              
                                <img src="source/image/product/{{$p->img1}}" id="img1"  name="img1" style="width:100px;height:100px" />
                                
                                <input style="display:none;" type="file" accept="image/*" id="imageInput1" name="imageInput1" onchange="preview_image(event)">
                            </div>
                            <br>
                            <input type="button" class="btn btn-primary" id="button1" name="button1" value="Hình 1" onclick="document.getElementById('imageInput1').click();" />
                            <script type='text/javascript'>
                                function preview_image(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('img1');
                                        output.src = reader.result;
                                    }
                                    reader.readAsDataURL(event.target.files[0]);
                                }
                            </script>
                        </div>
                        <div class="col-sm-1">
                        </div>

                        <div class="col-sm-3">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                            <div>
                                <img src="source/image/product/{{$p->img2}}" id="img2"  name="img2" style="width:100px;height:100px" />
                                <input style="display:none;" type='file' id="demo" name="imageInput2" accept="image/*" />
                            </div>
                            <br>
                            <input type="button" class="btn btn-primary" id="button2" name="button2" value="Hình 2" onclick="document.getElementById('demo').click();" />
                            <script>
                                function display(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(event) {
                                            $('#img2').attr('src', event.target.result);
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#demo").change(function() {
                                    display(this);
                                });

                                function thisFileUpload2() {
                                    document.getElementById("demo").click();
                                }
                            </script>
                        </div>
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-3">
                            <div>
                                <img src="source/image/product/{{$p->img3}}" id="img3"  name="img3" style="width:100px;height:100px" />
                                <input style="display:none;" type="file" accept="image/*" id="imageInput3" name="imageInput3" onchange="preview_image_3(event)">
                            </div>
                            <br>
                            <input type="button" class="btn btn-primary" id="button3" name="button3" value="Hình 3" onclick="document.getElementById('imageInput3').click();" />
                            <script type='text/javascript'>
                                function preview_image_3(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('img3');
                                        output.src = reader.result;
                                    }
                                    reader.readAsDataURL(event.target.files[0]);
                                }
                            </script>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Tên sản phẩm</h4>
                        </div>
                        <div class="col-sm-7">
                        <input type="text" name="name" style="height: 25px;width: 300px; margin-top: 5px" value="{{$p->name}}" required>
                        </div>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Giới tính</h4>
                        </div>
                        @if($p->gender=="Nam")
                        <div class="col-sm-7" style="margin-top: 5px">
                            <input type="radio" name="gender" checked="true" required value="Nam">Nam
                            <input type="radio" name="gender" value="Nữ">Nữ
                        </div>
                        @else
                        <div class="col-sm-7" style="margin-top: 5px">
                            <input type="radio" name="gender"  required value="Nam">Nam
                            <input type="radio" name="gender" checked="true" value="Nữ">Nữ
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Loại sản phẩm</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top: 5px; height: 25px;width: 300px">
                            <select class="form-control" name="select" id="select">
                                <option value="{{$tid->id}}">{{$tid->name}}</option>
                                @foreach ($t as $type)
                               
                                <option  value="{{$type->id}}">
                                  {{$type->name}}
                                </option>
                                @endforeach
                              
                            </select>
                        
                        </div>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Giá sản phẩm</h4>
                            
                        </div>
                        <div class="col-sm-7" style="margin-top: 5px">
                      
                          <div class="col-sm-6">
                            <label>Giá gốc</label>
                            <input type="number" name="unit_price" value="{{$p->unit_price}}" required>
                          </div>
                          <div class="col-sm-6">
                            <label>Khuyến mãi</label>
                            <input type="number" min=0 name="promotion_price" value="{{$p->promotion_price}}" required>
                          </div>

                        </div>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Size & Số lượng</h4>
                        </div>
                      
                        <div class="col-sm-7" style="margin-top: 5px">
                            <a href="#addSize" data-toggle="modal"><button type="button" class="btn btn-success" >Thêm </button></a>
                           
                        @foreach($list_size as $size)
                  
                        <div class="col-sm-9">
                        <input type="number" disabled style="width: 40px" value="{{$size->value}}"> 
                
                        <input style="width: 60px;text-align: center" type="number" value="{{$size->amount}}" readonly>
                        <a href="{{route('delete_size',['id_product'=>$p->id,'size'=>$size->value])}}">
                            <button type="button" onclick="return confirm('Bạn có muốn xóa')" class="btn btn-danger" style="height: 30px;width: 40px;margin:2px"><span style="font-size: 13px" class="glyphicon glyphicon-trash"></span> </button>
                        </a>
                        <a href="#editSize" onclick="document.getElementById('edit_size').value='{{$size->value}}';document.getElementById('edit_amount').value='{{$size->amount}}';" data-toggle="modal" >
                            <button   type="button" class="btn btn-primary" style="height: 30px;width: 40px;margin:2px"><span style="font-size: 13px" class="glyphicon glyphicon-pencil"></span> </button>
                        </a>
                     


                        </div>
                      
                        @endforeach
                      
                    </div>
               
                
                        <div>
                    
                      
                        </div>
                      
                       
                    </div>
                   

                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Mô tả</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top:5px">
                            <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
                        <textarea id="des" name="description" >{{$p->description}}</textarea>
                  
                            <script>
                                CKEDITOR.replace('description');                   
                            </script>

                        </div>
                    </div>

                    <input  type="submit" id="button" name="button" class="btn btn-success" value="Lưu" style="width: 450px;height: 50px ;text-align: center"  />


                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
                    <script language="javascript">
                        function message()
                        {
                            Swal.fire({
                            icon: 'success',
                            title:   '{{Session::get('edit_pro_success')}}' ,
                            showConfirmButton: false,
                            timer: 2000
                            })
                                          
                        }
                       
                    </script>
                      @if(Session::has('edit_pro_success'))
                      <script>
                        message();
                    </script>
                      @endif

                </form>
                

            </div>
        </div>
      
    </div>


    <div id="addSize" class="modal fade" >
        <div class="modal-dialog" >
            <div class="modal-content">
                
                <form action="{{route('add_new_size',$p->id)}}" method="post" >
                    @csrf
                    <div class="modal-header">						
                        <h4 class="modal-title">Thêm size</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" >	
                                 
                        <div class="form-group" style="width: 30%">
                            <label>Size</label>
                            <input type="number" name="_size" class="form-control" required>
                        </div>
                        <div class="form-group"  style="width: 30%">
                            <label>Số lượng</label>
                            <input type="number" name="_amount" class="form-control" required>
                        </div>
                
                            
                    </div>
                    <div class="modal-footer">
                      
                        <input type="submit" class="btn btn-success" value="Lưu">
                        <input type="button" class="btn btn-warning" data-dismiss="modal" value="Hủy">
                    </div>
                </form>
            </div>
        </div>
    </div>
 {{-- EDIT SIZE --}}
 <div id="editSize" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-dialog" >
            <div class="modal-content">
                
            <form method="POST" action="{{route('edit_amount',$p->id)}}">
                    @csrf
                    <div class="modal-header">						
                        <h4 class="modal-title">Sửa size</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" >	
                                 
                        <div class="form-group" style="width: 30%">
                            <label>Size</label>
                            <input type="number" name="edit_size" id="edit_size"  class="form-control" readonly  >
                        </div>
                        <div class="form-group"  style="width: 30%">
                            <label>Số lượng</label>
                            <input type="number" onmouseout="check()" onkeyup="checknum()" name="edit_amount" id="edit_amount" class="form-control" required >
                        </div>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
                <script>
                    function check()
                    {
                        if(parseInt(document.getElementById('edit_amount').value) <=0 )
                        {
                            Swal.fire(
                            '',
                            'Số lượng bạn nhập sai định dạng',
                            'error'
                            )
                            document.getElementById("btnSave").disabled = true;
                        }
                      
                    }
                    function checknum()
                    {
                        if(parseInt(document.getElementById('edit_amount').value) >0 )
                        {
                            
                            document.getElementById("btnSave").disabled = false;
                        }
                        else
                        {
                            document.getElementById("btnSave").disabled = true;
                        }
                    }
                   
                   
                </script>
                            
                    </div>
                    <div class="modal-footer">
                      
                        <input type="submit"  id="btnSave" class="btn btn-success" value="Lưu">
                        <input type="button" class="btn btn-warning" data-dismiss="modal" value="Hủy">
                    </div>
                </form>
            </div>
        </div>
</div>
    
</body>

</html>