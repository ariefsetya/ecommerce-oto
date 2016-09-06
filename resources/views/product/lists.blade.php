@extends('app')

@section('body')
<div class="main-banner banner text-center" style="background: url({{url(\App\Appconfig::where('key','img_banner')->first()['value'])}}) no-repeat;background-size: cover;background-position: center;">
    <div class="container">
      <h1>{{\App\Appconfig::where('key','heading')->first()['value']}}</h1>
      <p>{{\App\Appconfig::where('key','subheading')->first()['value']}}</p>
      <a href="{{route(\App\Appconfig::where('key','btn_heading_url')->first()['value'])}}">{{\App\Appconfig::where('key','btn_heading')->first()['value']}}</a>
    </div>
  </div>
<div class="total-ads main-grid-border">
		<div class="container">
			<div class="select-box">
				<form method="POST" action="{{route('post_search')}}">
				<div class="select-city-for-local-ads ads-list">
					<label>Select your city to see local ads</label>
					@include('utils.city-select')
				</div>
				<div class="browse-category ads-list">
					<label>Browse Categories</label>
					@include('utils.pilar-select')
				</div>
				<div class="search-product ads-list">
					<label>Search for a specific product</label>
					<div class="search">
						<div id="custom-search-input">
						<div class="input-group">
							<input type="text" class="form-control input-lg" placeholder="Buscar" name="query" id="query" value="{{($query=="%")?"":$query}}" />
							<span class="input-group-btn">
								<button class="btn btn-info btn-lg" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>
						</div>
					</div>
					</div>
				</div>
				<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
				</form>
				<div class="clearfix"></div>
			</div>
			<ol class="breadcrumb" style="margin-bottom: 5px;margin-top: 20px;">
			  <li><a href="{{url()}}">Home</a></li>
			  <li><a href="{{route($brer)}}">{{$bret}}</a></li>
			  <li class="active">{{$name}}</li>
			</ol>
			<div class="ads-grid">
				@include('utils.sidebar-buyer')
				<div class="ads-display col-md-9">
					<div class="wrapper">
						<div id="container">
							<div class="clearfix"></div>
							@include('utils.ads-list')
							@if(sizeof($data)==0)
								<h1>Oops</h1><p>No ads found</p>
							@endif
					  	</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="sk-cube-grid">
  <div class="sk-cube sk-cube1"></div>
  <div class="sk-cube sk-cube2"></div>
  <div class="sk-cube sk-cube3"></div>
  <div class="sk-cube sk-cube4"></div>
  <div class="sk-cube sk-cube5"></div>
  <div class="sk-cube sk-cube6"></div>
  <div class="sk-cube sk-cube7"></div>
  <div class="sk-cube sk-cube8"></div>
  <div class="sk-cube sk-cube9"></div>
</div>
<style type="text/css">
	.sk-cube-grid {
  width: 100px;
  height: 100px;
  position: absolute;
	left:50%;
	top: 120%;
	z-index: 99999;
	opacity: 0;
	transition: all .2s;
}

.sk-cube-grid .sk-cube {
	padding: 10px;
  width: 33%;
  height: 33%;
  float: left;
  -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
          animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; 
}
.sk-cube-grid .sk-cube1 {
  background-color: #87CEFA;
  -webkit-animation-delay: 0.2s;
          animation-delay: 0.2s; }
.sk-cube-grid .sk-cube2 {
  background-color: #87CEEB;
  -webkit-animation-delay: 0.3s;
          animation-delay: 0.3s; }
.sk-cube-grid .sk-cube3 {
  background-color: #00BFFF;
  -webkit-animation-delay: 0.4s;
          animation-delay: 0.4s; }
.sk-cube-grid .sk-cube4 {
  background-color: #1E90FF;
  -webkit-animation-delay: 0.1s;
          animation-delay: 0.1s; }
.sk-cube-grid .sk-cube5 {
  background-color: #6495ED;
  -webkit-animation-delay: 0.2s;
          animation-delay: 0.2s; }
.sk-cube-grid .sk-cube6 {
  background-color: #4682B4;
  -webkit-animation-delay: 0.3s;
          animation-delay: 0.3s; }
.sk-cube-grid .sk-cube7 {
  background-color: #7B68EE;
  -webkit-animation-delay: 0s;
          animation-delay: 0s; }
.sk-cube-grid .sk-cube8 {
  background-color: #6A5ACD;
  -webkit-animation-delay: 0.1s;
          animation-delay: 0.1s; }
.sk-cube-grid .sk-cube9 {
  background-color: #4169E1;
  -webkit-animation-delay: 0.2s;
          animation-delay: 0.2s; }

@-webkit-keyframes sk-cubeGridScaleDelay {
  0%, 70%, 100% {
    -webkit-transform: scale3D(1, 1, 1);
            transform: scale3D(1, 1, 1);
  } 35% {
    -webkit-transform: scale3D(0, 0, 1);
            transform: scale3D(0, 0, 1); 
  }
}

@keyframes sk-cubeGridScaleDelay {
  0%, 70%, 100% {
    -webkit-transform: scale3D(1, 1, 1);
            transform: scale3D(1, 1, 1);
  } 35% {
    -webkit-transform: scale3D(0, 0, 1);
            transform: scale3D(0, 0, 1);
  } 
}
</style>
@endsection

@section('footer')
	<script async type='text/javascript'>//<![CDATA[
	$(window).load(function(){
	 $( "#slider-range" ).slider({
				range: true,
				min: 10000,
				max: 100000000,
				values: [ {{$price_min>0?$price_min:30000}}, {{$price_max>0?$price_max:80000000}} ],
				slide: function( event, ui ) {  
					$( "#amount" ).val(rupiah(ui.values[ 0 ]) + " - " + rupiah(ui.values[ 1 ]));
					parseURI();
				}
	 });
	$( "#amount" ).val( rupiah($( "#slider-range" ).slider( "values", 0 )) + " - " + rupiah($( "#slider-range" ).slider( "values", 1 )));

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

var ixx = 1;

  function parseURI() {
  	ixx=0;
  }

  	setInterval(function () {
  		if(ixx==0){
  			$(".sk-cube-grid").css('opacity',1);
		  	$.ajax({
		  		url:'{{route('parseURI')}}',
		  		data:{
		  				pilar:$("#pilar").val(),
		  				city:$("#city").val(),
		  				query:$("#query").val(),
		  				min_price:$( "#slider-range" ).slider( "values", 0 ),
		  				max_price:$( "#slider-range" ).slider( "values", 1 ),
		  				make:$("#make").val(),
		  				_token:'{{csrf_token()}}'
		  			},
		  		type:'POST',
		  		dataType:'json',
		  		success:function(response) {
		  			if(response.data>0){
		  			$("#container").html(response.html);
		  			}else{
		  			$("#container").html('<h1>Oops</h1><p>No ads found</p>');
		  			}
		  			window.history.pushState({}, '', response.url);
		  			setTimeout(function() {
  						$(".sk-cube-grid").css('opacity',0);
		  			},1000);
		  		}
		  	});
		}
		ixx++;
  	},1000);


  $("#pilar,#city,#make").on('change',function() {
  	parseURI();
  });
  $("#query").on('input',function() {
  	parseURI();
  });

	</script>
@endsection
