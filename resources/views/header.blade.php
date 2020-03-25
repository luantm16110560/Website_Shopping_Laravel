<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<nav class="navbar navbar-fixed-top">
   <nav class="navbar navbar-default" style="background-color: lightblue">
      <div class="container-fluid">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
               aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a href="{{route('home-page')}}">
               <img style="margin-top:4px" href="{{route('home-page')}}" src="source/image/logo/logo.jpg" width="80"
                  height="45px" alt="">
            </a>
         </div>
         <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav"
               style="font-size: 20px;font-family: Arial, Helvetica, sans-serif;font-size: 17px;margin-top: 2px">
               <li><a href="{{route('home-page')}}">
                     <font color="black">Trang chủ</font>
                  </a></li>
               <li><a href="{{route('about')}}">
                     <font color="black">Giới thiệu</font>
                  </a></li>
               <li><a href="{{route('contact')}}">
                     <font color="black">Liên hệ</font>
                  </a></li>
               <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                     aria-expanded="false">
                     <font color="black">Sản phẩm</font><span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                     @foreach($loai_sp as $loai)
                     <li><a href="{{route('product-type',$loai->id)}}">{{$loai->name}}</a></li>
                     @endforeach
                  </ul>
               
               </li>
               <li>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;
               </li>

               <li>
                  <form style="margin-top: 8px;" role="search" method="get" id="searchform"
                     action="{{route('searchView')}}" autocomplete="off">
                     <strong><input onkeypress="myFunction(event)" id="id_search" style="font-size:16px;" type="text"
                           class="typeahead form-control" name="id_search" placeholder="Tìm kiếm sản phẩm" /></strong>
                     <script type="text/javascript">
                        var path ="{{route('search')}}";// đường dẫn đến api để lấy kết quả dạng json
                            //type ahead để auto complete
 
                              $('input.typeahead').typeahead({
                                 source:function(query,process){
                                    return $.get(path,{query:name},function(data){
                                       return process(data);
                                       alert(data.id);
                                    

                                    });
                                 }
                           });
                     </script>
                     <button class="fa fa-search" aria-hidden="true" type="submit" id="searchsubmit"></button>
                  </form>
               </li>
               
            </ul>
            <ul class="nav navbar-nav navbar-right"
               style="font-size: 20px;font-family: Arial, Helvetica, sans-serif;font-size: 17px;margin-top: 2px">

               <li>
                  @if(Session::has('cart'))
                  <div class="cart" style="width:150px;">
                     <marquee class="pull-left" style="color: red;font-size: 18px;font-weight: bold"
                        behavior="alternate" width="20%">>></marquee>
                     <div class="beta-select">
                        <img src="source/image/icon/cart.ico">
                        <span class='badge badge-warning'
                           style=" font-size: 12px;background: #ff0000;color: #fff; padding: 0 5px; vertical-align: top;margin-left: -15px; ">
                           @if(Session::has('cart'))
                           {{Session('cart')->totalQty}}
                           @else
                           0
                           @endif
                        </span>
                     </div>
                     <div class="beta-dropdown cart-body" style="width:300px;margin-top: -13px">
                        @foreach ($product_cart as $productcart)
                        <div class="cart-item">
                           <a class="cart-item-delete" href="{{route('deletegiohang',$productcart['item']['id'])}}"><i
                                 class="fa fa-times"></i></a>

                           <div class="media">
                              <a class="pull-left" href="{{route('product-detail',$productcart['item']['id'])}}"><img
                                    src="source/image/product/{{$productcart['item']['image']}}" alt=""
                                    height="30px"></a>
                              <div class="media-body" style="width:100%">
                                 <span class="cart-item-title"><strong>{{$productcart['item']['name']}}</strong></span>
                                 <table>
                                    <tr>
                                       <th>Số lượng:
                                       </th>
                                       <th style="color: white" class="text-center"> Nhân:
                                       </th>
                                       <th style="width:50%">Đơn giá:
                                       </th>
                                    </tr>
                                    <tr>
                                       <td class="text-center">
                                          <span class="cart-item-amount">
                                             {{-- <a href="{{route('addbyone',$productcart['item']['id'])}}"><i
                                                class="fa fa-plus-circle"></i></a> --}}
                                             {{$productcart['qty']}}
                                             <a href="{{route('deletesp',$productcart['item']['id'])}}"><i
                                                   class="fa fa-minus-circle"></i></a>
                                       </td>
                                       <td class="text-center">
                                          <p>X</p>
                                       </td>
                                       <td>
                                          <span class="cart-total-value">
                                             @if(($productcart['item']['promotion_price'])==0){{number_format($productcart['item']['unit_price'])}}
                                             VND
                                             @else {{number_format($productcart['item']['promotion_price'])}} VND @endif
                                          </span>
                                          <span
                                             class="flash-del">@if(($productcart['item']['promotion_price'])!=0){{number_format($productcart['item']['unit_price'])}}VND
                                             @endif </span>
                                       </td>
                                    </tr>
                                 </table>
                                 <label>Size:</label><i> {{$productcart['size']}}</i>
                              </div>
                           </div>
                        </div>
                        @endforeach
                        <div class="cart-caption">
                           <div class="cart-total text-right"><strong>Tạm tính:</strong> <span
                                 class="cart-total-value">{{number_format(Session('cart')->totalPrice)}} VND</span>
                           </div>
                           <div class="clearfix"></div>
                           <div class="center">
                              <div class="space10">&nbsp;</div>
                              @if($productcart['qty']>$productcart['item']['amount']) <i><strong>Sản phẩm <span
                                       style="color: red;font-weight: bold">TOMSHOES{{$productcart['item']['name']}}</span>
                                    tạm hết hàng</strong></i> @else<a href="{{route("dathang")}}"
                                 class="beta-btn primary text-center" style="background: #000099; "><strong
                                    style="color: white">Tiến hành thanh toán</strong> <i class="fa fa-chevron-right"
                                    aria-hidden="true"></i></a> @endif
                           </div>
                        </div>
                     </div>
                     @else
                     <div class="cart" style="width:150px;">
                     </div>
                     @endif

               </li>
               {{-- <li>
                  &nbsp;&nbsp;&nbsp;
               </li> --}}
               <li >
                  @can('isManager')
                     <span class="dropdown">
                        <a href="{{route('manager-page')}}"><button  class="btn btn-primary dropdown-toggle"
                           style="height: 40px;margin-top: 5px">Trang bán hàng</button> 
                        </a>
                     </span>
                  @endcan 
               </li>
               <li>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               </li>
               <li>
                  <span class="dropdown">
                     @if(Auth::check())
                     <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                        style="height: 40px;margin-top: 5px">
                        {{Auth::user()->name}} &#8250;
                     </button>

                     <ul class="dropdown-menu" style="margin-top: 14px">
                        <li><a href="{{route('infor')}}">Thông tin cá nhân</a></li>
                        <li><a href="{{route('orderhistory')}}">Lịch sử mua hàng</a></li>
                        <li><a href="{{route('dangxuat')}}">Đăng xuất</a></li>
                     </ul>
                     @else
                     <div style="margin-top:8px;height: 40px">
                        <a class="btn btn-primary" href="{{route('dangnhap')}}" role="button">Đăng nhập</a>
                        <a class="btn btn-primary" href="{{route('dangki')}}" role="button">Đăng ký</a>
                     </div>
                     @endif
                  </span></li>
                  <li>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </li>
            </ul>
         </div>
         <!--/.nav-collapse -->
      </div>
      <!--/.container-fluid -->
   </nav>
</nav>
<br>
<br>
<br>