<div id="header">
  <div class="header-top">
    <div class="container">
      <div class="pull-right auto-width-right">
        <ul class="top-details menu-beta l-inline">
          <li><a href="https://www.facebook.com/profile.php?id=100009638520081" style="background: #000099; "><i class="fa fa-user" style="font-size:15px; color: white"></i><strong style="color: white">Tài khoản</strong></a></li>
          <li><a href="https://www.facebook.com/profile.php?id=100009638520081" style="background: #000099; " ><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:15px; color: white"></i><strong style="color: white">Đăng kí</strong></a></li>
          <li><a href="https://www.facebook.com/profile.php?id=100009638520081" style="background: #000099; "><i class="fa fa-lock" aria-hidden="true" style="font-size:15px; color: white"></i><strong style="color: white">Đăng nhập</strong></a></li>
        </ul>
      </div>
      <div class="clearfix"></div>
    </div> <!-- .container -->
  </div> <!-- .header-top -->
  <div class="header-body">
    <div class="container beta-relative">
      <div class="pull-left">
        <a href="{{route("about")}}" id="logo"><img src="source/image/logo/logo.png" width="100px" height="70px" alt=""></a>
      </div>
      <div class="pull-right beta-components space-left ov">
        <div class="space10">&nbsp;</div>
        <div class="beta-comp">
          <form role="search" method="get" id="searchform" action="/">
                <strong><input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." /></strong>
                <button class="fa fa-search" aria-hidden="true" style="font-size:15px" type="submit" id="searchsubmit"></button>
          </form>
        </div>
        <div class="beta-comp">
          @if(Session::has('cart'))
          <div class="cart">
          <div class="beta-select"><strong class="fa fa-shopping-cart" aria-hidden="true" style="font-size:15px"></strong>  <strong>Giỏ Hàng (@if(Session::has('cart')){{Session('cart')->totalQty}}@else 0 @endif sản phẩm)</strong><i class="fa fa-chevron-down"></i></div>
            <div class="beta-dropdown cart-body">
              @foreach ($product_cart as $productcart)
              <div class="cart-item">
                  <div class="media">
                  <a class="pull-left"  href="{{route('product-detail',$productcart['item']['id'])}}"><img src="source/image/product/{{$productcart['item']['image']}}" alt="" height="30px"></a>
                    <div class="media-body">
                      <span class="cart-item-title"><strong>{{$productcart['item']['name']}}</strong></span>
                      {{-- <span class="cart-item-options">Size: XS; Colar: Navy</span> --}}
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
                                <span class="cart-item-amount">{{$productcart['qty']}}
                              </td>
                              <td class="text-center">
                                <p>X</p>
                              </td>
                              <td >
                                <span class="cart-total-value">{{number_format($productcart['item']['unit_price'])}} VND</span></span>
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
                  <a href="checkout.html" class="beta-btn primary text-center" style="background: #000099; "><strong style="color: white">Đặt hàng</strong> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
          </div> <!-- .cart -->
          @endif
        </div>
      </div>
      <div class="clearfix"></div>
    </div> <!-- .container -->
  </div> <!-- .header-body -->
  <div class="header-bottom" style="background-color: #000099;">
    <div class="container">
      <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
      <div class="visible-xs clearfix"></div>
      <nav class="main-menu">
        <ul class="l-inline ov">
        <li><a href="{{route("home-page")}}">Trang chủ</a></li>

        <li><a href="">Loại sản phẩm</a>
          <ul class="sub-menu">
            @foreach($loai_sp as $loai)
              <li><a href="{{route("product-type",$loai->id)}}">{{$loai->name}}</a></li>
            @endforeach
          </ul>
        </li>
        <li><a href="{{route("about")}}">Giới thiệu</a></li>
        <li><a href="{{route("contact")}}">Liên hệ</a></li>
        </ul>
        <div class="clearfix"></div>
      </nav>
    </div> <!-- .container -->
  </div> <!-- .header-bottom -->
</div> <!-- #header -->