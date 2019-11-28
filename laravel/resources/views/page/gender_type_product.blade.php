
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
                                   
                                </ul>
                               
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
                  
                        {{ $pro->appends(['gender_typeProdouct' => request()->query('gender_typeProdouct')])->links() }}

                    </div>
            
                    <div class="space50">&nbsp;</div>             
                </div>
            </div>
        </div>
    </div>
</div>
@endsection