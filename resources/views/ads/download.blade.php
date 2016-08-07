@extends('app_download')

@section('body')
<div class="">
		<div class="">
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
							<li data-thumb="{{url('uploads/'.$key->image)}}" style="list-style-type: none;">
								<img src="{{url('uploads/'.$key->image)}}" />
							</li>
							@endforeach
							@if(sizeof(\App\Image::where('code','product-'.$deta->id)->get())==0)
							No Image
							@endif
						</ul>
					</div>
					<div class="product-details" style="color: #222;">
						<p style="white-space: pre-wrap;">{{$deta->description}}</p>
					</div>
				</div>
				<div class="col-md-4 product-details-grid">
				<table style="width: 100%;">
					<tr>
						<td>Price</td>
						<td>Rp. {{number_format($deta->price,2)}}</td>
					</tr>
					<tr>
						<td>Condition</td>
						<td>{{\App\Kategori::find(\App\ProductCategory::where('id_product',$deta->id)->where('id_kategori',\App\JKategori::where('code','condition')->first()['id'])->first()['value'])['name']}}</td>
					</tr>
					<tr>
						<td>Item Type</td>
						<td>{{\App\Pilar::find($deta->id_pilar)['name']}}</td>
					</tr>
				</table>
					<div class="interested">
						<h4>Interested in this Ad?<small> Contact the Seller!</small></h4>
						{{$bret}}<br>
						{{$kios->address}}<br>
						<span><img src="" style="width: 30px;"> {{$kios->phone}} @if($kios->accept_wa=="on") - WhatsApp Accepted @endif</span>
						@if($kios->bbm!="")
						<br>
						<span><img src="" style="width:30px;"> {{$kios->bbm}}</span>
						@endif
					</div>
					<div class="">
					</div>
				</div>
			<div class="clearfix"></div>
			</div>
		</div>
	</div>
@endsection