@extends('master')
@section('content')

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;

            </div>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-7">
                      @foreach($order_history as $order)
                        
                
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">{{\Carbon\Carbon::parse($order->date_order)->format('d/m/Y - h:i:s')}}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th> 
                            <th scope="col"></th>

                            <th scope="col">Tổng: </th>
                            <th scope="col"> {{number_format($order->total)}}VND</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach(json_decode($order->product_order, true) as $item)
                          <tr>
                         
                            <td style="text-align: center;vertical-align: middle;">{{$item['product_name']}}</td>
                            <td style="text-align: center;vertical-align: middle;"><img src="source/image/product/{{$item['product_image']}}" alt="your image" style="width:70px;height:70px" /> </td>
                            <td style="text-align: center;vertical-align: middle;">Size: {{$item['size']}}</td>
                            <td style="text-align: center;vertical-align: middle;">x{{$item['amount']}}</td>
                            @if($item['promotion_price']== 0)
                            <td style="text-align: center;vertical-align: middle;">{{number_format($item['unit_price'])}}VND</td>
                              @else
                            <td style="text-align: center;vertical-align: middle;">
                                <strike>{{number_format($item['unit_price'])}}VND</strike>
                                <br>
                                <span style="color: red">{{number_format($item['promotion_price'])}}VND</span>
                            </td>
                            @endif
                            <td style="text-align: center;vertical-align: middle;"><a href="/product_detail/{{$item['product_id']}}"><button class="btn btn-success">Mua lại</button></a></td>
                           
                           
                         
                           
                          </tr>
                          
                          @endforeach
                          @if($order->isFinish==0 && $order->status!=0) 
                          <td style="text-align: center;vertical-align: middle;"><a href="{{route('user_delete_bill',['id_bill'=>$order->id])}}"><button class="btn btn-danger" onclick="return confirm('Bạn có muốn hủy đơn hàng')">Hủy Bỏ</button></a></td>
                          @endif
                        <td><a href="{{route('view_bill_detail',$order->id)}}"><button class="btn btn-warning">Chi tiết</button></a></td>
                        </tbody>
                      </table>
                      @endforeach
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
<br>                
<br>    
@endsection
