<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng sản phẩm</title>
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

                @if(Session::has('thongbao'))
                <div class="alert alert-success" style="text-align: center; font-size: 16px; font-weight: bold">{{Session::get('thongbao')}}</div>
                @endif
                   <h2 style="text-align: center">Đăng sản phẩm mới</h2>
        
                <form action="{{route('add_product')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="col-sm-4">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <img id="myimage" src="source/image/product/no-image.jpg" alt="your image" style="width:280px;height:280px" />
                        <input style="display:none;" type='file' id="imageInput" name="imageInput" accept="
                                    image/*" />
                        <br>
                        <div style="text-align: center">
                            <input type="button" id="button" name="button" class="btn btn-primary" value="Hình" onclick="document.getElementById('imageInput').click();" />
                        </div>
                        <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function(e) {
                                        $('#myimage').attr('src', e.target.result);
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
                                <img id="output_image" style="width:95px;height:95px" />
                                <input style="display:none;" type="file" accept="image/*" id="imageInput1" name="imageInput1" onchange="preview_image(event)">
                            </div>
                            <br>
                            <input type="button" class="btn btn-primary" id="button1" name="button1" value="Hình 1" onclick="document.getElementById('imageInput1').click();" />
                            <script type='text/javascript'>
                                function preview_image(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('output_image');
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
                                <img id="myid" style="width:95px;height:95px" />
                                <input style="display:none;" type='file' id="demo" name="imageInput2" accept="image/*" />
                            </div>
                            <br>
                            <input type="button" class="btn btn-primary" id="button2" name="button2" value="Hình 2" onclick="document.getElementById('demo').click();" />
                            <script>
                                function display(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(event) {
                                            $('#myid').attr('src', event.target.result);
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

                    </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Tên sản phẩm</h4>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="name" style="height: 25px;width: 300px; margin-top: 5px" required></input>
                        </div>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Giới tính</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top: 5px">
                            <input type="radio" name="gender" required value="Nam">Nam
                            <input type="radio" name="gender" value="Nữ">Nữ
                        </div>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Loại sản phẩm</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top: 5px; height: 25px;width: 300px">
                            <select class="form-control" name="select">
                                @foreach ($type as $t)
                                <option value="{{$t->id}}">{{$t->name}}</option>
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
                            <input type="number" name="unit_price" required>
                            <label>Giá gốc</label>
                            <input type="number" min=0 name="promotion_price" value="0">
                            <label>Khuyến mãi</label>

                        </div>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Size</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top: 5px">
                            <input type="number" name="size" min=35 max=43 value="35" required>
                            <label>size</label>

                        </div>
                    </div>

                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Mô tả</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top:5px">
                            <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
                            <textarea name="description"></textarea>
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                        </div>
                    </div>

                    <input type="submit" id="button" name="button" class="btn btn-success" value="Lưu" style="width: 450px;height: 50px ;text-align: center" />

                </form>

            </div>
        </div>

    </div>
</body>

</html>