@extends('master')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script language="javascript">
    function message()
    {
        Swal.fire({
        icon: 'success',
        title:   '{{Session::get('order_success')}}' ,
        showConfirmButton: true,
       
        })
                      
    }
   
</script>
  @if(Session::has('order_success'))
  <script>
    message();
</script>
  @endif
<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <div class="item active" data-interval="0">
                <img src="source\image\slide\1.jpg" style="width:100%;height: 350px">

            </div>

            @foreach($my_slide as $sl)
            <div data-interval="1000" class="item">
                <img src="source\image\banner\{{$sl->image}}" style="width:100%;height: 350px">
            </div>
            @endforeach

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div style="margin:10px"></div>
            <div class="row">

                <div class="col-sm-12">
                    <div class="beta-products-list">
                        {{-- <h4>Sản phẩm của Tom's Shoe</h4> --}}

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
                                    <li><a href="{{route('gender',['client_gender'=>'Nam'])}}" style="color: blue;font-weight: bold;font-size: 25px;font-family: Open Sans">Nam</a></li>
                                    <li><a href="{{route('gender',['client_gender'=>'Nữ'])}}" style="color: pink;font-size: 25px;font-weight: bold">Nữ</a></li>


                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <div class="dropdown" style="margin-top: 15px">
                                            <a  data-toggle="dropdown" style="font-size: 20px; margin-right:7px;">Sắp xếp giá<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                            <li><a href="{{route('sortDESC')}}">Từ cao xuống thấp</a></li>
                                                <li><a href="{{route('sortASC')}}">Từ thấp đến cao</a></li>
        
                                            </ul>
                                        </div>
                                    </li>
        
                                </ul>
                            </div>
                        </nav>
                        <div class="row">
                            @foreach($product as $p)
                            <div class="col-sm-3">
                                <div class="single-item" style="max-width: 275px">
                                    @if($p->promotion_price!=0)
                                    <span class="ribbon-wrapper">
                                        <div class="ribbon ">Sale</div>
                                    </span>
                                    @endif
                                  
                                    <div class="single-item-header" style="height:270px;max-width: 275px;">
                                        <a href="{{route('product-detail',$p->id)}}"><img  style="width: auto" src="source/image/product/{{$p->image}}" alt=""></a>
                                    </div>
                                    {{-- <div class="txt-center" >
                                        <div class="rating">
                                            <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                                            <label for="star5" >☆</label>
                                            <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                                            <label for="star4" >☆</label>
                                            <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                                            <label for="star3" >☆</label>
                                            <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                                            <label for="star2" >☆</label>
                                            <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                                            <label for="star1" >☆</label>
                                            <div class="clear"></div>
                                        </div>
                                    </div> --}}
                                    <div class="single-item-body">
                                        @if(strlen($p->name)<36)
                                        <p class="single-item-title"><font>{{$p->name}}</font></p>
                                        <br>
                                        @else
                                        <p class="single-item-title"><font>{{$p->name}}</font></p>
                                        @endif
                                        {{-- <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:     </strong>{{$p->id}}</p> --}}
                                        <p class="single-item-price" style="font-size: 18px ">
                                            @if($p->promotion_price==0)
                                            <span class="flash-sale">{{number_format($p->unit_price)}} VND</span> @else
                                            <span class="flash-del">{{number_format($p->unit_price)}} VND</span>
                                            <span class="flash-sale">{{number_format($p->promotion_price)}} VND</span> 
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                      <a style=" cursor: pointer;">
                                            <span><i id="{{$p->id}}" onclick="doClick({{$p->id}})" class="fa fa-heart" style="font-size:20px;color: black"></i></span>
                                     </a>  
                                    @if(Auth::check())
                                    @foreach($like_list as $l)
                                        <script>
                                            if({{$l->id_product_like}} =={{ $p->id}}) {
                                                document.getElementById({{$p->id}}).style.color = "red"
                                            }
                                         </script>
                                         @break($l->id_product_like == $p->id)
                                    @endforeach
                                    @endif
                                       <a href="{{route('product-detail',$p->id)}}"><button class="btn btn-primary" style="background-color: #3A5C83"> Chi tiết sản phẩm <i class="fa fa-chevron-right"></i> </button></a>
                                        <div class="clearfix"></div>

                                    </div>
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
                        <div class="row">
                            {{$product->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
