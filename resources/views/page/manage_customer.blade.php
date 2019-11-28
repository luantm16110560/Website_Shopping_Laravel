@extends('master')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <h4 class="card-title" style="text-align: center;font-weight: bold">Danh sách khách hàng</h4>
                <br>
                <br>
                <div style="overflow-x:auto;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <div class="col-sm-1">
                                    <th>ID</th>
                                </div>
                                <div class="col-sm-2">
                                    <th>Tên khách hàng</th>
                                </div>
                                <div class="col-sm-1">
                                    <th>Giới tính</th>
                                </div>
                                <div class="col-sm-2">
                                    <th>Email</th>
                                </div>
                                <div class="col-sm-2">
                                    <th>Địa chỉ</th>
                                </div>
                                <div class="col-sm-1">
                                    <th>Điện thoại</th>
                                </div>
                                <div class="col-sm-1">
                                    <th>Ghi chú</th>
                                </div>
                                <div class="col-sm-2">
                                    <th>Tùy chọn</th>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer as $cus)
                            <tr>
                                <div class="col-sm-1">
                                    <td>{{$cus->id}}</td>
                                </div>
                                <div class="col-sm-2">
                                    <td>{{$cus->name}}</td>
                                </div>
                                <div class="col-sm-1">
                                    <td>{{$cus->gender}}</td>
                                </div>
                                <div class="col-sm-2">
                                    <td>{{$cus->email}}</td>
                                </div>
                                <div class="col-sm-2">
                                    <td>{{$cus->address}}</td>
                                </div>
                                <div class="col-sm-1">
                                    <td>{{$cus->phone_number}}</td>
                                </div>
                                <div class="col-sm-1">
                                    <td>{{$cus->note}}</td>
                                </div>
                                <div class="col-sm-2">
                                    <td>
                                        <a href="#deleteCustomer" data-toggle="modal">
                                        <button class="btn btn-danger" style="width: 55px;height:  38px;">Xóa</button>&nbsp;
                                        </a>
                                        <a href="#editCustomer" data-toggle="modal">
                                            <button class="btn btn-primary" style="width: 55px;height:38px;">Sửa</button>
                                        </a>
                                    </td>
                                </div>
                            </tr>
                            @endforeach
                            <script>
                                $('.table tbody').on('click', '.btn-primary', function() {
                                    var currow = $(this).closest('tr');
                                    var name = currow.find('td:eq(1)').text();
                                    var gender = currow.find('td:eq(2)').text();
                                    var email = currow.find('td:eq(3)').text();
                                    var address = currow.find('td:eq(4)').text();
                                    var phone = currow.find('td:eq(5)').text();
                                    var note = currow.find('td:eq(6)').text();

                                    document.getElementById("name").value = name;
                                    document.getElementById("gender").value = gender;
                                    document.getElementById("email").value = email;
                                    document.getElementById("address").value = address;
                                    document.getElementById("phone").value = phone;
                                    document.getElementById("note").value = note;
                                })
                            </script>
                            <div id="editCustomer" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form>
                                            <div class="modal-header">
                                                <h4 class="modal-title">Sửa thông tin khách hàng</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Tên khách hàng</label>
                                                    <input type="text" id="name" style="width: 350px" class="form-control" required>
                                                </div>
                                                <label>Giới tính</label>
                                                <select style="width: 55px;height: 37px;font-weight: bold" id="gender">
                                                    <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option>
                                                </select>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Email</label>
                                                    <input type="email" id="email" style="width: 250px" class="form-control form-control-lg rounded-0" required>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Địa chỉ</label>
                                                    <textarea class="form-control form-control-lg rounded-0" id="address" required></textarea>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Điện thoại</label>
                                                    <input type="number" min="1" style="width: 250px" id="phone" class="form-control form-control-lg rounded-0" required>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Ghi chú</label>
                                                    <textarea class="form-control form-control-lg rounded-0" id="note"></textarea>
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
                            <div id="deleteCustomer" class="modal fade">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <form>
                                      <div class="modal-header">						
                                        <h4 class="modal-title">Xóa khách hàng</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                      </div>
                                      <div class="modal-body">					
                                        <p style="font-weight: bold;color: red">Bạn có muốn xóa khách hàng này</p>
                                      
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
                            <div id="addCustomer" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form>
                                            <div class="modal-header">
                                                <h4 class="modal-title">Thêm khách hàng mới</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Tên khách hàng</label>
                                                    <input type="text" id="name" style="width: 350px" class="form-control" required>
                                                </div>
                                                <label>Giới tính</label>
                                                <select style="width: 55px;height: 37px;font-weight: bold" id="gender">
                                                    <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option>
                                                </select>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Email</label>
                                                    <input type="email" id="email" style="width: 250px" class="form-control form-control-lg rounded-0" required>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Địa chỉ</label>
                                                    <textarea class="form-control form-control-lg rounded-0" id="address" required></textarea>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Điện thoại</label>
                                                    <input type="number" min="1" style="width: 250px" id="phone" class="form-control form-control-lg rounded-0" required>
                                                </div>
                                                <div class="form-group" style="font-weight: bold">
                                                    <label>Ghi chú</label>
                                                    <textarea class="form-control form-control-lg rounded-0" id="note"></textarea>
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
                            
                        </tbody>
                    </table>
                </div>
              </div>
            <a href="#addCustomer" data-toggle="modal">
                <button class="btn btn-success">Thêm mới</button>
            </a>
        </div>
    </div>
</div>
<br>
<br>
<br>
 @endsection