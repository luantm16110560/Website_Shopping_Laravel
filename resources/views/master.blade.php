<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Cửa hàng giày TOM'S SHOES</title>
        <base href="{{asset('')}}">
        <link rel="icon" href="{!! asset('source/image/icon/icon-web-title.png') !!}"/>
        <link href='https://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
        <link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
        <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
        <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
        <link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
        <link rel="stylesheet" href="source/assets/dest/css/animate.css">
        <link rel="stylesheet" title="style" href="source/assets/dest/css/huong-style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <style></style>
    </head>
    
    <body>
    <!-- Load Facebook SDK for JavaScript -->
    
        @include('header')
            @yield('content')
        <!-- .container -->
        @include('footer')
          {{-- {{-- <!-- Load Facebook SDK for JavaScript --> --}}
          <div id="fb-root"></div>
          <script>
            window.fbAsyncInit = function() {
              FB.init({
                xfbml            : true,
                version          : 'v7.0'
              });
            };
    
            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));</script>
    
          <!-- Your customer chat code -->
          <div class="fb-customerchat"
            attribution=setup_tool
            page_id="102361004815061"
      theme_color="#7646ff"
      >
          </div>
          <style>
        .fb_dialog {
                    position: -webkit-sticky !important;
                    position: fixed !important;
                    bottom: 95px !important;
                    right: 20px !important;
                    }
                  </style> 
       
        <!-- include js files -->
        <script src="source/assets/dest/js/jquery.js"></script>
        <script src="source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
        <script src="source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
        <script src="source/assets/dest/vendors/animo/Animo.js"></script>
        <script src="source/assets/dest/vendors/dug/dug.js"></script>
        <script src="source/assets/dest/js/scripts.min.js"></script>
        <script src="source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script src="source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="source/assets/dest/js/waypoints.min.js"></script>
        <script src="source/assets/dest/js/wow.min.js"></script>
        <!--customjs-->
        {{-- <script src="source/assets/dest/js/custom2.js"></script> --}}
        <script>
            $(document).ready(function($) {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 150) {
                        $(".header-bottom").addClass('fixNav')
                    } else {
                        $(".header-bottom").removeClass('fixNav')
                    }
                })
            })
        </script>
    
    </body>
    @include('chat')
    
</html>
