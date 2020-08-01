<base href="{{asset('')}}">
<link rel="icon" href="{!! asset('source/image/icon/icon-web-title.png') !!}"/>
<link href='https://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
<link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
<link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
<link rel="stylesheet" href="source/assets/dest/css/animate.css">
<link rel="stylesheet" title="style" href="source/assets/dest/css/huong-style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@include('header')

<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            {{-- <div class="item active" data-interval="0">
                <img src="source\image\slide\1.jpg" style="width:100%;height: 350px">

            </div> --}}
            {{-- @foreach($my_slide as $sl)
            <div data-interval="1000" class="item">
                <img src="source\image\slide\{{$sl->image}}" style="width:100%;height: 350px">
            </div>
            @endforeach --}}

        </div>

        <!-- Left and right controls -->
        {{-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a> --}}
    </div>
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div style="margin:10px"></div>
            <div class="row">

                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Top 10 sản phẩm được yêu thích nhất</h4>

                        <div class="beta-products-details">
                            {{-- <p class="pull-left">Tìm thấy {{$_count}} sản phẩm</p> --}}
                            <div class="clearfix"></div>
                        </div>
                        <nav class="navbar navbar-inverse" style="background-color: #EDEDED;border-color: #EDEDED">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    {{-- <a class="navbar-brand" style="font-size: 25px;font-weight: bold">Bộ lọc|</a> --}}
                                </div>
                                <ul class="nav navbar-nav">
                                    {{--
                                    <li class="active"><a href="#">Home</a></li> --}}
                                    <li><a href="{{route('gender_sale',['client_gender'=>'Nam'])}}" style="color: blue;font-weight: bold;font-size: 25px;font-family: Open Sans">Nam</a></li>
                                    <li><a href="{{route('gender_sale',['client_gender'=>'Nữ'])}}" style="color: pink;font-size: 25px;font-weight: bold">Nữ</a></li>


                                </ul>
                                {{-- <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <div class="dropdown" style="margin-top: 15px">
                                            <a data-toggle="dropdown" style="font-size: 20px; margin-right:7px;">Sắp xếp giá<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Giảm dần</a></li>
                                                <li><a href="#">Tăng dần</a></li>
        
                                            </ul>
                                        </div>
                                    </li>
        
                                </ul> --}}
                            </div>
                        </nav>
                        <div class="row">
                            @foreach($best_like as $bl)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($bl->promotion_price!=0)
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon ">Sale</div>
                                    </div>
                                    @endif
                                    <div class="single-item-header" style="height:270px">
                                        <a href="{{route('product-detail',$bl->id)}}"><img src="source/image/product/{{$bl->image}}" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        {{-- <p class="single-item-title">{{$bl->name}}</p> --}}
                                        @if(strlen($bl->name)<36)
                                        <p class="single-item-title"><font>{{$bl->name}}</font></p>
                                        <br>
                                        @else
                                        <p class="single-item-title"><font>{{$bl->name}}</font></p>
                                        @endif
                                        {{-- <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:     </strong>{{$p->id}}</p> --}}
                                        <p class="single-item-price" style="font-size: 18px ">
                                            @if($bl->promotion_price==0)
                                            <span class="flash-sale">{{number_format($bl->unit_price)}} VND</span> @else
                                            <span class="flash-del">{{number_format($bl->unit_price)}} VND</span>
                                            <span class="flash-sale">{{number_format($bl->promotion_price)}} VND</span> 
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                      <a style=" cursor: pointer;">
                                            <span><i id="{{$bl->id}}" onclick="doClick({{$bl->id}})" class="fa fa-heart" style="font-size:20px;color: black"></i></span>
                                     </a>  
                                    @if(Auth::check())
                                    @foreach($like_list as $l)
                                        <script>
                                            if({{$l->id_product_like}} =={{ $bl->id}}) {
                                                document.getElementById({{$bl->id}}).style.color = "red"
                                            }
                                         </script>
                                         @break($l->id_product_like == $bl->id)
                                    @endforeach
                                    @endif
                                       <a href="{{route('product-detail',$bl->id)}}"><button class="btn btn-primary" style="background-color: #3A5C83"> Chi tiết sản phẩm <i class="fa fa-chevron-right"></i> </button></a>
                                        <div class="clearfix"></div>

                                    </div>
                                   <style>
                                        .top-left {
                                        position: absolute;
                                        top: 8px;
                                        left: 16px;
                                      }
                                   </style>
                                    <b style="color: red">{{$bl->count}}</b> <b>Lượt thích</b>
                                </div>
                            </div>
                            @endforeach
                            
                            <script>
                                function doClick(id) {


                                    if (document.getElementById(id).style.color == "black") // no like
                                    {

                                        //do like in controller
                                        $.get("/like/" + id, function(data, status) {
                                            if (data == "like_success") {

                                                if (status == "success") {
                                                    document.getElementById(id).style.color = "red";
                                                    $.get("/count_like", function(data, status) {
                                                        if (data >= 0) {

                                                            if (status == "success") {
                                                               document.getElementById('num_like').innerHTML=data;
                                                            
                                                            }
                                                        } 
                                                    })
                                              
                                                }
                                            } else {
                                                window.location.href = "/login";
                                            }
                                        })
                                    }
                                    if (document.getElementById(id).style.color == "red") //being like
                                    {
                                        //do like in controller
                                        $.get("/dislike/" + id, function(data, status) {
                                            if (data == "dislike_success")
                                            {
                                                if ( status == "success" ) 
                                                {

                                                    document.getElementById(id).style.color = "black";
                                                    $.get("/count_like", function(data, status) {
                                                        if (data >= 0) {

                                                            if (status == "success") {
                                                               document.getElementById('num_like').innerHTML=data;
                                                            }
                                                        } 
                                                    })
                                                    
                                                }
                                            }
                                        })

                                    }

                                }

                            </script>
                        </div>
                       

                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>

