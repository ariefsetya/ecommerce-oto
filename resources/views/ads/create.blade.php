@extends('app')

@section('body')
<!--div class="main-banner banner text-center" style="background: url({{url(\App\Appconfig::where('key','img_banner')->first()['value'])}}) no-repeat;background-size: cover;background-position: center;">
    <div class="container">    
      <h1>{{\App\Appconfig::where('key','heading')->first()['value']}}</h1>
      <p>{{\App\Appconfig::where('key','subheading')->first()['value']}}</p>
      <a href="{{\App\Appconfig::where('key','btn_heading_url')->first()['value']}}">{{\App\Appconfig::where('key','btn_heading')->first()['value']}}</a>
    </div>
  </div-->
<div class="total-ads main-grid-border">
		<div class="container">
			<ol class="breadcrumb" style="margin-bottom: 5px;margin-top: 20px;">
			  <li><a href="{{url()}}">Home</a></li>
			  <li><a href="{{route($brer)}}">{{$bret}}</a></li>
			  <li class="active">{{$name}}</li>
			</ol>
			<div class="ads-grid">
			@include('utils.sidebar-seller')
				<div class="ads-display col-md-9">
				<h3>{{$name}}</h3>
				<div class="">
						<div class="">
							<div class="post-ad-form">
								<form>
									<label>Select Category <span>*</span></label>
									<select class="">
									  <option>Select Category</option>
									  <option>Mobiles</option>
									  <option>Electronics and Appliances</option>
									  <option>Cars</option>
									  <option>Bikes</option>
									  <option>Furniture</option>
									  <option>Pets</option>
									  <option>Books, Sports and hobbies</option>
									  <option>Fashion</option>
									  <option>Kids</option>
									  <option>Services</option>
									  <option>Real, Estate</option>
									</select>
									<div class="clearfix"></div>
									<label>Ad Title <span>*</span></label>
									<input type="text" class="phone" placeholder="">
									<div class="clearfix"></div>
									<label>Ad Description <span>*</span></label>
									<textarea class="mess" placeholder="Write few lines about your product"></textarea>
									<div class="clearfix"></div>
								<div class="upload-ad-photos">
								<label>Photos for your ad :</label>	
 									<div class="container_image"></div>  
 									<div class="container_image"></div>  
 									<div class="container_image"></div>  
 									<div class="container_image"></div>  
								<div class="clearfix"></div>
								</div>
									<div class="personal-details">
									<form>
										<label>Your Name <span>*</span></label>
										<input type="text" class="name" placeholder="">
										<div class="clearfix"></div>
										<label>Your Mobile No <span>*</span></label>
										<input type="text" class="phone" placeholder="">
										<div class="clearfix"></div>
										<label>Your Email Address<span>*</span></label>
										<input type="text" class="email" placeholder="">
										<div class="clearfix"></div>
										<p class="post-terms">By clicking <strong>post Button</strong> you accept our <a href="terms.html" target="_blank">Terms of Use </a> and <a href="privacy.html" target="_blank">Privacy Policy</a></p>
									<input type="submit" value="Post">					
									<div class="clearfix"></div>
									</form>
									</div>
							</div>
						</div>	
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>	
	</div>
@endsection

@section('footer')

	<script src="{{url('img-uploader/src/jquery.picture.cut.js')}}"></script>
	<script type='text/javascript'>
	$(".container_image").PictureCut({
                  InputOfImageDirectory       : "image",
                  PluginFolderOnServer        : "/img-uploader/",
                  FolderOnServer              : "/uploads/",
                  EnableCrop                  : true,
                  CropWindowStyle             : "Bootstrap",
                  ImageNameRandom				: true,
                  CropModes	:{
		              widescreen: false,
		              letterbox: true,
		              free   : false
		            },
		           CropOrientation:false,
		           UploadedCallback:function(data) {
		           	console.log(data);
		           }
              });
	$(".col-xs-2").remove();
	//<![CDATA[ 
	$(window).load(function(){
	 $( "#slider-range" ).slider({
				range: true,
				min: 100000,
				max: 10000000,
				values: [ 200000, 8000000 ],
				slide: function( event, ui ) {  $( "#amount" ).val(rupiah(ui.values[ 0 ]) + " - " + rupiah(ui.values[ 1 ]) );
				}
	 });
	$( "#amount" ).val( rupiah($( "#slider-range" ).slider( "values", 0 )) + " - " + rupiah($( "#slider-range" ).slider( "values", 1 )) );

	});//]]>    
function rupiah(value)
  {
  value += '';
  x = value.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
  x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return 'Rp ' + x1 + x2;
  }


	</script>
@endsection