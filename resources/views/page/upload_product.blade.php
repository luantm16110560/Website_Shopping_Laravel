<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js">
    <script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <title>Đăng bán sản phẩm</title>
</head>

<body>

    <div class="left">
        <div class="container">
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
                    <h3 style="text-align: left;font-size: 20px">Đăng sản phẩm </h3>
                    <form>
                        <div class="col-sm-4">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <img id="myimage" src="source/image/product/no-image.jpg" alt="your image" style="width:280px;height:280px" />
                            <input  style="display:none;" type='file' id="imageInput" accept="image/*"/>
                            <br>
                            <div style="text-align: center">
                            <button class="btn btn-primary" id="button" name="button" value="Đăng ảnh" onclick="thisFileUpload();">Đăng ảnh</button>
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
                                    function thisFileUpload() {
                                     document.getElementById("imageInput").click();
                                      };
                             </script>
                            <br>
                            <br>
                            <div class="col-sm-4">
                               
                            </div>
                            <div class="col-sm-4">                             
                              
                            </div>
                            <div class="col-sm-4">
                                  
                            </div>          
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-5">
                                <h4 class="right" style="margin-left: 75px">Tên sản phẩm</h4>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" style="height: 25px;width: 300px; margin-top: 5px" required></input>
                            </div>
                        </div>
                        <div class="col-sm-4"> </div>
                        <div class="col-sm-8">
                            <div class="col-sm-5">
                                <h4 class="right" style="margin-left: 75px">Giới tính</h4>
                            </div>
                            <div class="col-sm-7" style="margin-top: 5px">
                                <input type="radio" name="gender">Nam
                                <input type="radio" name="gender">Nữ
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
                                    <option>{{$t->name}}</option>
                                    @endforeach
                                </select>
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

                        {{--
                        <div class="col-sm-9" style="margin-top: 5px; height: 100px;width: 380px">
                            <br>
                            <br>
                            <br>
                            <br>

                        </div>
                        <div class="col-sm-3"></div> --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>