@extends('app')

@section('body')

  <div class="main-banner banner text-center" style="background: url({{url(\App\Appconfig::where('key','img_banner')->first()['value'])}}) no-repeat;background-size: cover;background-position: center;">
    <div class="container">
      <h1>{{\App\Appconfig::where('key','heading')->first()['value']}}</h1>
      <p>{{\App\Appconfig::where('key','subheading')->first()['value']}}</p>
      <a href="{{route(\App\Appconfig::where('key','btn_heading_url')->first()['value'])}}">{{\App\Appconfig::where('key','btn_heading')->first()['value']}}</a>
    </div>
  </div>
    <!-- content-starts-here -->
    <div class="content">
      <div class="container">
      <br>
      <h1>Success!</h1>
      <h3>Your feedback has been sent</h3>
      <br>
      </div>
    </div>
@endsection
