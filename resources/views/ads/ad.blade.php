@extends('app')

@section('header')
	<link rel="stylesheet" href="{{url('assets/css/flexslider.css')}}" type="text/css" media="screen" />
@endsection

@section('body')
<div class="single-page main-grid-border">
		<div class="container">
			<ol class="breadcrumb" style="margin-bottom: 5px;margin-top: 20px;">
			  <li><a href="{{url()}}">Home</a></li>
			  <li><a href="{{route($brer,[$deta->id_kios])}}">{{$bret}}</a></li>
			  <li class="active">{{$name}}</li>
			</ol>
			<div class="product-desc">
				<div class="col-md-8 product-view">
					<h2>{{$deta->name}}</h2>
					<p> <i class="glyphicon glyphicon-map-marker"></i><a href="#">{{\App\Province::find($kios->id_province)['nama']}}</a>, <a href="#">{{\App\City::find($kios->id_city)['nama']}}</a>| Added at {{date_format(date_create($deta->created_at),"D, d M Y H:i:s")}}, Ad ID: {{$deta->id}}</p>
					<div class="flexslider">
						<ul class="slides">
							@foreach(\App\Image::where('code','product-'.$deta->id)->get() as $key)
							<li data-thumb="{{url('uploads/'.$key->image)}}">
								<img src="{{url('uploads/'.$key->image)}}" />
							</li>
							@endforeach
						</ul>
					</div>
					<div class="product-details">
						<h4>Brand : <a href="#">Company name</a></h4>
						<h4>Views : <strong>150</strong></h4>
						<p><strong>Display </strong>: 1.5 inch HD LCD Touch Screen</p>
						<p><strong>Summary</strong> : It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
					
					</div>
				</div>
				<div class="col-md-4 product-details-grid">
					<div class="item-price">
						<div class="product-price">
							<p class="p-price">Price</p>
							<h3 class="rate">$ 259</h3>
							<div class="clearfix"></div>
						</div>
						<div class="condition">
							<p class="p-price">Condition</p>
							<h4>Good</h4>
							<div class="clearfix"></div>
						</div>
						<div class="itemtype">
							<p class="p-price">Item Type</p>
							<h4>Phones</h4>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="interested text-center">
						<h4>Interested in this Ad?<small> Contact the Seller!</small></h4>
						<p><i class="glyphicon glyphicon-earphone"></i>00-85-9875462655</p>
					</div>
						<div class="tips">
						<h4>Safety Tips for Buyers</h4>
							<ol>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
							</ol>
						</div>
				</div>
			<div class="clearfix"></div>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<script defer src="{{url('assets/js/jquery.flexslider.js')}}"></script>
	<script>
	$(window).load(function() {
	  $('.flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails"
	  });
	});
	</script>
@endsection