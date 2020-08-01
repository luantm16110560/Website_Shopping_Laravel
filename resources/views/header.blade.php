<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<nav class="navbar navbar-fixed-top">
   <?php  $sum=0; ?>
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
            <ul  class="nav navbar-nav navbar-left"
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
                  <a  href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
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
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               </li>

               <li>
               
                  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
                  <form style="margin-top: 8px;" method="get" id="searchform"
                     action="{{route('search')}}" autocomplete="off">
                     <input id="id_search" type="text"
                        style="font-family: Arial, Helvetica, sans-serif;font-size:17px;height: 35px;width:250px" name="id_search" placeholder="Tìm kiếm" />
                    
                     <button style="margin-right: -20px" class="fa fa-search"  type="submit" id="searchsubmit" name="doSearch"></button>
                  </form>
                  <script type="text/javascript">

                     $("#id_search").on('keyup', function (e) {
                         if (e.keyCode === 13) {
                             $('button[name = doSearch]').click();
                         }
                     });
             
             
                     $('#id_search', this.el).typeahead({
                             source: function (query, process) {
                                 var q = '/autocomplete?id_search=' + query;               
             
                                 return $.get(q, function (data) {
                                     return process(data);
                                 });
                             },
                         //  minLength: 3,
                             autoSelect: false
                         });
                         $(document).on('click', '.dropdown-item', function () {
                             $('button[name = doSearch]').click();
                         });
                 </script>
               </li>
              
            </ul>
           
            <ul class="nav navbar-nav navbar-right"
               style="font-size: 20px;font-family: Arial, Helvetica, sans-serif;font-size: 17px;margin-top: 2px">
             
               <li>
                  
                  @if(Auth::check())
                 
                  <div class="cart" style="width:100px;">
                     <marquee class="pull-left" style="color: red;font-size: 18px;font-weight: bold"
                        behavior="alternate" width="22%">>></marquee>
                     <div class="beta-select">
                        <img src="source/image/icon/cart.ico">
                        <span id="num_cart" class='badge badge-warning'
                           style=" font-size: 12px;background: #ff0000;color: #fff; padding: 0 1.5px; vertical-align: top;margin-left: -15px; ">
                              {{$totalQty}}
                        </span>
                     </div>
                     {{-- @if($sp) --}}
                     <style type="text/css">
                        .scrollable{
                          overflow: auto;
                          width: 70px; /* adjust this width depending to amount of text to display */
                          height: 330px; /* adjust height depending on number of options to display */
                          border: 1px silver solid;
                        }
                        .scrollable select{
                          border: none;
                        }
                       </style>
                     @if($totalQty==0)
                     <div class="beta-dropdown cart-body" style="width:350px;margin-top: -13px">
                        <div class="center">
                        <img  style="height: width:200px;height:200px" src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/f3540f6657bbdc1120e3f8cc90bdba97.png">
                      
                        </div>  
                        <div class="center">
                        <label>Giỏ hàng trống</label> 
                        </div>
                     </div>
                     @else
                     <div class="beta-dropdown cart-body scrollable" style="width:350px;margin-top: -13px">
                        @foreach ($sp as $like)
                        <div class="cart-item">
                           <a class="cart-item-delete" href="{{route('deletegiohang',['id_product'=>$like->product_id,'value'=>$like->size])}}"><i
                                 class="fa fa-times"></i></a>

                           <div class="media">
                              <a class="pull-left" href="{{route('product-detail',$like->product_id)}}"><img
                                    src="source/image/product/{{$like->product_image}}" alt=""
                                    height="30px"></a>
                                 <span style="font-size:12px;" class="cart-item-title"><strong>{{$like->product_name}}</strong></span>
                              <div class="media-body" style="width:100%">
                                 <table>
                                    <tr>
                                       <th style="font-size:12px;" >Số lượng</th>
                                       <th style="color: white" class="text-center">Nhân</th>
                                       <th style="font-size:12px;width:50%">Đơn giá
                                       </th>
                                    </tr>
                                    <tr>
                                       <td class="text-center">
                                          <span class="cart-item-amount">
                                             <a href="{{route('addbyone',['id_product'=>$like->product_id,'value'=>$like->size])}}">
                                                <i class="fa fa-plus-circle"></i>
                                             </a>
                                             {{-- <a href="#" onclick="addByOne($like->product_id,$like->size)">
                                                <i class="fa fa-plus-circle"></i>
                                             </a> --}}
                                             {{-- <script>
                                                function addByOne(id,size)
                                                {
                                                   $.get("/add-by-one/" + id+"/"+size, function(data, status) {
                                           
                                                if (status == "success") {
                                                   // document.getElementById(id).style.color = "red";
                                                    window.location.reload();
                                                
                                                   }
                                                   });
                                                }
                                          
                                       
                                                
                                             </script> --}}
                                             {{$like->amount}}
                                             
                                             <a href="{{route('deletesp',['id_product'=>$like->product_id,'value'=>$like->size])}}">
                                                <i class="fa fa-minus-circle"></i>
                                             </a>
                                          </span>
                                       </td>
                                       <td class="text-center">
                                          <p>X</p>
                                       </td>
                                       <td>
                                          <span class="cart-total-value">
                                             @if(($like->promotion_price)==0){{number_format($like->price)}}
                                             VND
                                             @else {{number_format($like->promotion_price)}} VND
                                             @endif
                                          </span>
                                          <span
                                             class="flash-del">@if(($like->promotion_price)!=0){{number_format($like->price)}}VND
                                             @endif </span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <th style="font-size:12px;">Size: <i style="font-size:12px;">{{$like->size}}</i></th>
                                    </tr>
                                    <?php
                                       $sum=0;
                                       foreach($sp as $like)
                                       { 
                                          if(($like->promotion_price)==0)
                                             {
                                                $sum=$sum+(($like->price)*($like->amount));
                                             }
                                          else 
                                             {
                                                $sum=$sum+(($like->promotion_price)*($like->amount));
                                             }
                                       }
                                 ?>
                                 </table>
                                
                              </div>
                             
                           </div>
                           @endforeach
                        </div>
                        @if($sum!=null || $sum!=0)
                        <div class="cart-caption">
                           <div class="cart-total text-right"><strong>Tạm tính:</strong>
                              
                                    <span class="cart-total-value">{{number_format($sum)}} VND</span>
                           
                           </div>
                           <div class="clearfix"></div>
                           <div class="center">
                              <div class="space10">&nbsp;</div>
                                 <div class="col-sm-6">
                                    <a href="{{route("listcart")}}">
                                   <button class="btn btn-info" style=" max-width: 117px;"><font style="corlor:white; margin-left:-6px">XEM GIỎ HÀNG</font></button>
                                   </a>    
                                </div>
                                    <div class="col-sm-6">
                                    <a href="{{route("order")}}">
                                    <button class="btn btn-danger"><font style="corlor:white">THANH TOÁN</font></button> 
                                    </a>
                                 </div>       
                           </div>
                        </div>
                        @endif
                     </div>
                     @endif
                     {{-- @else
                     <div class="col-sm-6">
                        <a href="{{route("listcart")}}">
                       <button class="btn btn-info" style=" max-width: 117px;"><font style="corlor:white; margin-left:-6px">XEM GIỎ HÀNG</font></button>
                       </a>    
                    </div>
                     @endif --}}
                     @endif
               </li>

               <li>
                  @if(Auth::check())
                  <div>
                     <div class="beta-select">
                       <a href="{{route('get_like')}}"> <img  src="source/image/icon/heart.ico">
                        <span id="num_like" class='badge badge-warning'
                           style=" font-size: 12px;background: #ff0000;color: #fff; padding: 0 5px; vertical-align: top;margin-left: -15px; ">
                              {{$totalLike}}
                        </span>
                       </a>
                     </div>
                  @endif
               </li>
               <li>
              
               <span><a href="{{route('sale')}}"><img src="/source/image/sales.ico" href="{{route('sale')}}"></a></span>
            
               </li>
               <li>
                  &nbsp;&nbsp;&nbsp;
               </li>
               {{-- abc --}}
               {{-- <li>
                  &nbsp;&nbsp;&nbsp;
               </li> --}}
               @can('isManager')
               <li>
                     <span class="dropdown">
                        <a href="{{route('admin')}}"><button  class="btn btn-primary dropdown-toggle"
                           style="height: 40px;margin-top: 5px">Trang bán hàng</button> 
                        </a>
                     </span>
               </li>
               @endcan
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
                        <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                     </ul> 
                     @else
                     <div style="margin-top:8px;height: 40px">
                        <a class="btn btn-primary" href="{{route('login')}}" role="button">Đăng nhập</a>
                        <a class="btn btn-primary" href="{{route('register')}}" role="button">Đăng ký</a>
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