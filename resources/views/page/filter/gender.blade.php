
@extends('master')
@section('content')


<div class="container">
    
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
        <h3 class="center">Giày dành cho <font id="gen_h3">{{$gen}}</font></h3>
        {{-- <input type="hidden" value="{{$gen}}" name="gengen"> --}}
            <div class="row">
                <script>onload_()</script>
                    <nav class="navbar navbar-inverse" style="background-color: #EDEDED;border-color: #EDEDED">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    {{-- <a class="navbar-brand" style="font-size: 25px;font-weight: bold">Bộ lọc|</a> --}}
                                </div>
                                <ul class="nav navbar-nav">
                                    {{--
                                    <li class="active"><a href="#">Home</a></li> --}}
                                    @if($gen=='Nam')
                                    <li><a  href="{{route('gender',['client_gender'=>'Nam'])}}" style="color: blue;font-weight: bold;font-size: 25px;font-family: Open Sans"><font style="border: solid 3px; padding: 6px">Nam</font></a></li>
                                    @else
                                    <li><a  href="{{route('gender',['client_gender'=>'Nam'])}}" style="color: blue;font-weight: bold;font-size: 25px;font-family: Open Sans">Nam</a></li>
                                    @endif
                                    @if($gen=='Nữ')
                                    <li><a href="{{route('gender',['client_gender'=>'Nữ'])}}" style="color: pink;font-size: 25px;font-weight: bold"><font style="border: solid 3px; padding: 6px">Nữ</font></a></li>
                                    @else
                                    <li><a href="{{route('gender',['client_gender'=>'Nữ'])}}" style="color: pink;font-size: 25px;font-weight: bold">Nữ</a></li>
                                    @endif
                                    
        
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <div class="dropdown" style="margin-top: 15px">
                                            <a data-toggle="dropdown" style="font-size: 20px; margin-right:7px;">Sắp xếp giá<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                            <li><a href="{{route('genderDESC',$gen,'desc')}}">Từ cao đến thấp</a></li>
                                            <li><a href="{{route('genderASC',$gen,'asc')}}">Từ thấp đến cao</a></li>
        
                                            </ul>
                                        </div>
                                    </li>
        
                                </ul>
                            </div>
                        </nav>
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        {{-- <h4>Tìm kiếm </h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{$_count}} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div> --}}

                        <div class="row">
                            @foreach($pro as $sp)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($sp->promotion_price!=0)
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon ">Sale</div>
                                    </div>
                                    @endif
                                    <div class="single-item-header">
                                    <a href="{{route('product-detail',$sp->id)}}"><img src="source/image/product/{{$sp->image}}" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        @if(strlen($sp->name)<36)
                                        <p class="single-item-title"><font>{{$sp->name}}</font></p>
                                        <br>
                                        @else
                                        <p class="single-item-title"><font>{{$sp->name}}</font></p>
                                        @endif
                                        {{-- <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:   </strong>{{$sp->id}}</p> --}}
                                        <p class="single-item-price" style="font-size: 18px ">
                                            @if($sp->promotion_price==0)
                                            <span class="flash-sale">{{number_format($sp->unit_price)}} VND</span> 
                                            @else
                                            <span class="flash-del">{{number_format($sp->unit_price)}} VND</span>
                                            <span class="flash-sale">{{number_format($sp->promotion_price)}} VND</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a style=" cursor: pointer;">
                                              <span><i id="{{$sp->id}}" onclick="doClick({{$sp->id}})" class="fa fa-heart" style="font-size:20px;color: black"></i></span>
                                       </a>  
                                      @if(Auth::check())
                                      @foreach($like_list as $l)
                                          <script>
                                              if({{$l->id_product_like}} =={{ $sp->id}}) {
                                                  document.getElementById({{$sp->id}}).style.color = "red"
                                              }
                                           </script>
                                           @break($l->id_product_like == $sp->id)
                                      @endforeach
                                      @endif
                                         <a href="{{route('product-detail',$sp->id)}}"><button class="btn btn-primary" style="background-color: #3A5C83"> Chi tiết sản phẩm <i class="fa fa-chevron-right"></i> </button></a>
                                          <div class="clearfix"></div>
  
                                      </div>
                                  </div>
                              </div>
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
                            @endforeach
                           
                        </div>
                  
                        {{ $pro->appends(['client_gender' => request()->query('client_gender')])->links() }}

                    </div>
            
                    <div class="space50">&nbsp;</div>             
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
@endsection