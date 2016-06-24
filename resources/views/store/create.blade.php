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
								@if($setup==0)
								<form action="{{route('store_save')}}" method="POST">
								@elseif($setup==1)
								<form action="{{route('setup_store_save')}}" method="POST">
								@endif
								<input type="hidden" value="{{csrf_token()}}" name="_token"></input>
								
								@for($i=0;$i<$num_foto;$i++)
								<input type="hidden" value="" name="image_name[]" id="image_name_{{$i}}"></input>
								@endfor
									<div class="clearfix"></div>
									<label>Store Name <span>*</span></label>
									<input name="title" type="text" required class="phone" placeholder="">
									<div class="clearfix"></div>
									<label>Description <span>*</span></label>
									<textarea data-autoresize required name="description" rows=5 class="" placeholder="Write few lines about your store"></textarea>
									<hr>
									<label>Province <span>*</span></label>
									<select onchange="sel_city()" required class="phone" name="id_province" id="id_province">
										<option value="">--Select Province--</option>
										@foreach(\App\Province::all() as $key)
										<option value="{{$key->id}}">{{$key->nama}}</option>
										@endforeach
									</select>
									<div class="clearfix"></div>
									<label>City <span>*</span></label>
									<select class="" required name="id_city" id="id_city">
										<option value="">--Select Province First--</option>
									</select>									
									<div class="clearfix"></div>
									<label>Address <span>*</span></label>
									<textarea data-autoresize name="address" rows=5 class="" required placeholder="Your store address"></textarea>
								<div class="upload-ad-photos">
								<label>Photos :</label>
									@for($i=0;$i<$num_foto;$i++)
									<div class="lefted" id="lefted_{{$i}}">
 										<div id="container_image_{{$i}}"></div>  
										<a style="display: none;" id="del_img_{{$i}}" onclick="remove_img({{$i}})"><i class="fa fa-times"></i> Remove</a>
									</div>
 									@endfor
								<div class="clearfix"></div>
								</div>
								<button class="btn btn-success" type="submit">Post!</button>
								</form>
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
	function sel_city() {
		var prov = $("#id_province").val();
		$.ajax({
			url:'{{route("get_city_province_id")}}',
			type:'POST',
			data:{id_province:prov,_token:"{{csrf_token()}}"},
			dataType:'json',
			success:function(data) {
				var html = '';
					html +='<option value="">--Select City--</option>';
				for(key in data){
					html +='<option value="'+data[key].id+'">'+data[key].type+' '+data[key].nama+'</option>';
				}
				$("#id_city").html(html);
			}
		});
	}
	function remove_img(id) {
		$("#lefted_"+id).html('');
		$("#lefted_"+id).html('<div id="container_image_'+id+'"></div><a style="display:none" id="del_img_'+id+'" onclick="remove_img('+id+')"><i class="fa fa-times"></i> Remove</a>');
		fetch_img(id);
	}
	@for($i=0;$i<$num_foto;$i++)
		fetch_img({{$i}});
	@endfor
	function fetch_img(id) {
		$("#container_image_"+id).PictureCut({
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
	           	$("#image_name_"+id).val(data.currentFileName);
	           	$("#del_img_"+id).css('display','block');
	           }
          });
	}
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