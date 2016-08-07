<!DOCTYPE html>
<html>
<head>
<title>{!!strip_tags(\App\Appconfig::where('key','title')->first()['value'])!!}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

@yield('header')
</head>
<body>
    @yield('body')
    <footer>
      <div class="footer-bottom text-center">
        <div class="container">
          <div class="copyrights">
            <p> &copy; 2016 Resale. All Rights Reserved | Design by  <a href="http://w3layouts.com/"> W3layouts</a></p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </footer>
</body>
</html>