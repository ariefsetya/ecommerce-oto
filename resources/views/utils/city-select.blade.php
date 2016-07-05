<select name="city" id="city">
@foreach(\App\Province::orderBy('nama','asc')->get() as $key)
	<optgroup label="{{$key->nama}}">
	@foreach(\App\City::where('id_provinsi',$key->id)->get() as $kay)
		<option @if($kay->id==154) selected @endif value="{{$kay->id}}">{{$kay->nama}}</option>
	@endforeach
	</optgroup>
@endforeach
</select>