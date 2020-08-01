@extends('master')
@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <style>
                        .card {
                            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                            transition: 0.3s;
                            width: 40%;
                            border-radius: 5px;
                        }
                        
                        .card:hover {
                            box-shadow: 0 8px 16px 0 red;
                        }
                        
                        img {
                            border-radius: 5px 5px 0 0;
                        }
                        
                        .container {
                            padding: 2px 16px;
                        }
                    </style>
                    
                    <div class="container">
                        <div class="row">
                         
                            <div class="col-sm-3">    
                                <br>
                                <div class="card" style="width:13rem; height: 13rem;">
                                    <a href="{{route('manage-product')}}">
                                    <img src="source/image/manager/shoes-icon.jpg" alt="Avatar" style="width:13rem; height: 13rem">
                                    </a>
                                    <div class="center">
                                        <a href="{{route('manage-product')}}">
                                        <h4><b>Sản phẩm</b></h4>
                                        </a>
                                    </div>
                                </div>
                            </div>                
                            <div class="col-sm-3">        
                               @if(count($bill)>0)
                                <a style="margin-top:10px" href="{{route('list_bill_wait_confirm')}}">
                                    <marquee class="pull-left" style="color: red;font-size: 18px;font-weight: bold" behavior="alternate" width="10%">>></marquee>
                                    <p  style="text-align: center;color: red;font-weight: bold;font-size: 14px">Có {{count($bill)}} hóa đơn mới</p>                                         
                                </a>
                                @else
                                <br>
                                @endif
                                    <div class="card" style="width:13rem; height: 13rem;">                 
                                    <a href="{{route('manage_bill')}}">
                                    <img src="source/image/manager/icon-invoice.jpg" alt="Avatar" style="width:13rem; height: 13rem">
                                    </a>
                                    <div class="center">
                                        <a href="{{route('manage_bill')}}">
                                        <h4><b>Hóa đơn</b></h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-3">
                             <br>
                                <div class="card" style="width:13rem; height: 13rem;">
                                    <a href="{{route('manage-user')}}">
                                    <img src="source/image/manager/icon-customer.png" alt="Avatar" style="width:13rem; height: 13rem">
                                    </a>
                                    <div class="center">
                                        <a href="{{route('manage-user')}}">
                                        <h4><b>Khách hàng</b></h4>
                                      </a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-sm-3">   
                               
                                <br>
                                <div class="card" style="width:13rem; height: 13rem;">
                                    <a href="{{route('inventory')}}">
                                    <img src="source/image/manager/inventory.png" alt="Avatar" style="width:13rem; height: 13rem">
                                    </a>
                                    <div class="center">
                                        <a href="{{route('manage-product')}}">
                                        <h4><b>Kho hàng</b></h4>
                                        </a>
                                    </div>
                                </div>                            
                            </div>
                            
                            <div class="col-sm-3">    
                                <br>     
                                <div class="card" style="width:13rem; height: 13rem;">
                                   <a href="{{route('banner')}}">
                                   <img src="source/image/manager/banner.png" alt="Avatar" style="width:13rem; height: 13rem">
                                   </a>
                                   <div class="center">
                                       <a href="{{route('banner')}}">
                                       <h4><b>Banner</b></h4>
                                     </a>
                                   </div>
                               </div>   
                            </div>                
                     
                         
                       

                        </div>

                    </div>

                    <br>
                    <br>

                    {{-- <div class="container">
                        <div class="row">
                         
                            <div class="col-sm-3">    
                                <br>     
                                <div class="card" style="width:13rem; height: 13rem;">
                                   <a href="{{route('report')}}">
                                   <img src="source/image/manager/report.png" alt="Avatar" style="width:13rem; height: 13rem">
                                   </a>
                                   <div class="center">
                                       <a href="{{route('report')}}">
                                       <h4><b>Thống kê</b></h4>
                                     </a>
                                   </div>
                               </div>   
                            </div>                
                            <div class="col-sm-3">        
                          
                            </div>
                            <div class="col-sm-3">
                             
                            </div>
                            <div class="col-sm-3">   
                                                
                            </div>
                     
                         
                       

                        </div>

                    </div> --}}
                </div>
            </div>
        </div>
        <!-- end section with sidebar and main content -->
    </div>
    
</div>
<br>
<br>
<br>
@endsection
                          