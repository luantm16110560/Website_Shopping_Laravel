
{{-- @extends('master')
@section('content') --}}

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
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                   
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


{{-- @endsection --}}