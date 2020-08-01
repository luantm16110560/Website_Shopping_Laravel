<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng sản phẩm</title>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js">
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
                        <li class="active"><a>Sản phẩm</a></li>
                        <li><a href="{{route('upload_product')}}">Đăng bán sản phẩm mới</a></li>
                        <li><a href="{{route('get_list_product')}}">Quản lý sản phẩm</a></li>
                        <li><a href="{{route('search_product')}}">Tra cứu sản phẩm</a></li>
                        <li><a href="{{route('sale_of_product')}}">Sản phẩm khuyến mãi</a></li>
                        <li class="active"><a>Danh mục sản phẩm</a></li>
                        <li><a href="{{route('get_list_type_product')}}">Quản lý danh mục</a></li>
                        <li>
                            <div class="pull-right">
                                <a href="{{route('logout')}}">
                                    <button type="button" class="btn btn-danger">Đăng xuất</button>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div style="text-align: center" class="pull-left">
                                {{ $myDate = Carbon\Carbon::now()->format('d/m/Y')}}</div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-md-9">

                @if(Session::has('thongbao'))
                <div class="alert alert-success" style="text-align: center; font-size: 16px; font-weight: bold">
                    {{Session::get('thongbao')}}</div>
                @endif
                <h2 style="text-align: center">Đăng sản phẩm mới</h2>

                <form action="{{route('add_product')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="col-sm-4">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <img id="myimage" 
                            style="width:280px;height:280px" src="source/image/product/defaul_product.png" />
                        <input style="display:none;" type='file' id="imageInput" name="imageInput" accept="
                                    image/*"  />
                        <br>
                        <div style="text-align: center">
                            <input type="button" id="button" name="button" class="btn btn-primary" value="Hình"
                                onclick="document.getElementById('imageInput').click();" />
                        </div>
                        <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function(e) {
                                        $('#myimage').attr('src', e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                            $("#imageInput").change(function() {
                                readURL(this);
                            });

                        </script>
                        <br>
                        <br>
                        <div class="col-sm-3">
                            <div>
                                <img id="img1" style="width:100px;height:100px" src="source/image/product/defaul_product.png" />
                                <input style="display:none;" type="file" accept="image/*" id="imageInput1"
                                    name="imageInput1"  onchange="preview_image(event)">
                            </div>
                            <br>
                            <input type="button" required class="btn btn-primary" id="button1" name="button1" value="Hình 1"
                                onclick="document.getElementById('imageInput1').click();" />
                            <script type='text/javascript'>
                                function preview_image(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('img1');
                                        output.src = reader.result;
                                    }
                                    reader.readAsDataURL(event.target.files[0]);
                                }

                            </script>
                        </div>
                        <div class="col-sm-1">
                        </div>

                        <div class="col-sm-3">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                            <div>
                                <img id="img2" style="width:100px;height:100px" src="source/image/product/defaul_product.png" />
                                <input style="display:none;" type='file' id="demo" name="imageInput2"
                                    accept="image/*" />
                            </div>
                            <br>
                            <input type="button" class="btn btn-primary" id="button2" name="button2" value="Hình 2"
                                onclick="document.getElementById('demo').click();" />
                            <script>
                                function display(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(event) {
                                            $('#img2').attr('src', event.target.result);
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#demo").change(function() {
                                    display(this);
                                });

                                function thisFileUpload2() {
                                    document.getElementById("demo").click();
                                }

                            </script>

                            <div style="text-align: left; margin-top: 100px">
                                <input type="submit" id="button" onclick="doClick()" name="button" class="btn btn-success" value="Lưu"
                                    style="width: 300px;height: 50px ;text-align: center" />
                            </div>
                        </div>
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-3">
                            <div>
                                <img id="img3" style="width:100px;height:100px" src="source/image/product/defaul_product.png" />
                                <input style="display:none;" type="file" accept="image/*" id="imageInput3"
                                    name="imageInput3" onchange="preview_image_3(event)">
                            </div>
                            <br>
                            <input type="button" class="btn btn-primary" id="button3" name="button3" value="Hình 3"
                                onclick="document.getElementById('imageInput3').click();" />
                            <script type='text/javascript'>
                                function preview_image_3(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('img3');
                                        output.src = reader.result;
                                    }
                                    reader.readAsDataURL(event.target.files[0]);
                                }

                            </script>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Tên sản phẩm</h4>
                        </div>
                        <div class="col-sm-7">
                            {{-- <input type="text" name="name" style="height: 25px;width: 300px; margin-top: 5px" required /> --}}
                            
                            <input type="text" maxlength="36"  name="name"
                                style="height: 25px;width: 300px; margin-top: 5px" required
                              />
                                {{-- <input type="text"  name="name"
                                style="height: 25px;width: 300px; margin-top: 5px" required
                                onkeypress="return isNumberKey(event)" /> --}}
                        </div>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Giới tính</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top: 5px">
                            <input type="radio" name="gender" required value="Nam">Nam
                            <input type="radio" name="gender" value="Nữ">Nữ
                        </div>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Loại sản phẩm</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top: 5px; height: 25px;width: 300px">
                            <select class="form-control" name="select">
                                @foreach ($type as $t)
                                {{-- <option value="{{$t->id}}">{{$t->name}}</option> --}}
                                @if ($t->id > 0)
                                    <option selected value="{{ $t->id  }}">{{ $t->name }}</option>
                                @else
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Giá sản phẩm</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top: 5px">
                            <input type="number" name="unit_price" required>
                            <label>Giá gốc</label>
                            <input type="number" min=0 name="promotion_price" value="0">
                            <label>Khuyến mãi</label>

                        </div>
                    </div>

                    {{-- --------------------------------------- --}}
                    <input type="hidden" id="data_arr" name="data_arr"  type="text"/>

                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Size</h4>
                        </div>
                        <div id="size_amount" class="col-sm-7" style="margin-top: 5px" >
                            {{-- <div id="btn_group" class="btn-group" >
                                <button type="button" class="btn btn-light" id="35">35</button>
                                <button type="button" class="btn btn-light" id="36">36</button>
                                <button type="button" class="btn btn-light" id="37">37</button>
                                <button type="button" class="btn btn-light" id="38">38</button>
                                <button type="button" class="btn btn-light" id="39">39</button>
                                <button type="button" class="btn btn-light" id="40">40</button>
                                <button type="button" class="btn btn-light" id="41">41</button>
                                <button type="button" class="btn btn-light" id="42">42</button>
                                <button type="button" class="btn btn-light" id="43">43</button>
                            </div> --}}
                            <button id="them" type="button" onclick="myFunction()">Thêm</button>



                            <br>
                            <script>


                                var i=-1;
                                var data= []; 
                                    function myFunction() {
                                    i++;

                                    // if(i>=1)
                                    // {    var size_before=i-1;
                                    //     var amount_before=i-1;

                                    //     var size_before_value=document.getElementById('size_'+size_before).value;
                                    //     var amount_before_value=document.getElementById('amount_'+amount_before).value;

                                    //    if(size_before_value=="" ||amount_before_value=="" )
                                    //    {
                                    //         alert('Nhập đầy đủ thông tin size và số lượng');
                                    //    }
                                    // }

                                    

                                    var size = document.createElement("input");
                                    var amount = document.createElement("input");
                                    //size.setAttribute("required", "");
                                    //amount.setAttribute("required", "");
                                    var btn = document.createElement("button");
                                    var p = document.createElement("p");
                                    
                                        
                                    size.required=true
                                    amount.required=true
                                    
                                    size.placeholder="Size";
                                    size.type="number";
                                    size.style.width="50px";
                                    size.required = true;
                                    //size.setAttribute("required", "");
                                    size.id="size_"+i;
                                    
                                    size.min="0";

                                    amount.placeholder="Số lượng";
                                    amount.type="number";
                                    amount.style.width="80px";
                                    amount.required = true;
                                    //amount.setAttribute("required", "");
                                    amount.id="amount_"+i;
                                    amount.min="0";
                              
                                    btn.type="button";
                                    btn.innerHTML="<id='btn' onclick='delItem(\""+i+"\")' />Xóa";
                                    btn.id="btn_"+i;
                                
                                    document.getElementById("size_amount").appendChild(size);
                                    document.getElementById("size_amount").appendChild(amount);
                                    document.getElementById("size_amount").appendChild(btn);
                                    document.getElementById("size_amount").appendChild(document.createElement("p"));

                                    var temp=i-1;
                                    var id_size="size_"+temp;
                                    var id_amount="amount_"+temp;
                                    var size;
                                    var amount;

                
                                        var element_size=document.getElementById(id_size);
                                        var element_size=document.getElementById(id_amount);

                                        if(element_size !=null && element_size!=null)
                                        {
                                            _size=document.getElementById(id_size).value;
                                            _amount=document.getElementById(id_amount).value;
                                            //alert(_size+ ' : '+_amount)  
                                            if(_size!="" && _amount!="")
                                            {
                                                data.push({size:_size,amount:_amount})
                                                 
                                            }
                                            
                                        }  
                                        //console.log(data);
                                        var json=JSON.stringify(data);
                                        document.getElementById('data_arr').value=json;
                                       
                                    }
                                   function delItem(x)
                                    {
                                        var delSize = document.getElementById("size_"+x);                          
                                        var delButton = document.getElementById("btn_"+x);
                                        var delAmount = document.getElementById("amount_"+x);

                                        item_size_remove=document.getElementById("size_"+x).value;
                                        item_amount_remove=document.getElementById("amount_"+x).value

                                        if(item_size_remove!="" && item_amount_remove!="")
                                       {
                                          newarr=data.filter(function(value){
                                            return value.size != item_size_remove &&
                                            value.amount != item_amount_remove;
                                          });
                                          data=newarr;
                                       }
                                        else
                                        {
                                            data=data;
                                        }
                                      
                                        var json=JSON.stringify(data);
                                        document.getElementById('data_arr').value=json;
                                        //console.log(data)
                                        delSize.parentNode.removeChild(delSize);
                                        delAmount.parentNode.removeChild(delAmount);
                                        delButton.parentNode.removeChild(delButton);

                                        

                                    
                                    }
                                    function doClick()
                                    {
                                       
                                        if(
                                            document.getElementsByName('name').value!=null 
                                         && document.getElementsByName('gender').value!=null 
                                      
                                         
                                         && document.getElementsByName('unit_price').value!=null
                                         && document.getElementsByName('promotion_price').value!=null
                                      
                                         )
                                       { 
                                        document.getElementById("them").click();
                                        var json=JSON.stringify(data);
                                        document.getElementById('data_arr').value=json;
                                       }
                                    }
                                   
                                  
                            </script>
                        </div>
                    </div>
                    <style>
                        .btn-light {
                            margin: 5px
                        }
                    </style>

                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="col-sm-5">
                            <h4 class="right" style="margin-left: 75px">Mô tả</h4>
                        </div>
                        <div class="col-sm-7" style="margin-top:5px">
                            <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
                            <textarea style="font-family: Arial, Helvetica, sans-serif" name="description"></textarea>
                            <script>
                                CKEDITOR.replace('description');
                               
                            </script>
                        </div>
                    </div>
                   

                </form>

            </div>
        </div>

    </div>
</body>

</html>