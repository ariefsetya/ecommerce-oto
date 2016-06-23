@extends('app')

@section('body')
<div class="main-banner banner text-center" style="background: url({{url(\App\Appconfig::where('key','img_banner')->first()['value'])}}) no-repeat;background-size: cover;background-position: center;">
    <div class="container">    
      <h1>{{\App\Appconfig::where('key','heading')->first()['value']}}</h1>
      <p>{{\App\Appconfig::where('key','subheading')->first()['value']}}</p>
      <a href="{{\App\Appconfig::where('key','btn_heading_url')->first()['value']}}">{{\App\Appconfig::where('key','btn_heading')->first()['value']}}</a>
    </div>
  </div>
<div class="total-ads main-grid-border">
		<div class="container">
			<ol class="breadcrumb" style="margin-bottom: 5px;margin-top: 20px;">
			  <li><a href="{{url()}}">Home</a></li>
			  <li><a href="{{route($brer)}}">{{$bret}}</a></li>
			  <li class="active">{{$name}}</li>
			</ol>
			<div class="ads-grid">
			@include('utils.sidebar-seller')
				<div class="ads-display col-md-9">
				<h3>Published Ads</h3>
					<div class="wrapper">					
							<div id="container">
								<div class="clearfix"></div>
									<ul class="list">
										<a href="single.html">
											<li>
											<img src="{{url('assets/images/bk11.jpg')}}" title="" alt="" />
											<section class="list-left">
											<h5 class="title">Engine</h5>
											<span class="adprice">$290</span>
											<p class="catpath">Cars » Other Vehicles</p>
											</section>
											<section class="list-right">
											<span class="date">Today, 17:55</span>
											<span class="cityname">City name</span>
											</section>
											<div class="clearfix"></div>
											</li> 
										</a>
										<a href="single.html">
											<li>
											<img src="{{url('assets/images/c1.jpg')}}" title="" alt="" />
											<section class="list-left">
											<h5 class="title">Engine</h5>
											<span class="adprice">$290</span>
											<p class="catpath">Cars » Other Vehicles</p>
											</section>
											<section class="list-right">
											<span class="date">Today, 17:55</span>
											<span class="cityname">City name</span>
											</section>
											<div class="clearfix"></div>
											</li> 
										</a>
									</ul>
						
						
						<ul class="pagination pagination-sm">
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">7</a></li>
							<li><a href="#">8</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					  </div>
				</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>	
	</div>
@endsection

@section('footer')
	<script type='text/javascript'>//<![CDATA[ 
	$(window).load(function(){
	 $( "#slider-range" ).slider({
				range: true,
				min: 100000,
				max: 10000000,
				values: [ 200000, 8000000 ],
				slide: function( event, ui ) {  $( "#amount" ).val(rupiah(ui.values[ 0 ]) + " - " + rupiah(ui.values[ 1 ]) );
				}
	 });
	$( "#amount" ).val( rupiah($( "#slider-range" ).slider( "values", 0 )) + " - " + rupiah($( "#slider-range" ).slider( "values", 1 )) );

	});//]]>    
function rupiah(value)
  {
  value += '';
  x = value.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
  x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return 'Rp ' + x1 + x2;
  }


	</script>
@endsection