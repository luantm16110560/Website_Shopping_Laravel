@extends('master')
@section('content')
<div class="inner-header">
  <div class="container">
    <div class="pull-left">
      <h6 class="inner-title">Liên Hệ</h6>
    </div>
    <div class="pull-right">
      <div class="beta-breadcrumb font-large">
        <a href="{{route("home-page")}}">Trang chủ</a> / <span>Liên hệ</span>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<div class="beta-map">
  
  <div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9685.766328987373!2d106.76551660727917!3d10.84763396358898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175270ad28d48ab%3A0xa6c02de0a7c40d6c!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBTxrAgUGjhuqFtIEvhu7kgVGh14bqtdCBUUC4gSOG7kyBDaMOtIE1pbmg!5e0!3m2!1svi!2s!4v1573204766477!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>
</div>
<div class="container">
  <div id="content" class="space-top-none">
    
    <div class="space50">&nbsp;</div>
    <div class="row">
      <div class="col-sm-8">
        <h2>Liên hệ với chúng tôi</h2>
        <div class="space20">&nbsp;</div>
        <p><strong style="color: #000099">TOM'S SHOES</strong> rất mong muốn nhận được những ý kiến, đóng góp về chất lượng phục vụ, chất lượng sản phẩm nhằm mang đến các trải nghiệm tốt nhất và tuyệt vời nhất cho khách hàng.</p>
        <div class="space20">&nbsp;</div>
        <p><i>**Hãy điền đầy đủ các thông tin bên dưới**</i></p>
        <form action="#" method="post" class="contact-form">	
          <div class="form-block">
            <input name="your-name" type="text" placeholder="Hãy cho chúng tôi tên của ban..........">
          </div>
          <div class="form-block">
            <input name="your-email" type="email" placeholder="Hãy cho chúng tôi Email của bạn.........">
          </div>
          <div class="form-block">
            <input name="your-subject" type="text" placeholder="Hãy cho chúng tôi vấn đề của bạn........">
          </div>
          <div class="form-block">
            <textarea name="your-message" placeholder="Hãy để những ý kiến cho chúng tôi......."></textarea>
          </div>
          <div class="form-block">
            <button type="submit" class="beta-btn primary" style="background: #000099; color: white">Gửi đến chúng tôi<i class="fa fa-chevron-right"></i></button>
          </div>
        </form>
      </div>
      <div class="col-sm-4">
        <h2>Thông tin liên hệ</h2>
        <div class="space20">&nbsp;</div>

        <h6 class="contact-title">Địa chỉ cửa hàng: </h6>
        <p>
          Số 1, Võ Văn Ngân, Linh Chiểu,<br/>
          Thủ Đức, Hồ Chí Minh <br/>
          Việt Nam
        </p>
        <div class="space20">&nbsp;</div>
        <h6 class="contact-title">Email:</h6>
        <p>
          Thương hiệu giày <strong style="color: #000099">TOM'S SHOES</strong> <br>
          <a href="mailto:quyducnguyen2210@gmail.com">tomshoes@gmail.com</a>
        </p>
        <div class="space20">&nbsp;</div>
        <h6 class="contact-title">Tuyển dụng:</h6>
        <p>
          Hãy cùng tham gia với <strong style="color: #000099">TOM'S SHOES</strong> <br>
          <a href="mailto:quyducnguyen2210@gmail.com">hrtomshoes@gmail.com</a>
        </p>
      </div>
    </div>
  </div> <!-- #content -->
</div> <!-- .container -->
@endsection