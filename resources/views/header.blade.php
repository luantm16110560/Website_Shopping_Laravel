<div id="header">
    <div class="pull-right">
       <ul class="top-details menu-beta l-inline">
        @if(Auth::check())   {{-- Kiem tra nguoi dung co dang nhap hay chua --}}
       <li><a href="" style="background: #000099; "><i class="fa fa-lock" aria-hidden="true" style="font-size:18px; color: white"></i><strong style="color: white">Chào bạn {{Auth::user()->name}}</strong></a></li>
       <li><a href="{{route('dangxuat')}}" style="background: #000099; "><i class="fa fa-lock" aria-hidden="true" style="font-size:18px; color: white"></i><strong style="color: white">Đăng xuất</strong></a></li>
         @else
            <li><a href="{{route('dangki')}}" style="background: #000099; " ><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:18px; color: white"></i><strong style="color: white">Đăng ký</strong></a></li>
            <li><a href="{{route('dangnhap')}}" style="background: #000099; "><i class="fa fa-lock" aria-hidden="true" style="font-size:18px; color: white"></i><strong style="color: white">Đăng nhập</strong></a></li>
          @endif
         </ul>
    </div>
    <div class="header-body">
       <div class="container beta-relative">
          <div class="pull-right beta-components space-left ov">
             <div class="space10">&nbsp;</div>
             <div class="beta-comp">
                @if(Session::has('cart'))
                <div class="cart">
                   <div class="beta-select"><strong class="fa fa-shopping-cart" aria-hidden="true" style="font-size:15px"></strong>  <strong>Giỏ Hàng (@if(Session::has('cart')){{Session('cart')->totalQty}}@else 0 @endif sản phẩm)</strong><i class="fa fa-chevron-down"></i></div>
                   <div class="beta-dropdown cart-body">
                      @foreach ($product_cart as $productcart)
                      <div class="cart-item">
                         <a class="cart-item-delete" href="{{route('deletegiohang',$productcart['item']['id'])}}"><i class="fa fa-times"></i></a>
                         <div class="media">
                            <a class="pull-left"  href="{{route('product-detail',$productcart['item']['id'])}}"><img src="source/image/product/{{$productcart['item']['image']}}" alt="" height="30px"></a>
                            <div class="media-body">
                               <span class="cart-item-title"><strong>{{$productcart['item']['name']}}</strong></span>                    
                               <table >
                                  <tr>
                                     <th >Số lượng: 
                                     </th>
                                     <th style="color: white" class="text-center"> Nhân:
                                     </th>
                                     <th style="width:50%">Đơn giá:
                                     </th>
                                  </tr>
                                  <tr>
                                     <td class="text-center">
                                        <span class="cart-item-amount">
                                           {{$productcart['qty']}}
                                     </td>
                                     <td class="text-center">
                                     <p>X</p>
                                     </td>
                                     <td >
                                     <span class="cart-total-value"> 
                                        @if(($productcart['item']['promotion_price'])==0){{number_format($productcart['item']['unit_price'])}} VND 
                                        @else {{number_format($productcart['item']['promotion_price'])}}
                                        @endif </span></span>
                                     </td>
                                  </tr>
                               </table>
                            </div>
                         </div>
                      </div>
                      @endforeach
                      <div class="cart-caption">
                         <div class="cart-total text-right"><strong>Tổng tiền:</strong> <span class="cart-total-value">{{number_format(Session('cart')->totalPrice)}} VND</span></div>
                         <div class="clearfix"></div>
                         <div class="center">
                            <div class="space10">&nbsp;</div>
                            <a href="{{route("dathang")}}" class="beta-btn primary text-center" style="background: #000099; "><strong style="color: white">Đặt hàng</strong> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                         </div>
                      </div>
                   </div>
                </div>
                @endif
             </div>
          </div>
          <div class="clearfix"></div>
       </div>
    </div>
    <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
    <div class="visible-xs clearfix"></div>
    <nav class="navbar navbar-inverse" style="background-color:#000099 " >
       <div class="col-sm-6">
          <ul class="nav navbar-nav" >
             <li> <a href="{{route("about")}}"><img src="source/image/logo/logo.png" width="141.77px" height="45px" alt=""></a></li>
             <li><a href="{{route("home-page")}}" style="font-size:18px; color:white; margin-top: 13px">Trang chủ</a></li>
             <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-size:18px; color:white; margin-top: 13px" >Loại sản phẩm
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                   @foreach($loai_sp as $loai)
                   <li style="font-size:18px"><a href="{{route("product-type",$loai->id)}}">{{$loai->name}}</a></li>
                   @endforeach
                </ul>
             </li>
             <li><a href="{{route("about")}}" style="font-size:18px; color:white; margin-top: 13px">Giới thiệu</a></li>
             <li><a href="{{route("contact")}}" style="font-size:18px; color:white; margin-top: 13px">Liên hệ</a></li>
       </div>
       <div class="col-sm-3"></div>
       <div class="col-sm-3">
     
       <form style="margin-top: 19px;" role="search" method="get" id="searchform" action="{{route('search')}}">
       <strong><input style="font-size:16px;" type="text" name="id_search" placeholder="Tìm kiếm sản phẩm" /></strong>
       <button class="fa fa-search" aria-hidden="true" type="submit" id="searchsubmit"></button>
       </form>
       </div>
       </li>
 </div>
 </ul>
 <div class="clearfix"></div>
 </nav>
 <!-- .container -->