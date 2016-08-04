<select name="city" id="city">
@foreach(\App\Province::orderBy('nama','asc')->get() as $key)
	<optgroup label="{{$key->nama}}">
		<option @if($place==0) @if($key->id==6) selected @endif @else @if($place==$key->id."-0") selected @endif @endif value="{{$key->id."-0"}}">All {{$key->nama}}</option>
	@foreach(\App\City::where('id_provinsi',$key->id)->get() as $kay)
		<option @if($place!=0) @if($place==$kay->id."-1") selected @endif @endif value="{{$kay->id."-1"}}">{{$kay->type." ".$kay->nama}}</option>
	@endforeach
	</optgroup>
@endforeach
</select>