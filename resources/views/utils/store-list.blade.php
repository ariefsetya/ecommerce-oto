@foreach($data as $key)
	<a href="{{route('store_detail',$key->id)}}">
		<li>
		<div class="photo">
		@if($key->photo==0)
		<img src="{{url('img-uploader/src/img/icon_add_image2.png')}}" title="" alt="" />
		@else
		<img src="{{\App\Image::find($key->photo)['image_type']=='url'?url('uploads/'.\App\Image::find($key->photo)['image']):""}}" title="" alt="" />
		@endif
		</div>
		<div class="dalam">
		<section class="list-left">
		<h5 class="title">{{$key->name}}</h5>
		<span class="cityname">{{$key->description}}</span>
		</section>
		<section class="list-right">
		<span class="date">{{$key->created_at}}</span>
		<span class="cityname">{{\App\City::find($key->id_city)['nama'].", ".\App\Province::find($key->id_province)['nama']}}</span>
		</section>
		</div>
		<div class="clearfix"></div>
		</li> 
	</a>
@endforeach