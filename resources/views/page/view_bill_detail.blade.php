@extends('master')
@section('content')


<div class="container">
    <style>
        p.boderexam1 {
            padding: 15px;
            border: 5px solid green;
        }
    </style>
@if($bill->status==0)
<img src="/source/image/icon/cancel.ico"><font style="font-size:25px">Đã hủy đơn hàng</font>

    @else
        @if($bill->isFinish==0)
        <span>
        <img src="/source/image/icon/wait.ico"><font style="font-size:25px">Chờ xác nhận đơn hàng</font>
        </span>
        @else
            @if($bill->isFinish==1 && $bill->ship==0)
                <span>
                <img src="/source/image/icon/check.ico"><font style="font-size:25px">Đã xác nhận đơn hàng</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="/source/image/icon/logistic.ico"><font style="font-size:25px">Đang vận chuyển</font>
                </span>
            @endif        
            @if($bill->isFinish==1 && $bill->ship==1)
                <span>
                <img src="/source/image/icon/check.ico"><font style="font-size:25px">Đã xác nhận đơn hàng</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="/source/image/icon/check.ico"><font style="font-size:25px">Đã giao hàng</font>
                <img src="/source/image/icon/check.ico"><font style="font-size:25px">Đã nhận hàng</font>
                </span>
            @endif

        @endif
@endif
       
     <br>
     <br>
     

    <div style="padding: 8px; border: 10px inset #D44B47; word-wrap: break-word;">
        <h2 style="text-align: center">Hóa Đơn Bán Hàng</h2>
        @foreach($billdetail as $b)
        <h3 style="text-align: center">Mã hóa đơn:&nbsp;&nbsp;{{$b->id}}</h3>
        <br>
            <table class="meta">
                <tr>
                    <th><span >Ngày đặt hàng:&nbsp;&nbsp;</span></th>
                    <td><span >{{ date('m/d/Y', strtotime($b->date)) }}</span></td>
                </tr>
                <tr>
                    <th><span >Khách hàng:&nbsp;&nbsp;</span></th>
                    <td><span >{{json_decode($b->cus_infor)->name}}</span></td>
                </tr>
                <tr>
                    <th><span >Liên hệ:&nbsp;&nbsp;</span></th>
                    <td><span >{{json_decode($b->cus_infor)->phone}}</span></td>
                </tr>
                <tr>
                    <th><span >Địa chỉ giao hàng:&nbsp;&nbsp;</span></th>
                    <td>
                        <span >
                        {{json_decode($b->cus_address)->address}},
                        {{json_decode($b->cus_address)->ward}},
                        {{json_decode($b->cus_address)->district}},
                        {{json_decode($b->cus_address)->province}}
                        </span>
                    </td>
                </tr>
            </table>
            @break
            @endforeach
        <hr></hr>
        <table class="table table-hover">
           
            <thead>
              <tr>
                <th  valign="center">Mã sản phẩm</th>
                <th  valign="center">Tên sản phẩm</th>
                <th valign="center">Size</th>
                <th  valign="center">Đơn giá</th>
                <th  valign="center">Số lượng</th>
                <th  valign="center">Thành tiền</th>
              </tr>
            </thead>
            @foreach($billdetail as $bd)
            <tbody>
              <tr>
                <th>{{$bd->product_id}}</th>
                <td style="width: 200px">{{$bd->product_name}}</td>
                <td>{{$bd->size}}</td>

                @if($bd->promotion_price==0)
                <td>{{number_format($bd->unit_price)}}</td>
                <td>{{$bd->amount}}</td>
                <td>{{number_format($bd->amount*$bd->unit_price)}}</td>
                @else
                <td>{{number_format($bd->promotion_price)}}</td>
                <td>{{$bd->amount}}</td>
                <td>{{number_format($bd->amount*$bd->promotion_price)}}</td>
                @endif

              
              </tr>
             
            </tbody>
            @endforeach
          </table>
          <hr></hr>
          <table class="meta">
         
            <tr>
                <th><span >Tạm tính:&nbsp;&nbsp;</span></th>
                @if($ship->promotion_price==0)
                <td><span >{{number_format($ship->unit_price)}} VND</span></td>
                @endif
                @if($ship->promotion_price!=0)
                <td><span >{{number_format($ship->promotion_price)}} VND</span></td>
                @endif
            </tr>
            <tr>
                <th><span >Phí vận chuyển:&nbsp;&nbsp;</span></th>
                <td><span >35,000 VND</span></td>
            </tr>
            <tr>
                <th><span >Tổng cộng:&nbsp;&nbsp;</span></th>
                <td><span >{{number_format($ship->total)}} VND</span></td>
            </tr>
            <tr>
                <th><span >Thanh toán:&nbsp;&nbsp;</span></th>
                <td style="font-weight: bold;color:green"><span >{{$ship->payment}}</span></td>
            </tr>


        </table>
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

@endsection
