@extends('master')
@section('content')
<div class="inner-header">
  <div class="container">
    <h3>{{$sanpham->name}}<h3>
        <div class="clearfix"></div>
  </div>
</div>
<link href="../sourceCode/rateit/src/rateit.css" rel="stylesheet" type="text/css">
<script src="../sourceCode/rateit/src/jquery.rateit.js" type="text/javascript"></script> 
<div class="container" style="margin-top: -35px">
  <div id="content">
    <div class="row">
      <div class="col-sm-9">
        @if(round($count_star,1)!=0)
        <div class="col-sm-4">
        <div class="bigstars">
          <span style="font-size: 30px">{{round($count_star,1)}}</span>
         <div  class="rateit" data-rateit-value={{round($count_star,1)}} data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-readonly="true" data-rateit-min="0" data-rateit-max="5"></div>
        </div>
      </div>
        @endif
      <div class="col-sm-6">
        <div class="col-sm-6">
        <span style="font-size: 17px"> Đã bán {{$count_buy}}</span>
      </div>
      <div class="col-sm-6">
        <div style="font-size: 17px"> Lượt thích {{$count_like}} </div>
        <br>
      </div>
      </div>
     {{-- <div class="col-sm-4"> --}}
  
     {{-- </div> --}}
        <div class="row">
      
          <div class="col-sm-8">

            <img style="width: 350px;height: 350px" id="img" src="source/image/product/{{$sanpham->image}}" alt="">
         
            <br>
            <br>
            <div class="col-sm-3" style="margin-left: -18px">
              
              <div>
                <img id="img0" style="height: 120px;width: 150px;font-weight: bold;"
                  src="source/image/product/{{$sanpham->image}}" alt="" onclick="imgClick()"
                  onmouseover="doHoverImage1()">
              </div>
            </div>
            <div class="col-sm-3" style="margin-left: -18px">
              <div>
                <img id="img1" style="height: 120px;width: 150px;font-weight: bold;"
                  src="source/image/product/{{$sanpham->img1}}" alt="" onclick="img1Click()"
                  onmouseover="doHoverImage1()">
              </div>
            </div>
            <div class="col-sm-3">
              <div>
                <img id="img2" style="height: 120px;width: 150px;font-weight: bold;"
                  src="source/image/product/{{$sanpham->img2}}" alt="" onclick="img2Click()"
                  onmouseover="doHoverImage2()">
              </div>
            </div>
            <div class="col-sm-3">
              <div>
                <img id="img3" style="height: 120px;width: 150px;font-weight: bold;"
                  src="source/image/product/{{$sanpham->img3}}" alt="" onclick="img3Click()"
                  onmouseover="doHoverImage3()">
              </div>
            </div>

          </div>
          <div class="col-sm-4">
            <div class="single-item-body">
              {{-- @if($sanpham->promotion_price!=0)
                            <div class="ribbon-wrapper">
                                <div class="ribbon ">Sale</div>
                            </div>
                            @endif --}}


              <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:
                </strong>{{$sanpham->id}}</p>
              <br>

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
             
                {{-- <div id="out" style="display: none" class="ribbon">Hết hàng</div> --}}
                {{-- @else <strong>Kho còn</strong> <a style="border-color: red;  border-style: double;font-size:16px">{{$sanpham->amount}}
                sản phẩm</a> @endif</p> --}}
           
              <label style="font-size:15px">Kho: <font id="amount_size" ></font></label>
             
            </div>
            <div class="space20">&nbsp;</div>
            <div class="space20">&nbsp;</div>
            <div class="single-item-desc">
         
            <label style="font-size:15px">Số lượng</label>
            <input class="center" style="font-weight: bold;width:50px" type="number" id="quantity" name="sl" min="1" value="1"
            >
          
            </div>
            <div class="space20">&nbsp;</div>
            <div class="space20">&nbsp;</div>
            <div class="single-item-desc">
            <label style="font-size:15px">Chọn size</label>
            <div class="single-item-options">
           
              @foreach ($sizes->sortBy('value') as $size)


              <input style="display: none" type="radio" id="{{$size->value}}" value="{{$size->value}}"
                onclick="choseSize({{$sanpham->id}},{{$size->value}})" name="buttonGroup"><label
                style="display:inline-block;background-color:#F0F0F0;padding:3px;margin:3px;border:1px solid;border-radius:3px;width:40px;text-align:center;"
                for="{{$size->value}}">{{$size->value}}</label>
              <style>
                input[type='radio'][name='buttonGroup']:checked+label {
                  color: #ee4d2d;
                  background-color: #ee4d2d;
                }
              </style>

              @endforeach
              
            </div>
            <div class="space20">&nbsp;</div>
            <div class="space20">&nbsp;</div>
              <div class="single-item-desc">
                @if(Auth::check())
              
                <button id="cartbtn" class="add-to-cart" onclick="addCart({{$sanpham->id}})"><i
                    class="fa fa-shopping-cart"></i></button>
               
                @else
              
                <a class="add-to-cart" href="{{route('login')}}"><button id="cartbtn" class="add-to-cart" ><i class="fa fa-shopping-cart"></i></button></a>
            
                @endif
            
              </div>

              {{-- <div class="clearfix"></div> --}}
            </div>
           
          
          </div>
        
        </div>
        <label style="display: none" id="lbl_size">empty</label>
        <label style="visibility: hidden" id="lbl_amount"></label>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



        <script language="javascript">
          // var vm = this;

                function choseSize(id_product,size)
                {
                   document.getElementById('lbl_size').textContent=size
                   $.get("/getAmount/"+id_product+'/'+size, function(data, status) {

                      if(data.amount!=0)
                       {

                        document.getElementById('amount_size').textContent=data.amount+' Sản phẩm'
                         document.getElementById('amount_size').style.color="green"
                         document.getElementById('cartbtn').style.display="block"
                         document.getElementById('lbl_amount').textContent=data.amount
                         
                        
                       
                       } 
                       else
                       { 
                       
                        document.getElementById('amount_size').textContent="Hết hàng"
                        document.getElementById('amount_size').style.color="red"
                        document.getElementById('cartbtn').style.display="none"
                       }
                      
                  
                                          
                   })
                   
                }
                function addCart(id)
                {
                  // var chose= $("#size :selected").val();
                    if( document.getElementById('lbl_size').textContent=='empty')
                    {
                     // alert("Vui lòng chọn size");
                     Swal.fire(
                            '',
                            'Vui lòng chọn size',
                            'question'
                            )
                    }
                    if(parseInt(document.getElementById('quantity').value) <=0 )
                    {
                     // alert("Vui lòng chọn size");
                     Swal.fire(
                            '',
                            'Số lượng bạn nhập sai định dạng',
                            'error'
                            )
                    }
                    else
                    {
                        if(parseInt(document.getElementById('quantity').value) > parseInt(document.getElementById('lbl_amount').textContent) )
                        {
                          Swal.fire(
                            '',
                            'Số lượng không đủ',
                            'error'
                            )
                        }
                        else
                        {
                           let data = {
                          'id' :   id,
                          'sl' : document.getElementById('quantity').value,
                          'size':document.getElementById('lbl_size').textContent
                        }
                        $.ajax({
                          url: '/add_to_card',
                          type: 'get',
                          data: data,
                        success: function (data) {
                          //window.location.reload();

                          $.get("/count_cart", function(data, status) {
                                        if (data >= 0) {

                                            if (status == "success") {
                                               document.getElementById('num_cart').textContent=data;
                                               window.location.reload();
                                            }
                                        } 
                          })

                          Swal.fire({
                            icon: 'success',
                            title:   'Đã thêm vào giỏ hàng' ,
                            showConfirmButton: false,
                            timer: 3000
                            })
                        }
                        }).then((data) => {
                          
                        }) 
                        }
                        

                           
                    }            
                }
                function imgClick()
                {
               

                  document.getElementById('img').src='source/image/product/{{$sanpham->image}}';
                  //document.getElementById('img1').src='source/image/product/{{$sanpham->image}}';
                  document.getElementById("img0").style.borderStyle = "inset";
                  document.getElementById("img0").style.borderColor = "#00FF00";
                  //
                  document.getElementById("img1").style.borderStyle = "";
                  document.getElementById("img1").style.borderColor = "";

                  document.getElementById("img2").style.borderStyle = "";
                  document.getElementById("img2").style.borderColor = "";
                  //
                  document.getElementById("img3").style.borderStyle = "";
                  document.getElementById("img3").style.borderColor = "";
                }
                function img1Click()
                {
             
                  document.getElementById('img').src='source/image/product/{{$sanpham->img1}}';
                  //document.getElementById('img1').src='source/image/product/{{$sanpham->image}}';
                  document.getElementById("img1").style.borderStyle = "inset";
                  document.getElementById("img1").style.borderColor = "#00FF00";
                  
                  document.getElementById("img0").style.borderStyle = "";
                  document.getElementById("img0").style.borderColor = "";
                  //
                  document.getElementById("img2").style.borderStyle = "";
                  document.getElementById("img2").style.borderColor = "";
                  //
                  document.getElementById("img3").style.borderStyle = "";
                  document.getElementById("img3").style.borderColor = "";
                }
                function img2Click()
                {
                

                  document.getElementById('img').src='source/image/product/{{$sanpham->img2}}';
                //  document.getElementById('img2').src='source/image/product/{{$sanpham->image}}';
                  document.getElementById("img2").style.borderStyle = "inset";
                  document.getElementById("img2").style.borderColor = "#00FF00";
                  //
                  document.getElementById("img1").style.borderStyle = "";
                  document.getElementById("img1").style.borderColor = "";

                  document.getElementById("img0").style.borderStyle = "";
                  document.getElementById("img0").style.borderColor = "";
                  //
                  document.getElementById("img3").style.borderStyle = "";
                  document.getElementById("img3").style.borderColor = "";
                }
                function img3Click()
                {
               

                  document.getElementById('img').src='source/image/product/{{$sanpham->img3}}';
                 // document.getElementById('img3').src='source/image/product/{{$sanpham->image}}';
                  document.getElementById("img3").style.borderStyle = "inset";
                  document.getElementById("img3").style.borderColor = "#00FF00";
                  //
                  document.getElementById("img1").style.borderStyle = "";
                  document.getElementById("img1").style.borderColor = "";

                  document.getElementById("img0").style.borderStyle = "";
                  document.getElementById("img0").style.borderColor = "";
                  //
                  document.getElementById("img2").style.borderStyle = "";
                  document.getElementById("img2").style.borderColor = "";
                }
                function doHoverImage1()
                {
                  
                  // document.getElementById("img1").style.borderStyle = "outset";
                  // document.getElementById("img1").style.borderColor = "red";
               
                  // document.getElementById("img2").style.borderStyle = "";
                  // document.getElementById("img2").style.borderColor = "";
                  // //
                  // document.getElementById("img3").style.borderStyle = "";
                  // document.getElementById("img3").style.borderColor = "";
                  
                }
                function doHoverImage2()
                {
                  // document.getElementById("img1").style.borderStyle = "outset";
                  // document.getElementById("img1").style.borderColor = "red";
               
                  // document.getElementById("img2").style.borderStyle = "";
                  // document.getElementById("img2").style.borderColor = "";
                  // //
                  // document.getElementById("img3").style.borderStyle = "";
                  // document.getElementById("img3").style.borderColor = "";
                }
                function doHoverImage3()
                {
                  //  document.getElementById("img1").style.borderStyle = "outset";
                  // document.getElementById("img1").style.borderColor = "red";
               
                  // document.getElementById("img2").style.borderStyle = "";
                  // document.getElementById("img2").style.borderColor = "";
                  // //
                  // document.getElementById("img3").style.borderStyle = "";
                  // document.getElementById("img3").style.borderColor = "";
                }
                function reloadImage()
                {
                  document.getElementById('img').src='source/image/product/{{$sanpham->image}}';

                  document.getElementById("img1").style.borderStyle = "";
                  document.getElementById("img1").style.borderColor = "";
                  //
                  document.getElementById("img2").style.borderStyle = "";
                  document.getElementById("img2").style.borderColor = "";

                  document.getElementById("img3").style.borderStyle = "";
                  document.getElementById("img3").style.borderColor = "";
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
            <li><a style="font-weight: bold;color: black;border-style: groove" href="#tab-image">Hướng dẫn chọn size
                giày</a></li>
            <li >
              <a style="font-weight: bold;color: black;border-style: groove" href="#tab-reviews">Đánh giá sản phẩm ({{$count_review}})</a>
            </li>
          </ul>
          <div class="panel" id="tab-description">
            @if($sanpham->description!=null)<p style=" color: black; font-family: Arial, Helvetica, sans-serif;">
              <font style="font-family: Arial, Helvetica, sans-serif">{!!$sanpham->description!!}</font>
              @else <p >Chưa có thông tin mô tả cho sản phẩm</p>
              @endif
          </div>
          <div class="panel" id="tab-image">
            <img src="source\image\size.png" alt="">
          </div>
          <div class="panel" id="tab-reviews"  >
         
          <iframe width="100%" height="700px" src="http://tomshoe.cc/product/review/{{$sanpham->id}}"></iframe>
            
          </div>
          
        </div>
        <div class="space50">&nbsp;</div>
        <div class="beta-products-list">
          <h4>Sản phẩm tương tự</h4>
          <div class="beta-products-details">
            {{-- <p class="pull-left">Tìm thấy {{count($sp_tuongtu)}} sản phẩm</p> --}}
            <div class="clearfix"></div>
          </div>
          <div class="row">
            @foreach ($sp_tuongtu as $sptt)
            <div class="col-sm-4">
              <div class="single-item" style="max-width: 275px">
                @if($sptt->promotion_price!=0)
                <div class="ribbon-wrapper">
                  <div class="ribbon ">Sale</div>
                </div>
                @endif
                <div class="single-item-header" style="height:270px;max-width: 270px;">
                  <a href="{{route('product-detail',$sptt->id)}}"><img src="source/image/product/{{$sptt->image}}"
                      alt="" height="250px" width="100%"></a>
                </div>
                <div class="single-item-body">
                  @if(strlen($sptt->name)<36)
                      <p class="single-item-title"><font>{{$sptt->name}}</font></p>
                      <br>
                      @else
                      <p class="single-item-title"><font>{{$sptt->name}}</font></p>
                      @endif
                  {{-- <p class="single-item-title" style="color: red;font-weight: bold"><strong> Mã sản phẩm:
                    </strong>{{$sptt->id}}</p> --}}
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
                  <a style=" cursor: pointer;">
                        <span><i id="{{'tim'.$sptt->id}}" onclick="doClick({{$sptt->id}})" class="fa fa-heart" style="font-size:20px;color: black"></i></span>
                 </a>  
              
               
                   <a href="{{route('product-detail',$sptt->id)}}"><button class="btn btn-primary" style="background-color: #3A5C83"> Chi tiết sản phẩm <i class="fa fa-chevron-right"></i> </button></a>
                    <div class="clearfix"></div>

                    @if(Auth::check())
                    @foreach($like_list as $l)
                        <script>
                          
                          
                            if({{$l->id_product_like}} === {{$sptt->id}}) {
                                document.getElementById('tim'+{{$sptt->id}}).style.color = "red"
                            }
                         </script>
                         {{-- @break($l->id_product_like == $sptt->id) --}}
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
      
            @endforeach
           
            <script>
              function doClick(id) {
                  if (document.getElementById('tim'+id).style.color == "black") // no like
                  {

                      //do like in controller
                      $.get("/like/" + id, function(data, status) {
                          if (data == "like_success") {

                              if (status == "success") {
                                  document.getElementById('tim'+id).style.color = "red";
                                  $.get("/count_like", function(data, status) {
                                        if (data >= 0) {

                                            if (status == "success") {
                                               document.getElementById('num_like').innerHTML=data;
                                            }
                                        } 
                                    })
                              }
                          }
                      })
                  }
                  if (document.getElementById('tim'+id).style.color == "red") //being like
                  {
                      //do like in controller
                      $.get("/dislike/" + id, function(data, status) {

                          if ( data == "dislike_success") {
                            if(status == "success" )
                            {
                              document.getElementById('tim'+id).style.color = "black";
                              $.get("/count_like", function(data, status) {
                                        if (data >= 0) {

                                            if (status == "success") {
                                               document.getElementById('num_like').innerHTML=data;
                                            }
                                        } 
                                    })
                            }
                             
                          }

                      })

                  }

              }

          </script>
          </div>
          <div class="row">{{$sp_tuongtu->links()}}</div>
        </div> <!-- .beta-products-list -->
      </div>
      <style>

        .img-hover-zoom {
                      width: 150%;
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

                    div.bigstars div.rateit-range
                    {
                        background: url(../sourceCode/rateit/example/content/star-white32.png);
                        height: 32px;
                    }
                    div.bigstars div.rateit-hover
                    {
                        background: url(../sourceCode/rateit/example/content/star-gold32.png);
                    }
                    div.bigstars div.rateit-selected
                    {
                        background: url(../sourceCode/rateit/example/content/star-red32.png);
                    }
                    div.bigstars div.rateit-reset
                    {
                        background: url(../sourceCode/rateit/example/content/star-black32.png);
                        width: 32px;
                        height: 32px;
                    }
                    div.bigstars div.rateit-reset:hover
                    {
                        background: url(../star-white32.png);
                    }
                    #style-14::-webkit-scrollbar-track
                      {
                        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.6);
                        background-color: #CCCCCC;
                      }

                      #style-14::-webkit-scrollbar
                      {
                        width: 10px;
                        background-color: #F5F5F5;
                      }

                      #style-14::-webkit-scrollbar-thumb
                      {
                        background-color: #FFF;
                        background-image: -webkit-linear-gradient(90deg,
                                                                  rgba(0, 0, 0, 1) 0%,
                                              rgba(0, 0, 0, 1) 25%,
                                              transparent 100%,
                                              rgba(0, 0, 0, 1) 75%,
                                              transparent)
                      }

      </style>
      <div class="col-sm-3 aside" style="max-width: 290px">
        <div class="widget"  id="style-14" style="overflow: auto;height: 450px;width:280px;font-family: Arial, Helvetica, sans-serif;font-size:15px">
          <h3 class="widget-title">Flash Sale</h3>
          <div class="widget-body">
            <div class="beta-sales beta-lists">
              @foreach($sp_sale as $sps)
              <div class="media beta-sales-item">
                <div class="ribbon-wrapper">
                  <div class="ribbon" style="font-size: 13px">Sale</div>
                </div>
                <a class="pull-left" href="{{route('product-detail',$sps->id)}}"><img
                    src="source/image/product/{{$sps->image}}" alt="" height="250px"></a>
                <div class="media-body">
                  <a href="{{route('product-detail',$sps->id)}}">
                    <p class="single-item-title">{{$sps->name}}</p>
                  </a>
                  <a href="{{route('product-detail',$sps->id)}}"><span
                      class="beta-sales-price">{{number_format($sps->unit_price)}} VND</span></a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          {{-- <div class="row">{{$sp_sale->links()}}</div> --}}
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