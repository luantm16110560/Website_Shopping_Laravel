@extends('master')
@section('content')
<?php  $sum=0; ?>
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
                        <h6 class="inner-title">Thông tin chi tiết giỏ hàng</h6>
                     </div>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Image</th>
                            <th scope="col">Size</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Tùy chọn</th>
                         
                          </tr>
                        </thead>
                        @foreach($list_sp as $like)
                        <tbody>
                          <tr>
                            <td>{{$like->product_name}}</td>
                            <td> <a class="pull-left" href="{{route('product-detail',$like->product_id)}}"><img
                                src="source/image/product/{{$like->product_image}}" alt=""
                                height="30px"></a>
                            </td>
                            <td>{{$like->size}}
                            </td>
                            <td>
                                <span class="cart-total-value">
                                @if($like->promotion_price==0){{number_format($like->price)}}
                                VND
                                @else {{number_format($like->promotion_price)}} VND 
                                @endif
                             </span>
                            </td>
                            <td>{{$like->amount}}
                            </td>
                            <td>
                                <span class="cart-total-value">
                                    @if($like->promotion_price==0){{number_format(($like->price)*($like->amount))}}
                                    VND
                                    @else {{number_format(($like->promotion_price)*($like->amount))}} VND 
                                    @endif
                                 </span>
                            </td>
                            <td>       
                            <a href="{{route('deletegiohang',['id_product'=>$like->product_id,'value'=>$like->size])}}" type="button" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa')"><span class="glyphicon glyphicon-trash"></span>
                            </td>
                          </tr>
                          <?php
                              if($like->promotion_price==0)
                                  {
                                      $sum=$sum+($like->price*$like->amount);
                                  }
                               else 
                                  {
                                     $sum=$sum+($like->promotion_price*$like->amount);
                                  }
                            
                          // foreach($list_sp as $like)
                          //     { 
                          //      if($like->promotion_price==0)
                          //         {
                          //             $sum=$sum+($like->price*$like->amount);
                          //         }
                          //      else 
                          //         {
                          //            $sum=$sum+($like->promotion_price*$like->amount);
                          //         }
                          //     }
                            ?>
                         </th>
                        </div>
                        </tbody>
                        @endforeach
                      </table>
                    </div>
                    </table>
                    
                </div>
                @if($sum!=null || $sum!=0)
                <div class="cart-caption">
                 
                    <div class="cart-total text-right"><strong>Tạm tính:</strong> <span
                          class="cart-total-value">{{number_format($sum)}} VND</span>
                    </div>
                  
                </div>
                @endif
                <div class="cart-caption">
                <div class="cart-total text-right">
                  <a href="{{route("order")}}">
                  <button class="btn btn-danger"><font style="corlor:white">THANH TOÁN</font></button> 
                  </a>
                </div>
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
@endsection