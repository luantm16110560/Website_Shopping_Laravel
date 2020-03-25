@extends('master') @section('content')
<div class="inner-header">
    <div class="container">
        {{-- <div class="pull-left">
            <h6 class="inner-title">Sản phẩm {{$sanpham->name}}</h6>
        </div> --}}
        <div class="pull-left">
            <div class="beta-breadcrumb font-large">
              <h6><a href="{{route("home-page")}}">Trang chủ</a> / <span>Thông tin chi tiết sản phẩm</span></h6>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-sm-9">

                <div class="row">
                    <div class="col-sm-6">

                        <img src="source/image/product/{{$sanpham->image}}" alt="">
                      <br>
                      <br>
                      <br>
                      
                          <div class="col-sm-4" style="margin-left: -18px" >
                              <div >
                            <img style="height: 120px;width: 150px;font-weight: bold;border-color: blue;border-style: groove; border-width: 1px;border-height:1px"src="source/image/product/{{$sanpham->img1}}" alt="">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div >
                          <img  style="height: 120px;width: 150px;font-weight: bold;border-color: blue;border-style: groove; border-width: 1px;border-height:1px" src="source/image/product/{{$sanpham->img2}}" alt="">
                          </div>
                      </div>
                      <div class="col-sm-4">
                        <div >
                      <img  style="height: 120px;width: 150px;font-weight: bold;border-color: blue;border-style: groove; border-width: 1px;border-height:1px" src="source/image/product/{{$sanpham->img3}}" alt="">
                      </div>
                  </div>
                          
                      
                   
                        <style>
                            /* [1] The container */
                            
                            .img-hover-zoom {
                                width:150%;
                                height: 150%; 
                                
                                /* [1.1] Set it as per your need */
                                overflow: hidden;
                                /* [1.2] Hide the overflowing of child elements */
                            }
                            /* [2] Transition property for smooth transformation of images */
                            
                            .img-hover-zoom img {
                                transition: transform .5s ease;
                            }
                            /* [3] Finally, transforming the image when container gets hovered */
                            
                            .img-hover-zoom:hover img {
                                transform: scale(2);
                            }
                        </style>

                    </div>
                    <div class="col-sm-6">
                        <div class="single-item-body">
                            {{-- @if($sanpham->promotion_price!=0)
                            <div class="ribbon-wrapper">
                                <div class="ribbon ">Sale</div>
                            </div>
                            @endif --}}
                            <p class="single-item-title">
                                <h2>{{$sanpham->name}}<h2></p>

              <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:   </strong>TOMSHOES{{$sanpham->id}}</p>
              <p class="single-item-price" style="font-size: 18px">
                  @if($sanpham->promotion_price !=0)
                    <span class="flash-del">{{number_format($sanpham->unit_price)}} VND</span>
                    <span class="flash-sale">{{number_format($sanpham->promotion_price)}} VND</span>
                  @else
                    <span class="flash-sale">{{number_format($sanpham->unit_price)}} VND</span>
                  @endif
              </p>
            </div>

            <div class="clearfix"></div>
            <div class="space20">&nbsp;</div>

            <div class="single-item-desc">
            <p>
              @if($sanpham->amount==0) 
              <div class="ribbon">Hết hàng</div> 
              {{-- @else <strong>Kho còn</strong> <a style="border-color: red;  border-style: double;font-size:16px">{{$sanpham->amount}} sản phẩm</a> @endif</p> --}}
              @else{{$sanpham->amount}} sản phẩm @endif
            </div>
            <div class="space20">&nbsp;</div>
            <div class="space20">&nbsp;</div>
            <label>Số lượng</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1" max={{$sanpham->amount}}>
            <div class="space20">&nbsp;</div>
            <div class="space20">&nbsp;</div>
            <div class="single-item-options">
              <p>Size:  {{$sanpham->size}}</p>
              {{-- <select class="wc-select" name="size" id="size" onchange="Size(this)">
                <option value="">-- Size --</option>
                <option value="35">35</option>
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
              </select> --}}
              @if(Auth::check())
              @if($sanpham->amount!=0)<button onclick="addCart()" class="add-to-cart" ><i class="fa fa-shopping-cart"></i></button>
              @endif
              @else 
              @if($sanpham->amount!=0)<a class="add-to-cart" href="{{route('dangnhap')}}"><i class="fa fa-shopping-cart"></i></a>@endif
              @endif
              <div class="clearfix"></div>
            </div>
          </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
							<script language="javascript">
                window.onload = function() {
                var input = document.getElementById("quantity").focus();
                }
                function addCart()
                {
                  $.ajax({
                    url: 'http://localhost:81/laravel/public/add-to-card/{{$sanpham->id}}',
                    type: 'get',
                    data: {},
                   success: function (data) {
                    // use it here
                    document.location.reload(true);
                   }
                 });
                  
                }
								function Size(obj)
									{
										var value = obj.value;
										if (value === ''){
                      var kq="Vui lòng chọn size"
											arlet(kq);

										}
										else if (value === '35'){
											var kq=document.getElementById('size').value;
                     // {{$sanpham->size}}=kq;
                      alert(kq);

										}
										else if (value === '36'){
											var kq=document.getElementById('size').value;
                      //{{$sanpham->size}}=kq;
                      alert(kq);
										}
                    else if (value === '37'){
											var kq=document.getElementById('size').value;
                      //{{$sanpham->size}}=kq;
                      alert(kq);
										}
                    else if (value === '38'){
											var kq=document.getElementById('size').value;
                      //{{$sanpham->size}}=kq;
                      alert(kq);
										}
                    else if (value === '39'){
											var kq=document.getElementById('size').value;
                      //{{$sanpham->size}}=kq;
                      alert(kq);
										}
                    else if (value === '40'){
											var kq=document.getElementById('size').value;
                      //{{$sanpham->size}}=kq;
                      alert(kq);
										}
                    else if (value === '41'){
											var kq=document.getElementById('size').value;
                      //{{$sanpham->size}}=kq;
                      alert(kq);
										}
                    else if (value === '42'){
											var kq=document.getElementById('size').value;
                      //{{$sanpham->size}}=kq;
                      alert(kq);
										}
                    else if (value === '43'){
											var kq=document.getElementById('size').value;
                      //{{$sanpham->size}}=kq;
                      alert(kq);
										}
									}
							</script>

        {{-- <div class="space40">&nbsp;</div>
        <div class="woocommerce-tabs">
            <label href=""><i>Bảng hướng dẫn đo size giày<i></label>
              <img src="source\image\size.png" alt="">
        </div> --}}
        <div class="space40">&nbsp;</div>
        <div class="woocommerce-tabs" style="corlor:red">
          <ul class="tabs">
            <li><a style="font-weight: bold;color: black;border-style: groove" href="#tab-description">Mô tả</a></li>
            <li><a style="font-weight: bold;color: black;border-style: groove" href="#tab-image">Hướng dẫn chọn size giày</a></li>
            {{-- <li><a href="#tab-reviews">Reviews (0)</a></li> --}}
          </ul>
          <div class="panel" id="tab-description">
            @if($sanpham->description!=null)<p style="font-size: 100%">{!!$sanpham->description!!}</p>
             @else <p>Chưa có thông tin mô tả cho sản phẩm</p> 
             @endif
          </div>
          <div class="panel" id="tab-image">
              <img src="source\image\size.png" alt="">
            </div>
          {{-- <div class="panel" id="tab-reviews">
            <p>No Reviews</p>
          </div> --}}
          
        </div>
        <div class="space50">&nbsp;</div>
        <div class="beta-products-list">
          <h4>Sản phẩm tương tự</h4>
          <div class="beta-products-details">
              <p class="pull-left">Tìm thấy {{count($sp_tuongtu)}} sản phẩm</p>
                <div class="clearfix"></div>
          </div>
          <div class="row">
            @foreach ($sp_tuongtu as $sptt)
            <div class="col-sm-4">
              <div class="single-item">
                  @if($sptt->promotion_price!=0)
                  <div class="ribbon-wrapper">
                      <div class="ribbon ">Sale</div>
                  </div>
                  @endif
                <div class="single-item-header">
                <a href="{{route('product-detail',$sptt->id)}}"><img src="source/image/product/{{$sptt->image}}" alt="" height="250px"></a>
                </div>
                <div class="single-item-body">
                <p class="single-item-title">{{$sptt->name}}</p>
                <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:   </strong>TOMSHOES{{$sptt->id}}</p>
                  <p class="single-item-price" style="font-size: 18px">
                      @if($sptt->promotion_price !=0)
                        <span class="flash-del">{{number_format($sptt->unit_price)}} VND</span>
                        <span class="flash-sale">{{number_format($sptt->promotion_price)}} VND</span>
                      @else
                        <span class="flash-sale">{{number_format($sptt->unit_price)}} VND</span>
                  @endif
                  </p>
                </div>
                <div class="single-item-caption">
                  <a class="add-to-cart pull-left" href="{{route('product-detail',$sptt->id)}}"><i class="fa fa-shopping-cart"></i></a>
                  <a class="beta-btn primary" href="{{route('product-detail',$sptt->id)}}">Chi tiết sản phẩm <i class="fa fa-chevron-right"></i></a>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="row">{{$sp_tuongtu->links()}}</div>
        </div> <!-- .beta-products-list -->
      </div>
      <div class="col-sm-3 aside">
        <div class="widget">
          <h3 class="widget-title">Flash Sale</h3>
          <div class="widget-body">
            <div class="beta-sales beta-lists">
              @foreach($sp_sale as $sps)
              <div class="media beta-sales-item">
                <div class="ribbon-wrapper">
                      <div class="ribbon ">Sale</div>
                </div>
                <a class="pull-left"  href="{{route('product-detail',$sps->id)}}"><img src="source/image/product/{{$sps->image}}" alt="" height="250px"></a>
                <div class="media-body">
                  <a href="{{route('product-detail',$sps->id)}}"><p class="single-item-title">{{$sps->name}}</p></a>
                  <a href="{{route('product-detail',$sps->id)}}"><span class="beta-sales-price">{{number_format($sps->unit_price)}} VND</span></a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="row">{{$sp_sale->links()}}</div>
        </div> <!-- best sellers widget -->
        {{-- <div class="widget">
          <h3 class="widget-title">New Products</h3>
          <div class="widget-body">
            <div class="beta-sales beta-lists">
              <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/1.png" alt=""></a>
                <div class="media-body">
                  Sample Woman Top
                  <span class="beta-sales-price">$34.55</span>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- best sellers widget --> --}}
      </div>
    </div>
  </div> <!-- #content -->
</div> <!-- .container -->
@endsection