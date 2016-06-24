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
			  <li class="active">{{$name}}</li>
			</ol>
			<div class="ads-grid">
			@include('utils.sidebar-seller')
				<div class="ads-display col-md-9">
				<h3>Summary</h3>
					<div class="row">
						@if($num_store==0)
						<a href="{{route('setup_store')}}">
						<div class="grid_o col-md-10">
							<div class="grid_">
								<i class="fa fa-cog"></i> Setup Your Store First, click here
							</div>
						</div>
						</a>
						@else
						@if($num_product==0)
						<a href="{{route('ads_create')}}">
						<div class="grid_o col-md-10">
							<div class="grid_">
								<i class="fa fa-plus"></i> Post your ad
							</div>
						</div>
						</a>
						@endif
						<div class="grid_o col-md-5">
							<div class="grid_">
							<i class="fa fa-shopping-cart"></i> {{$num_store==0?"No":$num_store}} store{{$num_store>1?"s":""}}
							</div>
						</div>
						<div class="grid_o col-md-5">
							<div class="grid_">
							<i class="fa fa-tags"></i> {{$num_product==0?"No":$num_product}} ad{{$num_product>1?"s":""}}
							</div>
						</div>
						@endif
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