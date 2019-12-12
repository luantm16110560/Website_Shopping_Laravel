
@extends('master')
@section('content')
    

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
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
                        <h4>Tìm kiếm </h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{$_count}} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

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
                                        <p class="single-item-title">{{$sp->name}}</p>
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
                                    <a class="add-to-cart pull-left" href="{{route('addtocard',$sp->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{route('product-detail',$sp->id)}}">Chi tiết sản phẩm <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                           
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
@endsection