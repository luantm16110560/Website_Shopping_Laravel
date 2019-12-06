@extends('master')
@section('content')
<div class="inner-header">
  <div class="container">
    {{-- <div class="pull-left">
    <h6 class="inner-title">Sản phẩm {{$loai_sp->name}}</h6>
    </div> --}}
    <div class="pull-left">
      <div class="beta-breadcrumb font-large">
          <h6><a href="{{route('home-page')}}">Trang chủ</a> / <span>Loại sản phẩm   {{$loai_sp->name}}</span><h6>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<div class="container">
  <div id="content" class="space-top-none">
    <div class="main-content">
      <div class="space60">&nbsp;</div>
      <div class="row">
        <div class="col-sm-3">
          <ul class="aside-menu">
            @foreach ($loai as $l)
              <li><a href="{{route('product-type',$l->id)}}">{{$l->name}}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="col-sm-9">
            <nav class="navbar navbar-inverse" style="background-color: #EDEDED;border-color: #EDEDED">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" style="font-size: 25px;font-weight: bold">Bộ lọc|</a>
                    </div>
                    <ul class="nav navbar-nav">
                        {{--
                        <li class="active"><a href="#">Home</a></li> --}}
                        {{-- <li><a href="{{route('gender_typeProdouct',['client_gender'=>'Nam','url'=>URL::current()])}}" style="color: blue;font-weight: bold;font-size: 25px;font-family: Open Sans">Nam</a></li>
                        <li><a href="{{route('gender_typeProdouct',['client_gender'=>'Nữ','url'=>URL::current()])}}" style="color: pink;font-size: 25px;font-weight: bold">Nữ</a></li> --}}

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <div class="dropdown" style="margin-top: 15px">
                                <a data-toggle="dropdown" style="font-size: 20px; margin-right:7px;">Sắp xếp giá<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Giảm dần</a></li>
                                    <li><a href="#">Tăng dần</a></li>

                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
            
          <div class="beta-products-list">
            {{-- <h4></h4> --}}
            <div class="beta-products-details">
              <p class="pull-left">Tìm thấy {{count($type_product)}} sản phẩm</p>
              <div class="clearfix"></div>
            </div>

            <div class="row">
              @foreach ($type_product as $product)
                <div class="col-xs-4">
                  <div class="single-item">
                      @if($product->promotion_price!=0)
                      <div class="ribbon-wrapper">
                          <div class="ribbon ">Sale</div>
                      </div>
                      @endif
                    <div class="single-item-header">
                      <a href="{{route('product-detail',$product->id)}}"><img src="source/image/product/{{$product->image}}" alt="" height="250px"></a>
                    </div>
                    <div class="single-item-body">
                      <p class="single-item-title">{{$product->name}}</p>
                      {{-- <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:   </strong>{{$product->id}}</p> --}}
                      <p class="single-item-price" style="font-size: 18px ">
                          @if($product->promotion_price !=0)
                            <span class="flash-del">{{number_format($product->unit_price)}} VND</span>
                            <span class="flash-sale">{{number_format($product->promotion_price)}} VND</span>
                          @else
                          <span class="flash-sale">{{number_format($product->unit_price)}} VND</span>
                          @endif
                      </p>
                    </div>
                    <div class="single-item-caption">
                      <a class="add-to-cart pull-left" href="{{route('product-detail',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                      <a class="beta-btn primary" href="{{route('product-detail',$product->id)}}">Chi tiết sản phẩm <i class="fa fa-chevron-right"></i></a>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                {{-- <div class="space20">&nbsp;</div> --}}
              @endforeach
            </div>
          </div> <!-- .beta-products-list -->
          

          <div class="space50">&nbsp;</div>

          <div class="beta-products-list">
            <h4>Sản phẩm khác</h4>
            <div class="beta-products-details">
            <p class="pull-left">Tìm thấy {{count($product_other)}} sản phẩm</p>
              <div class="clearfix"></div>
            </div>
            <div class="row">
             
                @foreach ($product_other as $sp)
                <div class="col-sm-4">
                
                  <div class="single-item">
                      @if($sp->promotion_price!=0)
                      <div class="ribbon-wrapper">
                          <div class="ribbon ">Sale</div>
                      </div>
                      @endif
                    <div class="single-item-header">
                      <a href="{{route('product-detail',$sp->id)}}"><img src="source/image/product/{{$sp->image}}" alt="" height="250px"></a>
                    </div>
                    <div class="single-item-body">
                      <p class="single-item-title">{{$sp->name}}</p>
                      {{-- <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:   </strong>{{$sp->id}}</p> --}}
                      <p class="single-item-price" style="font-size: 18px ">
                          @if($sp->promotion_price !=0)
                            <span class="flash-del">{{number_format($sp->unit_price)}} VND</span>
                            <span class="flash-sale">{{number_format($sp->promotion_price)}} VND</span>
                          @else
                          <span class="flash-sale">{{number_format($sp->unit_price)}} VND</span>
                          @endif
                      </p>
                    </div>
                    <div class="single-item-caption">
                      <a class="add-to-cart pull-left" href="{{route('addtocard',$sp->id)}}"><i class="fa fa-shopping-cart"></i></a>
                      <a class="beta-btn primary" href="{{route('product-detail',$sp->id)}}">Chi tiết sản phẩm   <i class="fa fa-chevron-right"></i></a>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="row">{{$product_other->links()}}</div>
            <div class="space40">&nbsp;</div>
            
          </div> <!-- .beta-products-list -->
        </div>
      </div> <!-- end section with sidebar and main content -->


    </div> <!-- .main-content -->
  </div> <!-- #content -->
</div> <!-- .container -->
@endsection