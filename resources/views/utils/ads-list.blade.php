@foreach($data as $key)
<ul class="list">
	<a href="{{$show==1?route('ad_detail',$key->slug):'#'}}">
		<li>
		<div class="photo">
		@if(sizeof(\App\Image::where('code','product-'.$key->id)->get())==0)
		<img src="{{url('img-uploader/src/img/icon_add_image2.png')}}" title="" alt="" />
		@else
		<img src="{{url('uploads/'.\App\Image::where('code','product-'.$key->id)->first()['image'])}}" title="" alt="" />
		@endif									
		</div>
		<div class="dalam">
		<section class="list-left">
		<section style="float: right;">
		@if(Auth::check() and $show==1)
			@if($key->id_user==Auth::user()->id)
				<span class="cityname"><span onclick="redir('edit',{{$key->id}})" class="btn btn-success">Edit</span> <span onclick="redir('delete',{{$key->id}})" class="btn btn-success">Delete</span></span>
			@endif
		@endif
		</section>
		<h5 class="title">{{$key->name}}</h5>
		<span class="cityname">{{\App\Kios::find($key->id_kios)['name']}} : {{\App\Province::find(\App\Kios::find($key->id_kios)['id_province'])['nama']}}, {{\App\City::find(\App\Kios::find($key->id_kios)['id_city'])['nama']}}</span>
		<span class="catpath">{{\App\Pilar::find($key->id_pilar)['name']}} » {{\App\Kategori::find(\App\ProductCategory::where('id_product',$key->id)->where('id_kategori',\App\JKategori::where('code','make')->first()['id'])->first()['value'])['name']}}</span>
		</section>
		<section class="list-right">
		<span class="adprice"> @if($key->promo==2) <span style="text-decoration: line-through;font-size: 9pt;"> Rp. {{number_format($key->price)}}</span> <span style="font-size: 9pt;color:red;">{{($key->promotion_type=="nominal"?"Rp. ":"").number_format($key->discount).($key->promotion_type=="percent"?"%":"")}} OFF</span> @else {{"Rp. ".number_format($key->price,0)}} @endif
		@if($key->promo==2)
		<br>Rp. {{number_format($key->new_price)}}
		@endif
		</span>
		<span class="catpath">Posted at {{date_format(date_create($key->created_at),"D, d M Y H:i:s")}}</span>
		</section>
		</div>
		</li> 
	</a>
</ul>
@endforeach
<div class="pull-right">{!!$data->render()!!}</div>