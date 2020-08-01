<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi tiết hóa đơn</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <base href="{{asset('')}}">
    <!--customjs-->

</head>

<body>
    <div class="left">

        <div class="row">
         
            <div class="col-md-9">
              
                <div class="col-sm-10">
                    <div style="padding: 8px; border: 10px inset #D44B47; word-wrap: break-word;">
                        <h2 style="text-align: center">Hóa Đơn Bán Hàng</h2>
                        @foreach($billdetail as $b)
                        <h3 style="text-align: center">Mã hóa đơn:&nbsp;&nbsp;{{$b->id}}</h3>
                        <br> @if(Session::has('thanhcong'))
                        <div class="alert alert-success">
                            {{Session::get('thanhcong')}}
                        </div>
                        @endif
                            <table class="meta">
                                <tr>
                                    <th><span contenteditable>Ngày đặt hàng:&nbsp;&nbsp;</span></th>
                                    <td><span contenteditable>{{ date('m/d/Y', strtotime($b->date)) }}</span></td>
                                </tr>
                                <tr>
                                    <th><span contenteditable>Khách hàng:&nbsp;&nbsp;</span></th>
                                    <td><span contenteditable>{{json_decode($b->cus_infor)->name}}</span></td>
                                </tr>
                                <tr>
                                    <th><span contenteditable>Liên hệ:&nbsp;&nbsp;</span></th>
                                    <td><span contenteditable>{{json_decode($b->cus_infor)->phone}}</span></td>
                                </tr>
                                <tr>
                                    <th><span contenteditable>Địa chỉ giao hàng:&nbsp;&nbsp;</span></th>
                                    <td>
                                        <span contenteditable>
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
                                <th><span contenteditable>Tạm tính:&nbsp;&nbsp;</span></th>
                                @if($ship->promotion_price==0)
                                <td><span contenteditable>{{number_format($ship->unit_price)}} VND</span></td>
                                @endif
                                @if($ship->promotion_price!=0)
                                <td><span contenteditable>{{number_format($ship->promotion_price)}} VND</span></td>
                                @endif
                            </tr>
                            <tr>
                                <th><span contenteditable>Phí vận chuyển:&nbsp;&nbsp;</span></th>
                                <td><span contenteditable>35,000 VND</span></td>
                            </tr>
                            <tr>
                                <th><span contenteditable>Tổng cộng:&nbsp;&nbsp;</span></th>
                                <td><span contenteditable>{{number_format($ship->total)}} VND</span></td>
                            </tr>
                            <tr>
                                <th><span contenteditable>Thanh toán:&nbsp;&nbsp;</span></th>
                                <td style="font-weight: bold;color:green"><span contenteditable>{{$ship->payment}}</span></td>
                            </tr>
                 

                        </table>
                    </div>
                </div>
                {{-- <div class="col-sm-2">
                </div> --}}
               <div class="col-sm-2">
                </div>
            </div>
        </div>

    </div>
</body>

</html>