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
					<?php
					$sup = 'th';
					if(substr(date_format(date_create($deta->created_at),"d"),strlen(date_format(date_create($deta->created_at),"d"))-1,1)==2){
						$sup = 'nd';
					}else if(substr(date_format(date_create($deta->created_at),"d"),strlen(date_format(date_create($deta->created_at),"d"))-1,1)==1){
						$sup = 'st';
					}
					?>
					<p> <i class="glyphicon glyphicon-map-marker"></i><a href="#">{{\App\Province::find($kios->id_province)['nama']}}</a>, <a href="#">{{\App\City::find($kios->id_city)['nama']}}</a> | Added on {!!date_format(date_create($deta->created_at),"D, F d")."<sup>".$sup."</sup>".date_format(date_create($deta->created_at)," Y")." at ".date_format(date_create($deta->created_at),"H:i:s")!!}, Ad ID : #{{explode('-',$deta->slug)[sizeof(explode('-',$deta->slug))-1]}}</p>
					<div class="flexslider">
						<ul class="slides">
							@foreach(\App\Image::where('code','product-'.$deta->id)->get() as $key)
							<li data-thumb="{{url('uploads/'.$key->image)}}">
								<img src="{{url('uploads/'.$key->image)}}" />
							</li>
							@endforeach
							@if(sizeof(\App\Image::where('code','product-'.$deta->id)->get())==0)
							<li data-thumb="{{url('img-uploader/src/img/icon_add_image2.png')}}">
								<img src="{{url('img-uploader/src/img/icon_add_image2.png')}}" />
							</li>
							@endif
						</ul>
					</div>
					<div class="product-details">
						<p>{{$deta->description}}</p>
					</div>
				</div>
				<div class="col-md-4 product-details-grid">
					<div class="item-price">
						<div class="product-price">
							<p class="p-price">Price</p>
							<h4 class="rate">Rp. {{number_format($deta->price,2)}}</h4>
							<div class="clearfix"></div>
						</div>
						<div class="condition">
							<p class="p-price">Condition</p>
							<h4 class="rate">{{\App\Kategori::find(\App\ProductCategory::where('id_product',$deta->id)->where('id_kategori',\App\JKategori::where('code','condition')->first()['id'])->first()['value'])['name']}}</h4>
							<div class="clearfix"></div>
						</div>
						<div class="itemtype">
							<p class="p-price">Item Type</p>
							<h4 class="rate">{{\App\Pilar::find($deta->id_pilar)['name']}}</h4>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="interested">
						<h4>Interested in this Ad?<small> Contact the Seller!</small></h4>
						<br>
						<span><img src="http://www.freeiconspng.com/uploads/dentist-rochester-ny--contemporary-dentistry-rochester-ny-24.png" style="width: 30px;"> {{$kios->phone}} @if($kios->accept_wa=="on") - WhatsApp Accepted @endif</span>
						<br>
						<span><img src="http://www.freeiconspng.com/uploads/logo-bbm-blackberry-messenger--logodesain-29.png" style="width:30px;"> {{$kios->bbm}}</span>
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