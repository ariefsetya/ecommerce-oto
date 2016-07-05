<select name="pilar" id="pilar" class="selectpicker show-tick" data-live-search="true">
	@foreach(\App\Pilar::all() as $key)
	<option @if($key->id==$id_p) selected @endif value="{{$key->id}}" data-tokens="{{$key->id}}">{{$key->name}}</option>
	@endforeach
</select>