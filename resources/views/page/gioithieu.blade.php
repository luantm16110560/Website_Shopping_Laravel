@extends('master')
@section('content')
<div class="inner-header">
  <div class="container">
    <div class="pull-left">
      <h6 class="inner-title">Giới thiệu</h6>
    </div>
    <div class="pull-right">
      <div class="beta-breadcrumb font-large">
        <a href="{{route("home-page")}}">Trang chủ</a> / <span>Giới thiệu</span>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<div class="container">
  <div id="content">
    <div class="our-history">
      <h1 class="text-center wow fadeInDown"><strong style="color: #000099;">TOM'S SHOES</strong></h1>
      <h6 class="text-center wow fadeInDown"><i style="color: #000099;">Chooser Your Best</i> </h6>
      <div class="space35">&nbsp;</div>

      <div class="history-slider">
        <div class="history-navigation">
          <a data-slide-index="0" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center"><p class="text-center">Thành Lập</p></span></a>
          <a data-slide-index="1" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center"><p class="text-center">Thương Hiệu</p></span></a>
          <a data-slide-index="2" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center"><p class="text-center">Sứ Mệnh</p></span></a>
          <a data-slide-index="3" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center"><p class="text-center">Phát Triển</p></span></a>
          <a data-slide-index="4" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center"><p class="text-center">Cơ Hội</p></span></a>
          <a data-slide-index="5" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center"><p class="text-center">Thị Trường</p></span></a>
          <a data-slide-index="6" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center"><p class="text-center">Đối Tác</p></span></a>
        </div>

        <div class="history-slides">
          <div> 
            <div class="row">
            <div class="col-sm-5">
              <img src="source\image\intro\history.png" alt="">
            </div>
            <div class="col-sm-7">
              <h5 class="other-title"><strong style="color: #000099">Lịch Sử Hình Thành</strong></h5>
              <div style="border: 1px; border-color:red; border-style: groove;"></div>
              <div class="space10">&nbsp;</div>
              <p>
                <strong>Năm thành lập:</strong> 2019<br />
                <strong>Founder:</strong> Nguyễn Đức Quy<br />
                <strong>President:</strong> Trương Minh Luân<br />
              </p>
              <div class="space10">&nbsp;</div>
              <p>Được thành lập vào ngày 09/09/2019. Dưới sự đồng hợp tác của Founder và President. <strong style="color: #000099">TOM'S SHOES</strong> ra đời đóng góp to lớn cho sự phát triển của xã hội thương mại Việt Nam. </p>
            </div>
            </div> 
          </div>
          <div> 
            <div class="row">
            <div class="col-sm-5">
              <img src="source\image\intro\tomshoes.png" alt="">
            </div>
            <div class="col-sm-7">
              <h5 class="other-title"><strong style="color: #000099">Thương Hiệu</strong></h5>
              <div style="border: 1px; border-color:red; border-style: groove;"></div>
              <div class="space10">&nbsp;</div>
              <p>
                <strong style="color: #000099">TOM'S SHOES</strong> <i>"Chooser your best"</i><br/>
              </p>
              <div class="space10">&nbsp;</div>
              <p>Lấy cảm hứng từ các thương hiệu giày nổi tiếng trên thế giới. <strong style="color: #000099">TOM'S SHOES</strong> là sự kết hợp giữa văn hóa phương Đông và văn hóa phương Tây. Mang đến cho khách hàng những sản phẩm vừa độc đáo, vừa mới lạ đảm bảo phù hợp với thu nhập và tính thẩm mỹ của người Việt Nam.</p>
            </div>
            </div> 
          </div>
          <div> 
            <div class="row">
            <div class="col-sm-5">
              <img src="source\image\intro\sumenh.png" alt="">
            </div>
            <div class="col-sm-7">
              <h5 class="other-title"><strong style="color: #000099">Sứ Mệnh</strong></h5>
              <div style="border: 1px; border-color:red; border-style: groove;"></div>
              <div class="space10">&nbsp;</div>
              <p>
                <strong style="color: #000099">TOM'S SHOES</strong> <i>"Mang đến sự lựa chọn tốt nhất cho bạn"</i><br />
              </p>
              <div class="space10">&nbsp;</div>
              <p>Là một trong những thương hiệu giày vừa mới thành lập. <strong style="color: #000099">TOM'S SHOES</strong> chính là người bạn, người đồng hành cùng khách hàng trên mỗi chặng đường, mỗi chuyến đi. Sứ mệnh của <strong style="color: #000099">TOM'S SHOES</strong> là luôn luôn bảo vệ, nâng niu những đôi chân vàng của các thế hệ Việt Nam.</p>
            </div>
            </div> 
          </div>
          <div> 
            <div class="row">
            <div class="col-sm-5">
              <img src="source\image\intro\phattrien.png" alt="">
            </div>
            <div class="col-sm-7">
              <h5 class="other-title"><strong style="color: #000099">Phát Triển</strong></h5>
              <div style="border: 1px; border-color:red; border-style: groove;"></div>
              <div class="space10">&nbsp;</div>
              <p>
                <strong style="color: #000099">TOM'S SHOES</strong> <i>"Chặng đường phát triển cùng thương mại Việt Nam"</i><br />
              </p>
              <div class="space10">&nbsp;</div>
              <p>Để khẳng định thương hiệu của chính mình. <strong style="color: #000099">TOM'S SHOES</strong> luôn phấn đấu nỗ lực phát triển song song cùng nền kinh tế thương mại Việt Nam. Phát triển <strong style="color: #000099">TOM'S SHOES</strong> không chỉ là thương hiệu của Việt Nam mà là thương hiệu toàn cầu. Từng bước khẳng định vị thế trên thị trường quốc tế.</p>
            </div>
            </div> 
          </div>
          <div> 
            <div class="row">
            <div class="col-sm-5">
              <img src="source\image\intro\cohoi.png" alt="">
            </div>
            <div class="col-sm-7">
              <h5 class="other-title"><strong style="color: #000099">Cơ Hội</strong></h5>
              <div style="border: 1px; border-color:red; border-style: groove;"></div>
              <div class="space10">&nbsp;</div>
              <p>
                <strong style="color: #000099">TOM'S SHOES</strong> <i>"Thách thức tạo nên Cơ hội"</i><br />
              </p>
              <div class="space10">&nbsp;</div>
              <p>Cuộc cách mạng công nghiệp 4.0 phát triển, kéo theo sự phát triển của thương mại điện tử, đó vừa là thách thức vừa là cơ hội cho <strong style="color: #000099">TOM'S SHOES</strong>. Để phát triển nhanh hơn, xa hơn và lâu hơn với <strong style="color: #000099">TOM'S SHOES</strong> mọi thử thách chính là cơ hội tuyệt vời nhất để khẳng định giá trị thương hiệu.</p>
            </div>
            </div> 
          </div>
          <div> 
            <div class="row">
            <div class="col-sm-5">
              <img src="source\image\intro\thitruong.png" alt="">
            </div>
            <div class="col-sm-7">
              <h5 class="other-title"><strong style="color: #000099">Thị Trường</strong></h5>
              <div style="border: 1px; border-color:red; border-style: groove;"></div>
              <div class="space10">&nbsp;</div>
              <p>
                <strong style="color: #000099">TOM'S SHOES</strong> <i>"Hòa nhập cùng nền kinh tế thị trường"</i><br />
              </p>
              <div class="space10">&nbsp;</div>
              <p>Là một thương hiệu giày mới. Tuy nhiên, <strong style="color: #000099">TOM'S SHOES</strong> đã dần dần chiếm được ưu thế trên thị trường Việt Nam. Với hơn 100 chi nhánh từ Bắc vào Nam, hơn 200 đại lí trải dài suốt miền đất hình chữ S. Ngoài ra, <strong style="color: #000099">TOM'S SHOES</strong> đang định hướng phát triển thương hiệu sang các nước Đông Nam Á, Đông Á, Tây Á và cuối cùng là phân phối trên toàn thế giới. </p>
            </div>
            </div> 
          </div>
          <div> 
            <div class="row">
            <div class="col-sm-5">
              <img src="source\image\intro\doitac.png" alt="">
            </div>
            <div class="col-sm-7">
              <h5 class="other-title" ><strong style="color: #000099">Đối Tác</strong></h5>
              <div style="border: 1px; border-color:red; border-style: groove;"></div>
              <div class="space10">&nbsp;</div>
              <p>
                <strong style="color: #000099">TOM'S SHOES</strong> <i>"Hợp tác cùng phát triển"</i><br />
              </p>
              <div class="space10">&nbsp;</div>
              <p><strong style="color: #000099">TOM'S SHOES</strong> đã liên kết với các trung tâm thương mại, các chuỗi cửa hàng, các chi nhánh ủy quyền hợp tác trên cương vị bình đẳng, cùng nhau phát triển. Với sự tin tưởng từ các đối tác đã tạo tiền đề để <strong style="color: #000099">TOM'S SHOES</strong> càng ngày phát triển, hoàn thiện và khẳng định mình trên chiến trường thương mại Việt Nam.</p>
            </div>
            </div> 
          </div>
        </div>
      </div>
    </div>

    <div class="space50">&nbsp;</div>
    <div style="border: 1px; border-color:blue; border-style: groove;"></div>
    <div class="space50">&nbsp;</div>
    <h2 class="text-center wow fadeInDown">Our Passion for What We Do Transfers Into Our Services</h2>
    <div class="space20">&nbsp;</div>
    <p class="text-center wow fadeInLeft">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br /> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
    <div class="space35">&nbsp;</div>

    <div class="row">
      <div class="col-sm-2 col-sm-push-2">
        <div class="beta-counter">
          <p class="beta-counter-icon"><i class="fa fa-user"></i></p>
          <p class="beta-counter-value timer numbers" data-to="19855" data-speed="2000">19855</p>
          <p class="beta-counter-title">Clients Satisfied</p>
        </div>
      </div>

      <div class="col-sm-2 col-sm-push-2">
        <div class="beta-counter">
          <p class="beta-counter-icon"><i class="fa fa-picture-o"></i></p>
          <p class="beta-counter-value timer numbers" data-to="3568" data-speed="2000">3568</p>
          <p class="beta-counter-title">Amazing Works</p>
        </div>
      </div>

      <div class="col-sm-2 col-sm-push-2">
        <div class="beta-counter">
          <p class="beta-counter-icon"><i class="fa fa-clock-o"></i></p>
          <p class="beta-counter-value timer numbers" data-to="258934" data-speed="2000">258934</p>
          <p class="beta-counter-title">Support Hours</p>
        </div>
      </div>

      <div class="col-sm-2 col-sm-push-2">
        <div class="beta-counter">
          <p class="beta-counter-icon"><i class="fa fa-pencil"></i></p>
          <p class="beta-counter-value timer numbers" data-to="150" data-speed="2000">150</p>
          <p class="beta-counter-title">New Projects</p>
        </div>
      </div>
    </div> <!-- .beta-counter block end -->

    <div class="space50">&nbsp;</div>
    <div style="border: 1px; border-color:blue; border-style: groove;"></div>
    <div class="space50">&nbsp;</div>

    <h2 class="text-center wow fadeInDownwow fadeInDown">Đội Ngũ Tuyệt Vời Của Chúng Tôi</h2>
    <div class="space20">&nbsp;</div>
    <h5 class="text-center other-title wow fadeInLeft">Người Sáng Lập</h5>
    <p class="text-center wow fadeInRight">Chúng tôi là những người đồng sáng lập nên <strong style="color: #000099">TOM'S SHOES</strong> <br />Với chúng tôi không gì là không thể</p>
    <div class="space20">&nbsp;</div>
    <div class="row">
      <div class="col-sm-6 wow fadeInLeft">
        <div class="bets-img-hover">
          <img class="pull-left" src="source/image/employee/quy.png" alt="">
          <div class="media-body beta-person-body">
            </br>
            <h5>Mr.Duc Quy</h5>
            <p class="font-large">Founder</p>
            <p>Nemo enim ipsam voluptatem quia voluptas sit asatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque por quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam.</p>
            <a href="single_type_gallery.html">View profile <i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-sm-6 wow fadeInRight">
        <div class="bets-img-hover">
          <img class="pull-left" src="source/image/employee/luan.png" alt="">
          <div class="media-body beta-person-body">
          </br>
            <h5>Mr.Minh Luan</h5>
            <p class="font-large">President</p>
            <p>Nemo enim ipsam voluptatem quia voluptas sit asatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque por quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam.</p>
            <a href="single_type_gallery.html">View profile <i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
    
    <div class="space60">&nbsp;</div>
    <h5 class="text-center other-title wow fadeInDown">Người Đồng Hành</h5>
    <p class="text-center wow fadeInUp">Chúng tôi là những nhân viên ưu tú của <strong style="color: #000099">TOM'S SHOES</strong><br />Với chúng tôi <strong style="color: #000099">TOM'S SHOES</strong> là nhà</p>
    <div class="space20">&nbsp;</div>
    <div class="row">
      <div class="col-sm-3">
        <div class="beta-person beta-person-full">
      <div class="bets-img-hover">
          <img src="source/image/employee/anh.png" alt="">
      </div>
          <div class="beta-person-body">
            <h5>Mr.Duc Anh</h5>
            <p class="font-large">Sale Manager</p>
            <p>Nemo enims voluptatem quia volupas sit aspe aut odit aut fugit, sed quia consequuntur magni dolores.</p>
            <a href="single_type_gallery.html">View profile <i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="beta-person beta-person-full">
        <div class="bets-img-hover">
          <img src="source/image/employee/nhi.png" alt="">
        </div>
          <div class="beta-person-body">
            <h5>Mrs.Yen Nhi</h5>
            <p class="font-large">Marketing Manager</p>
            <p>Nemo enims voluptatem quia volupas sit aspe aut odit aut fugit, sed quia consequuntur magni dolores.</p>
            <a href="single_type_gallery.html">View profile <i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="beta-person beta-person-full">
        <div class="bets-img-hover">
          <img src="source/image/employee/hung.png" alt="">
        </div>
          <div class="beta-person-body">
            <h5>Mr.Duy Hung</h5>
            <p class="font-large">Market Manager</p>
            <p>Nemo enims voluptatem quia volupas sit aspe aut odit aut fugit, sed quia consequuntur magni dolores.</p>
            <a href="single_type_gallery.html">View profile <i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="beta-person beta-person-full">
        <div class="bets-img-hover">	
          <img src="source/image/employee/tranh.png" alt="">
        </div>
          <div class="beta-person-body">
            <h5>Mrs.Bang Tranh</h5>
            <p class="font-large">Customers Manager</p>
            <p>Nemo enims voluptatem quia volupas sit aspe aut odit aut fugit, sed quia consequuntur magni dolores.</p>
            <a href="single_type_gallery.html">View profile <i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- #content -->
</div> <!-- .container -->
@endsection