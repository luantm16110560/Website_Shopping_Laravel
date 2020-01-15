@extends('master')
 @section('content')

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">

      <div class="item active"  data-interval="0">
        <img  src="source\image\slide\1.jpg"  style="width:100%;height: 250px">
      
      </div>

      @foreach($my_slide as $sl)
      <div data-interval="1000" class="item"  >
      <img  src="source\image\slide\{{$sl->image}}" style="width:100%;height: 250px">
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
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div style="margin:10px"></div>
            <div class="row">
                <nav class="navbar navbar-inverse" style="background-color: #EDEDED;border-color: #EDEDED">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" style="font-size: 25px;font-weight: bold">Bộ lọc|</a>
                        </div>
                        <ul class="nav navbar-nav">
                            {{--
                            <li class="active"><a href="#">Home</a></li> --}}
                            <li><a href="{{route('gender',['client_gender'=>'Nam'])}}" style="color: blue;font-weight: bold;font-size: 25px;font-family: Open Sans">Nam</a></li>
                            <li><a href="{{route('gender',['client_gender'=>'Nữ'])}}" style="color: pink;font-size: 25px;font-weight: bold">Nữ</a></li>
                            

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
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Sản phẩm của Tom's Shoe</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{$_count}} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($product as $p)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($p->promotion_price!=0)
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon ">Sale</div>
                                    </div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{route('product-detail',$p->id)}}"><img src="source/image/product/{{$p->image}}" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{$p->name}}</p>
                                        
                                        {{-- <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:     </strong>{{$p->id}}</p> --}}
                                        <p class="single-item-price" style="font-size: 18px ">
                                            @if($p->promotion_price==0)
                                            <span class="flash-sale">{{number_format($p->unit_price)}} VND</span> @else
                                            <span class="flash-del">{{number_format($p->unit_price)}} VND</span>
                                            <span class="flash-sale">{{number_format($p->promotion_price)}} VND</span> @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{route('product-detail',$p->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{route('product-detail',$p->id)}}">Chi tiết sản phẩm <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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