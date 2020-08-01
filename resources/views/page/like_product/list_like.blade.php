@extends('master')
@section('content')

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space30">&nbsp;

            </div>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-7">
                      <div class="center">
                        <h6 class="inner-title">Danh sách sản phẩm yêu thích</h6>
                     </div>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                         
                          </tr>
                        </thead>
                        @foreach($like_sp as $like)
                      
                        <tbody>
                     
                          <tr>
                           
                            <th style="text-align: center;vertical-align: middle;"> <a href="{{route('product-detail',$like->product_id)}}">{{$like->product_name}}</a></th>
                         
                            <td> <a class="pull-left" href="{{route('product-detail',$like->product_id)}}"><img
                                src="source/image/product/{{$like->product_image}}" alt=""
                                height="80px"></a>
                            </td>
                            <td>
                                <span class="cart-total-value">
                                @if($like->promotion_price==0){{number_format($like->price)}}
                                VND
                                @else 
                                <strike style="color: black">{{number_format($like->price)}}</strike>
                                <br>
                                {{number_format($like->promotion_price)}} VND 
                                @endif
                             </span>
                            </td>
                            <td style="text-align: center;vertical-align: middle;">
                              <a href=""><span onclick="dis_like({{$like->product_id}})"><img src="source/image/icon/dislike.ico" ></span></a>
                             
                            
                          </td>
                          <script>
                            function dis_like(id_product)
                            {
                              $.get("/dislike/" + id_product, function(data, status) {
                          
                              if ( status == "success" && data == "dislike_success") {
                               
                                  window.location.reload();
                              }
                          
                            })
                          
                            }
                          </script>
                          </tr>
                        
                      
                      
                         </th>
                       
                        </tbody>
                         
                        @endforeach
                      </table>
                    </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
                   
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@endsection
