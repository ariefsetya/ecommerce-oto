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
				min: 10000,
				max: 100000000,
				values: [ 30000, 80000000 ],
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

var ixx = 0;
  function parseURI() {
  	setTimeout(function(){
  		if(ixx==0){
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
		  			window.history.pushState({}, '', response.url);
		  		}
		  	});
		}
		ixx++;
  	},2000);

  	setTimeout(function() {
  		ixx=0;
  	},2005);
  }


  $("#pilar,#city,#make").on('change',function() {
  	parseURI();
  });
  $("#query").on('input',function() {
  	parseURI();
  });

	</script>
@endsection
