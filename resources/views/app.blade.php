<!DOCTYPE html>
<html>
<head>
<title>{!!strip_tags(\App\Appconfig::where('key','title')->first()['value'])!!}</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resale Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<!-- //for-mobile-apps -->
<!--fonts-->

<!-- Source -->

@yield('header')
</head>
<body>
  <div class="header">
    <div class="container">
      <div class="logo">
        <a href="{{url()}}">{!!\App\Appconfig::where('key','title')->first()['value']!!}</a>
      </div>
      <div class="header-right">
      @if(!Auth::check())
        <a href="{{url('auth/login')}}" class="btn account">{{\App\Appconfig::where('key','btn_signin')->first()['value']}}</a>
        <a href="{{url('auth/register')}}" class="btn account">{{\App\Appconfig::where('key','btn_signup')->first()['value']}}</a>
      @else
        <a href="{{route('account')}}" class="account btn">Welcome back, {{Auth::user()->name}}. Goto My Account</a>
        <a href="{{url('vauth/logout')}}" class="account btn">Sign Out</a>
      @endif
      </div>
    </div>
  </div>
    @yield('body')
    <footer>
      <!-- js -->
      <link async rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
      <script async type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

      <link async href='//fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
      <link async href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
      <link async rel="stylesheet" href="{{url('assets/css/additional.css')}}">
      <!--//fonts-->  
      <link async rel="stylesheet" href="{{url('assets/css/jquery-ui1.css')}}">
      <link async rel="stylesheet" href="{{url('assets/css/bootstrap-select.css')}}">
      <link async href="{{url('assets/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
      <link async rel="stylesheet" href="{{url('assets/css/flexslider.css')}}" type="text/css" media="screen" />
      <link async rel="stylesheet" href="{{url('assets/css/font-awesome.min.css')}}" />
              
      <link async href="{{url('assets/css/jquery.uls.css')}}" rel="stylesheet"/>
      <link async href="{{url('assets/css/jquery.uls.grid.css')}}" rel="stylesheet"/>
      <link async href="{{url('assets/css/jquery.uls.lcd.css')}}" rel="stylesheet"/>
      <script async type="text/javascript" src="{{url('assets/js/jquery.min.js')}}"></script>
      <!-- js -->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script async src="{{url('assets/js/bootstrap.min.js')}}"></script>
      <script async src="{{url('assets/js/bootstrap-select.js')}}"></script>
      <script async type="text/javascript" src="{{url('assets/js/jquery-ui.js')}}"></script>              
      <script async type="text/javascript" src="{{url('assets/js/jquery.price.format.js')}}"></script>              
      <script async type="text/javascript" src="{{url('assets/js/jquery.leanModal.min.js')}}"></script>
      <script async src="{{url('assets/js/jquery.uls.data.js')}}"></script>
      <script async src="{{url('assets/js/jquery.uls.data.utils.js')}}"></script>
      <script async src="{{url('assets/js/jquery.uls.lcd.js')}}"></script>
      <script async src="{{url('assets/js/jquery.uls.languagefilter.js')}}"></script>
      <script async src="{{url('assets/js/jquery.uls.regionfilter.js')}}"></script>
      <script async src="{{url('assets/js/jquery.uls.core.js')}}"></script>
      <script async type="text/javascript">
        
        jQuery.each(jQuery('textarea[data-autoresize]'), function() {
            var offset = this.offsetHeight - this.clientHeight;
         
            var resizeTextarea = function(el) {
                jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
            };
            jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
        });
        function redir(act,id) {
          if(act=='edit'){
            window.location.assign('{{route("ads_edit")}}/'+id);
          }
          if(act=='delete'){
            window.location.assign('{{route("ads_delete")}}/'+id);
          }
          event.preventDefault();
        }
      </script>

      @yield('footer')
      <div class="footer-bottom text-center">
        <div class="container">
          <div class="footer-logo">
            <a href="{{url()}}">{!!\App\Appconfig::where('key','title')->first()['value']!!}</a>
          </div>
          <div class="footer-social-icons">
            <ul>
              <li><a class="facebook" href="#"><span>Facebook</span></a></li>
              <li><a class="twitter" href="#"><span>Twitter</span></a></li>
              <li><a class="flickr" href="#"><span>Flickr</span></a></li>
              <li><a class="googleplus" href="#"><span>Google+</span></a></li>
              <li><a class="dribbble" href="#"><span>Dribbble</span></a></li>
            </ul>
          </div>
          <div class="copyrights">
            <p> &copy; {{date("Y")}} BursaOto. All Rights Reserved | Design by  <a href="http://w3layouts.com/"> W3layouts</a></p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </footer>
</body>
</html>