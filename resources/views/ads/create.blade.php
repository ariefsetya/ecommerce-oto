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
								<form action="{{route('ads_save')}}" method="POST">
								<input type="hidden" value="{{csrf_token()}}" name="_token"></input>
								
								@for($i=0;$i<$num_foto;$i++)
								<input type="hidden" value="" name="image_name[]" id="image_name_{{$i}}"></input>
								@endfor
									<label>Store <span>*</span></label>
									<select class="" required="" name="id_kios">
									  <option value="">--Select Store--</option>
									  @foreach(\App\Kios::all() as $key)
									  	<option value="{{$key->id}}">{{$key->name}}</option>
									  @endforeach
									</select>
									<div class="clearfix"></div>
									<label>Category <span>*</span></label>
									<select class="" required="" onchange="change_category()" name="category" id="category">
									  <option value="">--Select Category--</option>
									  @foreach(\App\Pilar::all() as $key)
									  	@if($key->id==3 or $key->id==4)
									  	<option value="{{$key->id}}-1">{{$key->name}} for {{\App\Pilar::find(1)['name']}}</option>
									  	<option value="{{$key->id}}-2">{{$key->name}} for {{\App\Pilar::find(2)['name']}}</option>
									  	@else
									  	<option value="{{$key->id}}">{{$key->name}}</option>
									  	@endif
									  @endforeach
									</select>
									<div id="make_div" style="display: none;">
									<div class="clearfix"></div>
									<label>Make <span>*</span></label>
									<select class="" onchange="change_make()" required name="make" id="make">
									  <option value="">--Select Make--</option>
									</select>
									</div>
									<div id="new_make_div" style="display: none;">
									<div class="clearfix"></div>
									<label>Make Name <span>*</span></label>
									<input name="new_make" id="new_make" oninput="change_model()" type="text" class="" placeholder="">
									</div>
									<div id="model_div" style="display: none;">
									<div class="clearfix"></div>
									<label>Model <span>*</span></label>
									<select onchange="change_model()" class="" required name="model" id="model">
									  <option value="" selected>--Select Model--</option>
									  <option value="add_new">Request New Model</option>
									</select>
									</div>
									<div id="new_model_div" style="display: none;">
									<div class="clearfix"></div>
									<label>Model Name <span>*</span></label>
									<input name="new_model" oninput="change_model()" id="new_model" type="text" class="" placeholder="">
									</div>
									<div id="year_div" style="display: none;">
									<div class="clearfix"></div>
									<label>Year <span>*</span></label>
									<select onchange="change_year()" class="" required name="year" id="year">
									  <option value="">--Select Year--</option>
									  @foreach(\App\Kategori::where('id_jenis',\App\JKategori::where('code','year')->first()['id'])->orderBy('name','desc')->get() as $key)
									  <option value="{{$key->id}}">{{$key->name}}</option>
									  @endforeach
									</select>
									</div>
									<div class="clearfix"></div>
									<label>Ad Title <span>*</span></label>
									<input name="title" id="title" type="text" readonly required class="phone" placeholder="">
									<div class="clearfix"></div>
									<label>Ad Description <span>*</span></label>
									<textarea rows="4" data-autoresize name="description" required class="mess" placeholder="Write few lines about your product"></textarea>
									<div class="clearfix"></div>
									<div id="exterior_color_div" style="display: none;">
									<div class="clearfix"></div>
									<label>Exterior Color <span>*</span></label>
									<select class="" required name="exterior_color" id="exterior_color">
									  <option value="">--Select Exterior Color--</option>
									  @foreach(\App\Kategori::where('id_jenis',\App\JKategori::where('code','exterior_color')->first()['id'])->orderBy('name','desc')->get() as $key)
									  <option value="{{$key->id}}">{{$key->name}}</option>
									  @endforeach
									</select>
									</div>
									<div id="engine_size_div" style="display: none;">
									<div class="clearfix"></div>
									<label>Engine Size <span>*</span></label>
									<select class="" required name="engine_size" id="engine_size">
									  <option value="">--Select Engine Size--</option>
									  @foreach(\App\Kategori::where('id_jenis',\App\JKategori::where('code','engine_size')->first()['id'])->get() as $key)
									  <option value="{{$key->id}}">{{$key->name}}</option>
									  @endforeach
									</select>
									</div>
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
	<script type="text/javascript">
	var data_kirim = 0;
	var accs = 0;
	function change_category() {
		$("#model").val('');
		$("#make").val('');
		$("#make").css('background-color','#ccc');
		$("#make").attr('disabled',true);
		var isi = $("#category").val();
		var option = '';
		if(isi.split('-').length==1){
			data_kirim = isi;
			accs = 0;
			$("#exterior_color_div").fadeIn();
			$("#engine_size_div").fadeIn();
		}else{
			var isi2 = isi.split('-')[1];
			data_kirim = isi2;
			accs = 1;
			$("#exterior_color_div").fadeOut();
			$("#engine_size_div").fadeOut();
		}
		get_make(function(data) {
			$("#model").val('');
			$("#model").css('background-color','#ccc');
			$("#model").attr('disabled',true);
			$("#make").attr('disabled',false);
			$("#make").css('background-color','white');
			$("#make").html(data);
			$("#make_div").fadeIn();
		});
		change_make();
		change_model();
	}
	function change_make() {
		$("#model").val('');
		$("#model").css('background-color','#ccc');
		$("#model").attr('disabled',true);
		var isi = $("#make").val();
		var option = '';
		if(isi.split('-').length==1){
			data_kirim = isi;
		}else{
			var isi2 = isi.split('-')[1];
			data_kirim = isi2;
		}
		if(data_kirim!="add_new"){
			$("#new_make").attr('required',false);
			$("#new_make_div").fadeOut();
			get_model(function(data) {
				$("#model").attr('disabled',false);
				$("#model").css('background-color','white');
				$("#model").html(data);
				if(isi==0){
					$("#model").val('0');
					$("#model").css('background-color','#ccc');
					$("#model").attr('disabled',true);
				}
				$("#model_div").fadeIn();
				change_model();
			});
		}else{
			change_model();
			$("#new_make").attr('required',true);
			$("#model_div").fadeIn();
			$("#model").attr('disabled',false);
			$("#model").css('background-color','white');
			$("#model").val('add_new');
			$("#new_make_div").fadeIn();
			$("#new_make").attr('required',true);
			$("#new_model_div").fadeIn();
			$("#new_model").attr('required',true);
			change_model();
		}
	}
	function change_model() {
		var isi = $("#model").val();
		var option = '';
		if(isi!="add_new"){
			$("#new_model").attr('required',false);
			$("#new_model_div").fadeOut();
		}else{
			$("#new_model").attr('required',true);
			$("#new_model_div").fadeIn();
		}
		var cat = $("#category").val();
		var addon = '';
		if(cat==1 || cat==2){
			addon = " ("+$("#year option:selected").text()+")";
			$("#year_div").fadeIn();
		}else{
			$("#year_div").fadeOut();
		}
		var make = $("#make option:selected").text();
		if(make=="Request New Make"){
			make = $("#new_make").val();
		}
		var model = $("#model option:selected").text();
		if(model=="Request New Model"){
			model = $("#new_model").val();
		}
		$("#title").val($("#category option:selected").text()+" : "+make+" "+model+addon);
	}
	function change_year(){
		change_model();
	}
	function get_make(id) {
	var html = '';
		$.ajax({
			url:"{{route('get_make_id')}}",
			data:{_token:"{{csrf_token()}}",id_induk:data_kirim},
			dataType:'json',
			type:'POST',
			success:function(data) {
				html +='<option value="">--Select Make--</option>';
				if(accs==1){
					html +='<option value="0">Any Make</option>';
				}
				for(key in data){
					html +='<option value="'+data[key].id+'">'+data[key].name+'</option>';
				}
				html +='<option value="add_new">Request New Make</option>';
				id(html);
			}
		});
	}
	function get_model(id) {
	var html = '';
		$.ajax({
			url:"{{route('get_model_id')}}",
			data:{_token:"{{csrf_token()}}",id_induk:data_kirim},
			dataType:'json',
			type:'POST',
			success:function(data) {
				html +='<option value="">--Select Model--</option>';
				if(accs==1){
					html +='<option value="0">Any Model</option>';
				}
				for(key in data){
					html +='<option value="'+data[key].id+'">'+data[key].name+'</option>';
				}
				html +='<option value="add_new">Request New Model</option>';
				id(html);
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