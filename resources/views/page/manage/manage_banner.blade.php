<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title >Banner quảng cáo</title>
   
    <script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <base href="{{asset('')}}">

  
</head>

<body>
    <div class="left">

        <div class="row">
            <div class="col-md-3" style="font-size: 18px">
                <div id="sidebar" class="well sidebar-nav" style="height: 100%">
                    <h5><i class="glyphicon glyphicon-home"></i>
                                <a href="{{route('admin')}}">
                                    <b>Về trang quản trị</b>
                                    </a>
                                </h5>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a></a></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li class="active"><a></a></li>
                        <li></li>
                        <li>
                            <div class="pull-right">
                                <a href="{{route('logout')}}">
                                    <button type="button" class="btn btn-danger">Đăng xuất</button>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div style="text-align: center" class="pull-left"> {{ $myDate = Carbon\Carbon::now()->format('d/m/Y')}}</div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-md-9">
                   
                  
                    <h2 id="type" style="text-align: center">Banner</h2>
                    <br>
        
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Hình ảnh</th>
                            <th>Tùy chỉnh</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($slides as $slide)
                          <tr>
                            <td >{{$slide->id}}</td>
                            <td>  <img style="width: 500px;height: 200px;" src="source/image/banner/{{$slide->image}}"></td>
                            <td>
                            <a href="/banner/delete/{{$slide->id}}" data-toggle="modal" type="button" class="btn btn-danger"><span  class="glyphicon glyphicon-trash"></span>   
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    <a href="#addImage" data-toggle="modal"><button class="btn btn-success">Thêm hình</button></a>
            </div>
            <div id="addImage" class="modal fade" >
                <div class="modal-dialog" >
                    <div class="modal-content">
                        
                    <form enctype="multipart/form-data" action="{{route('post_banner')}}" method="post" >
                            @csrf
                            <div class="modal-header">						
                                <h4 class="modal-title">Thêm hình</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body" >	
                                         
                                <div class="form-group" style="width: 30%">
                                    <input  type='file' id="imageInput" name="imageInput" accept="
                                    image/*"  />
                                    <br>
                               
                                </div>
                                <div class="modal-footer">
                              
                                    <input type="submit" class="btn btn-success" value="Lưu">
                                    <input type="button" class="btn btn-warning" data-dismiss="modal" value="Hủy">
                                </div>
                            
                        
                                    
                            </div>
                         
                        </form>
                    </div>
                </div>
            </div>
           
        </div>

    </div>
</body>


</html>