@extends('app')

@section('body')

  <div class="main-banner banner text-center" style="background: url(http://www.boostbusinesslancashire.co.uk/media/7225/advanced_manufacturing.jpg) no-repeat;background-size: cover;background-position: center;">
    <div class="container">    
      <h1>{{\App\Appconfig::where('key','heading')->first()['value']}}</h1>
      <p>{{\App\Appconfig::where('key','subheading')->first()['value']}}</p>
      <a href="{{\App\Appconfig::where('key','btn_heading_url')->first()['value']}}">{{\App\Appconfig::where('key','btn_heading')->first()['value']}}</a>
    </div>
  </div>
    <!-- content-starts-here -->
    <div class="content">
      <div class="categories">
        <div class="container">
        @foreach(\App\Pilar::all() as $key)
          <div class="col-md-3 focus-grid">
            <a href="{{route($key->code)}}">
              <div class="focus-border">
                <div class="focus-layout">
                  <div class="focus-image"><i class="fa {{\App\Image::find($key->image)['image']}}"></i></div>
                  <h4 class="clrchg">{{$key->name}}</h4>
                </div>
              </div>
            </a>
          </div>
          @endforeach
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="trending-ads">
        <div class="container">
        <!-- slider -->
        <div class="trend-ads">
          <h2>{{\App\Appconfig::where('key','body_heading')->first()['value']}}</h2>
              <ul id="flexiselDemo3">
              {{"@foreach(\App\Popular::orderBy('id','desc')->get() as %key)"}}
                <li>
                  <div class="col-md-3 biseller-column">
                    <a href="single.html">
                      <img src="{{url('assets/images/p1.jpg')}}"/>
                      <span class="price">Rp. 100.000.000,00</span>
                    </a> 
                    <div class="ad-info">
                      <h5>There are many variations of passages</h5>
                      <span>1 hour ago</span>
                    </div>
                  </div>
                  <div class="col-md-3 biseller-column">
                    <a href="single.html">
                      <img src="{{url('assets/images/p2.jpg')}}"/>
                      <span class="price">&#36; 399</span>
                    </a> 
                    <div class="ad-info">
                      <h5>Lorem Ipsum is simply dummy</h5>
                      <span>3 hour ago</span>
                    </div>
                  </div>
                  <div class="col-md-3 biseller-column">
                    <a href="single.html">
                      <img src="{{url('assets/images/p3.jpg')}}"/>
                      <span class="price">&#36; 199</span>
                    </a> 
                    <div class="ad-info">
                      <h5>It is a long established fact that a reader</h5>
                      <span>8 hour ago</span>
                    </div>
                  </div>
                  <div class="col-md-3 biseller-column">
                    <a href="single.html">
                      <img src="{{url('assets/images/p4.jpg')}}"/>
                      <span class="price">&#36; 159</span>
                    </a> 
                    <div class="ad-info">
                      <h5>passage of Lorem Ipsum you need to be</h5>
                      <span>19 hour ago</span>
                    </div>
                  </div>
                </li>
                {{"divide 4"}}
                <li>
                  <div class="col-md-3 biseller-column">
                    <a href="single.html">
                      <img src="{{url('assets/images/p1.jpg')}}"/>
                      <span class="price">Rp. 100.000,00</span>
                    </a> 
                    <div class="ad-info">
                      <h5>There are many variations of passages</h5>
                      <span>1 hour ago</span>
                    </div>
                  </div>
                  <div class="col-md-3 biseller-column">
                    <a href="single.html">
                      <img src="{{url('assets/images/p2.jpg')}}"/>
                      <span class="price">&#36; 399</span>
                    </a> 
                    <div class="ad-info">
                      <h5>Lorem Ipsum is simply dummy</h5>
                      <span>3 hour ago</span>
                    </div>
                  </div>
                  <div class="col-md-3 biseller-column">
                    <a href="single.html">
                      <img src="{{url('assets/images/p3.jpg')}}"/>
                      <span class="price">&#36; 199</span>
                    </a> 
                    <div class="ad-info">
                      <h5>It is a long established fact that a reader</h5>
                      <span>8 hour ago</span>
                    </div>
                  </div>
                  <div class="col-md-3 biseller-column">
                    <a href="single.html">
                      <img src="{{url('assets/images/p4.jpg')}}"/>
                      <span class="price">&#36; 159</span>
                    </a> 
                    <div class="ad-info">
                      <h5>passage of Lorem Ipsum you need to be</h5>
                      <span>19 hour ago</span>
                    </div>
                  </div>
                </li>
                {{"@endforeach"}}
            </ul>
          <script type="text/javascript">
             $(window).load(function() {
              $("#flexiselDemo3").flexisel({
                visibleItems:1,
                animationSpeed: 800,
                autoPlay: true,
                autoPlaySpeed: 5000,        
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: { 
                  portrait: { 
                    changePoint:480,
                    visibleItems:1
                  }, 
                  landscape: { 
                    changePoint:640,
                    visibleItems:1
                  },
                  tablet: { 
                    changePoint:768,
                    visibleItems:1
                  }
                }
              });
              
            });
             </script>
             <script type="text/javascript" src="{{url('assets/js/jquery.flexisel.js')}}"></script>
          </div>   
      </div>
      <!-- //slider -->       
      </div>
      <div class="mobile-app">
        <div class="container">
          <div class="col-md-5 app-left">
            <a href="{{\App\Appconfig::where('key','img_foot_url')->first()['value']}}"><img src="{{url('assets/images/app.png')}}" alt=""></a>
          </div>
          <div class="col-md-7 app-right">
            <h3>{{\App\Appconfig::where('key','foot_heading')->first()['value']}}</h3>
            <p>{{\App\Appconfig::where('key','foot_subheading')->first()['value']}}</p>
            <div class="app-buttons">
	              <div class="app-button">
                <a href="#"><img src="{{url('assets/images/1.png')}}" alt=""></a>
              </div>
              <div class="app-button">
                <a href="#"><img src="{{url('assets/images/2.png')}}" alt=""></a>
              </div>
              <div class="clearfix"> </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
@endsection


@section('footer')
      <div class="footer-top">
        <div class="container">
          <div class="foo-grids">
            <div class="col-md-3 footer-grid">
              <h4 class="footer-head">Who We Are</h4>
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
              <p>The point of using Lorem Ipsum is that it has a more-or-less normal letters, as opposed to using 'Content here.</p>
            </div>
            <div class="col-md-3 footer-grid">
              <h4 class="footer-head">Help</h4>
              <ul>
                <li><a href="howitworks.html">How it Works</a></li>           
                <li><a href="sitemap.html">Sitemap</a></li>
                <li><a href="faq.html">Faq</a></li>
                <li><a href="feedback.html">Feedback</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="typography.html">Shortcodes</a></li>
              </ul>
            </div>
            <div class="col-md-3 footer-grid">
              <h4 class="footer-head">Information</h4>
              <ul>
                <li><a href="regions.html">Locations Map</a></li> 
                <li><a href="terms.html">Terms of Use</a></li>
                <li><a href="popular-search.html">Popular searches</a></li> 
                <li><a href="privacy.html">Privacy Policy</a></li>  
              </ul>
            </div>
            <div class="col-md-3 footer-grid">
              <h4 class="footer-head">Contact Us</h4>
              <span class="hq">Our headquarters</span>
              <address>
                <ul class="location">
                  <li><span class="glyphicon glyphicon-map-marker"></span></li>
                  <li>CENTER FOR FINANCIAL ASSISTANCE TO DEPOSED NIGERIAN ROYALTY</li>
                  <div class="clearfix"></div>
                </ul> 
                <ul class="location">
                  <li><span class="glyphicon glyphicon-earphone"></span></li>
                  <li>+0 561 111 235</li>
                  <div class="clearfix"></div>
                </ul> 
                <ul class="location">
                  <li><span class="glyphicon glyphicon-envelope"></span></li>
                  <li><a href="mailto:info@example.com">mail@example.com</a></li>
                  <div class="clearfix"></div>
                </ul>           
              </address>
            </div>
            <div class="clearfix"></div>
          </div>            
        </div>  
      </div>  
@endsection