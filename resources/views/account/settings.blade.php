@extends('app')

@section('body')
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
								<form action="{{route('account_update')}}" method="POST">
									<input type="hidden" value="" name="image_name" id="image_name_1"></input>
									<input type="hidden" value="{{csrf_token()}}" name="_token"></input>
									<label>Name <span>*</span></label>
									<input name="name" id="name" type="text" required class="phone" placeholder="" value="{{$user->name}}">
									<div class="clearfix"></div>
									<label>E-Mail <span>*</span></label>
									<input name="email" id="email" type="text" required class="phone" placeholder="" value="{{$user->email}}">
									<div class="clearfix"></div>
									<label>Phone <span>*</span></label>
									<input name="phone" id="phone" type="text" required class="phone" placeholder="" value="{{$user->phone}}">
									<div class="clearfix"></div>
									<label>Active Chat <span>*</span></label>
									<select class="" required="" name="active_chat" id="active_chat">
									  	<option {{$user->active_chat=="Online"?"selected":""}} value="Online">Online</option>
									  	<option {{$user->active_chat=="Offline"?"selected":""}} value="Offline">Offline</option>
									</select>										
									@if($img)
									<hr>
									<label>Current Photos :</label>
									<img src="{{$img}}" style="width:120px;">
									<div class="clearfix"></div>
									@endif			
									<div class="upload-ad-photos">
									<label>Photos :</label>
										<div class="lefted" id="lefted_1">
	 										<div id="container_image_1"></div>  
											<a style="display: none;" id="del_img_1" onclick="remove_img(1)"><i class="fa fa-times"></i> Remove</a>
										</div>
									<div class="clearfix"></div>
									<button class="btn btn-success" type="submit">Update</button>
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
<script async src="{{url('img-uploader/src/jquery.picture.cut.js')}}"></script>
<script async type="text/javascript">
fetch_img(1);
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

</script>
@endsection