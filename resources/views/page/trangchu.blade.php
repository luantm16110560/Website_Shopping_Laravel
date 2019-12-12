@extends('master') @section('content')
<div class="fullwidthbanner-container">
    <div class="fullwidthbanner">
        <div class="bannercontainer">
            <div class="banner">
                <ul>
                    @foreach($my_slide as $sl)

                    <li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                        <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                            <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="source/image/slide/{{$sl->image}}" data-src="source/image/slide/{{$sl->image}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('source/image/slide/{{$sl->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                            </div>
                        </div>

                    </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <div class="tp-bannertimer"></div>
    </div>
</div>
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