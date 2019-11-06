@extends('master')
@section('content')
<div class="inner-header">
  <div class="container">
    <div class="pull-left">
    <h6 class="inner-title">Sản phẩm {{$sanpham->name}}</h6>
    </div>
    <div class="pull-right">
      <div class="beta-breadcrumb font-large">
        <a href="{{route("home-page")}}">Trang chủ</a> / <span>Thông tin chi tiết sản phẩm</span>
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
          <div class="col-sm-4">
          <img src="source/image/product/{{$sanpham->image}}" alt="">
          </div>
          <div class="col-sm-8">
            <div class="single-item-body">
              {{-- @if($sanpham->promotion_price!=0)
                <div class="ribbon-wrapper">
                  <div class="ribbon ">Sale</div>
                </div>
              @endif --}}
            <p class="single-item-title"><h2>{{$sanpham->name}}<h2></p>
              <p class="single-item-price" style="font-size: 18px">
                  @if($sanpham->promotion_price !=0)
                    <span class="flash-del">{{number_format($sanpham->unit_price)}} VND</span>
                    <span class="flash-sale">{{number_format($sanpham->promotion_price)}} VDN</span>
                  @else
                    <span>{{number_format($sanpham->unit_price)}} VND</span>
                  @endif
              </p>
            </div>

            <div class="clearfix"></div>
            <div class="space20">&nbsp;</div>

            <div class="single-item-desc">
            <p>Còn: {{$sanpham->amount}} sản phẩm</p>
            </div>
            <div class="space20">&nbsp;</div>

            <p>Lựa chọn:</p>
            <div class="single-item-options">
              <select class="wc-select" name="size">
                <option>Kích cỡ:</option>
                <option value="35">35</option>
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
              </select>
              <select class="wc-select" name="color">
                <option>Màu sắc</option>
                <option value="Red">Red</option>
                <option value="Green">Green</option>
                <option value="Yellow">Yellow</option>
                <option value="Black">Black</option>
                <option value="White">White</option>
              </select>
              <select class="wc-select" name="color">
                <option>Số lượng</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
              <a class="add-to-cart" href="{{route('addtocard',$sanpham->id)}}"><i class="fa fa-shopping-cart"></i></a>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>

        <div class="space40">&nbsp;</div>
        <div class="woocommerce-tabs">
          <ul class="tabs">
            <li><a href="#tab-description">Mô tả:</a></li>
            {{-- <li><a href="#tab-reviews">Reviews (0)</a></li> --}}
          </ul>

          <div class="panel" id="tab-description">
            <p>{{$sanpham->description}}</p>
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
                  <p class="single-item-price" style="font-size: 18px">
                      @if($sptt->promotion_price !=0)
                        <span class="flash-del">{{number_format($sptt->unit_price)}} VND</span>
                        <span class="flash-sale">{{number_format($sptt->promotion_price)}} VDN</span>
                      @else
                        <span>{{number_format($sptt->unit_price)}} VND</span>
                  @endif
                  </p>
                </div>
                <div class="single-item-caption">
                  <a class="add-to-cart pull-left" href="{{route('addtocard',$sptt->id)}}"><i class="fa fa-shopping-cart"></i></a>
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
          <h3 class="widget-title">Best Sellers</h3>
          <div class="widget-body">
            <div class="beta-sales beta-lists">
              <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/1.png" alt=""></a>
                <div class="media-body">
                  Sample Woman Top
                  <span class="beta-sales-price">$34.55</span>
                </div>
              </div>
              <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/2.png" alt=""></a>
                <div class="media-body">
                  Sample Woman Top
                  <span class="beta-sales-price">$34.55</span>
                </div>
              </div>
              <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/3.png" alt=""></a>
                <div class="media-body">
                  Sample Woman Top
                  <span class="beta-sales-price">$34.55</span>
                </div>
              </div>
              <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/4.png" alt=""></a>
                <div class="media-body">
                  Sample Woman Top
                  <span class="beta-sales-price">$34.55</span>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- best sellers widget -->
        <div class="widget">
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
              <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/2.png" alt=""></a>
                <div class="media-body">
                  Sample Woman Top
                  <span class="beta-sales-price">$34.55</span>
                </div>
              </div>
              <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/3.png" alt=""></a>
                <div class="media-body">
                  Sample Woman Top
                  <span class="beta-sales-price">$34.55</span>
                </div>
              </div>
              <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/4.png" alt=""></a>
                <div class="media-body">
                  Sample Woman Top
                  <span class="beta-sales-price">$34.55</span>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- best sellers widget -->
      </div>
    </div>
  </div> <!-- #content -->
</div> <!-- .container -->
@endsection