@extends('app')

@section('body')
    <div class="content">
      <div class="categories">
        <div class="container">
        @foreach(\App\Pilar::all() as $key)
          <div class="col-md-6 focus-grid">
            <a href="{{route($key->code)}}">
              <div class="focus-border">
                <div class="focus-layout">
                  <div class="focus-image"><i style="" class="fa {{\App\Image::find($key->image)['image']}}"></i></div>
                  <h4 class="clrchg" style="">{{$key->name}}</h4>
                </div>
              </div>
            </a>
          </div>
          @endforeach
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
@endsection