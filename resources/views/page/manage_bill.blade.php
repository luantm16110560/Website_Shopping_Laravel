<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <title>Quản lý hóa đơn</title>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3" style="font-size: 18px">
                    <div id="sidebar" class="well sidebar-nav" style="height: 100%">
                        <h5><i class="glyphicon glyphicon-home"></i>
                                    <a href="{{route('home-page')}}">
                                        <b>Về trang chủ</b>
                                        </a>
                                    </h5>
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a>Sản phẩm</a></li>
                            <li><a href="{{route('upload_product')}}">Đăng bán sản phẩm mới</a></li>
                            <li><a href="{{route('crud_product')}}">Quản lý sản phẩm</a></li>
                            <li><a href="{{route('sale_of_product')}}">Sản phẩm khuyến mãi</a></li>
                            <li class="active"><a>Danh mục sản phẩm</a></li>
                            <li><a href="{{route('cate_product')}}">Quản lý danh mục</a></li>
                            <li>
                                <div class="pull-right">
                                    <a href="{{route('dangxuat')}}">
                                        <button type="button" class="btn btn-danger">Đăng xuất</button>
                                    </a>
                                </div>
                            </li>
                            </li>
                            <div style="text-align: center" class="pull-left"> {{ $myDate = Carbon\Carbon::now()->format('d/m/Y')}}</div>
                            </li>
                        </ul>

                    </div>

                </div>

           
            <div class="col-md-9">
                <h4 style="text-align: center">Trang quản lý hóa đơn</h4>


                <div style="overflow-x:auto;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <div class="col-sm-1">
                                    <th>Mã hóa đơn</th>
                                </div>
                                <div class="col-sm-2">
                                    <th>Ngày đặt hàng</th>
                                </div>
                                <div class="col-sm-2">
                                    <th>Tổng cộng</th>
                                </div>
                                <div class="col-sm-1">
                                    <th>Phương thức thanh toán</th>
                                </div>
                                <div class="col-sm-3">
                                    <th>Ghi chú</th>
                                </div>
                                <div class="col-sm-1">
                                    <th>Trạng thái</th>
                                </div>
                                <div class="col-sm-2">
                                    <th>Tùy chọn</th>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill as $b)
                            <tr>
                                <div class="col-sm-1">
                                    <td>{{$b->id}}</td>
                                </div>
                                <div class="col-sm-2">
                                    <td>{{$b->date_order}}</td>
                                </div>
                                <div class="col-sm-2">
                                    <td>{{$b->total}}</td>
                                </div>
                                <div class="col-sm-1">
                                    <td>{{$b->payment}}</td>
                                </div>
                                <div class="col-sm-3">
                                    <td>{{$b->note}}</td>
                                </div>
                                <div class="col-sm-1">
                                    @if ($b->isFinish == 1)
                                    <td style="color: green">Đã xác nhận</td>
                                    @else
                                    <td style="color: red">Chờ xác nhận</td>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    <td>
                                        <a href="#deleteBill" data-toggle="modal">
                                            <button class="btn btn-danger" style="width: 55px;height:  38px;"><span class="glyphicon glyphicon-trash"></span></button>&nbsp;
                                        </a>
                                        <a href="#editBill" data-toggle="modal">
                                            <button class="btn btn-primary" style="width: 55px;height:38px;"><span class="glyphicon glyphicon-cog"></span></button>
                                        </a>
                                    </td>
                                   
                                </div>
                            </tr>
                      
                            @endforeach  
                            
                           
                            <script>
                                $('.table tbody').on('click', '.btn-primary', function() {
                                    var currow = $(this).closest('tr');
                                    var id = currow.find('td:eq(0)').text();
                                    var date = currow.find('td:eq(1)').text();
                                    var total = currow.find('td:eq(2)').text();
                                    var payment = currow.find('td:eq(3)').text();
                                    var note = currow.find('td:eq(4)').text();
                                    var status = currow.find('td:eq(5)').text();

                                    document.getElementById("id").value = id;
                                    document.getElementById("date").value = date;
                                    document.getElementById("total").value = total;
                                    document.getElementById("payment").value = payment;
                                    document.getElementById("note").value = note;
                                    document.getElementById("status").value = status;

                                })
                            </script>
                            <div id="editBill" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form>
                                            <div class="modal-header">
                                                <h4 class="modal-title">Sửa thông tin hóa đơn</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Mã hóa đơn</label>
                                                    <input type="text" id="id" style="width: 350px" class="form-control" disabled>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Ngày đặt (y/m/d h:m:s)</label>
                                                    <input type="datetime" id="date" style="width: 350px" class="form-control" required>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Tổng cộng</label>
                                                    <input type="number" min="0" id="total" style="width: 250px" class="form-control form-control-lg rounded-0" required>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Phương thức thanh toán</label>
                                                    <input type="text" style="width: 250px" id="payment" class="form-control form-control-lg rounded-0" required>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Ghi chú</label>
                                                    <textarea class="form-control form-control-lg rounded-0" id="note"></textarea>
                                                </div>

                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Trạng thái</label>
                                                    <input type="text" style="width: 250px" id="status" class="form-control form-control-lg rounded-0">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                <input type="submit" class="btn btn-info" value="Save">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="deleteBill" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form>
                                            <div class="modal-header">
                                                <h4 class="modal-title">Xóa hóa đơn</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p style="font-weight: bold;color: red">Bạn có chắc chắn xóa hóa đơn này</p>

                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                </div>
              
                </tbody>
              
                </table>
                <div  style="text-align: center" >
                        {{$bill->links()}}
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>