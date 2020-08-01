@extends('master')
@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
          
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                    <h4 class="center">Kết quả tìm kiếm cho <font style="font-weight:bold">"{{$keyword}}"</font> </h4>
                        <div class="beta-products-details">
                            {{-- <p class="pull-left">Tìm thấy {{count($sanpham)}} sản phẩm</p> --}}
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
                                        @if(strlen($p->name)<36)
                                        <p class="single-item-title"><font>{{$p->name}}</font></p>
                                        <br>
                                        @else
                                        <p class="single-item-title"><font>{{$p->name}}</font></p>
                                        @endif
                                        
                                        <p class="single-item-price" style="font-size: 18px ">
                                            @if($p->promotion_price==0)
                                            <span class="flash-sale">{{number_format($p->unit_price)}} VND</span> 
                                            @else
                                            <span class="flash-del">{{number_format($p->unit_price)}} VND</span>
                                            <span class="flash-sale">{{number_format($p->promotion_price)}} VND</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a style=" cursor: pointer;">
                                              <span><i id="{{$p->id}}" onclick="doClick({{$p->id}})" class="fa fa-heart" style="font-size:20px;color: black"></i></span>
                                       </a>  
                                      @if(Auth::check())
                                      @foreach($like_list as $l)
                                          <script>
                                              if({{$l->id_product_like}} =={{ $p->id}}) {
                                                  document.getElementById({{$p->id}}).style.color = "red"
                                              }
                                           </script>
                                           @break($l->id_product_like == $p->id)
                                      @endforeach
                                      @endif
                                         <a href="{{route('product-detail',$p->id)}}"><button class="btn btn-primary" style="background-color: #3A5C83"> Chi tiết sản phẩm <i class="fa fa-chevron-right"></i> </button></a>
                                          <div class="clearfix"></div>
  
                                      </div>
                                  </div>
                              </div>
                            @endforeach
                            <script>
                                function doClick(id) {
                
                
                                    if (document.getElementById(id).style.color == "black") // no like
                                    {
                
                                        //do like in controller
                                        $.get("/like/" + id, function(data, status) {
                                            if (data == "like_success") {
                
                                                if (status == "success") {
                                                    document.getElementById(id).style.color = "red";
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
                                    if (document.getElementById(id).style.color == "red") //being like
                                    {
                                        //do like in controller
                                        $.get("/dislike/" + id, function(data, status) {
                                            if (data == "dislike_success")
                                            {
                                                if ( status == "success" ) 
                                                {
                
                                                    document.getElementById(id).style.color = "black";
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
                      
                    </div>
                    <!-- .beta-products-list -->
                    <div class="space50">&nbsp;</div>             
                </div>
            </div>
      
          
           
            <!-- .beta-products-list -->
        </div>
    </div>
    <!-- end section with sidebar and main content -->
</div>
@endsection