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
								<form action="{{route('promotion_save')}}" method="POST">
								<input type="hidden" value="{{csrf_token()}}" name="_token"></input>
									<label>Store <span>*</span></label>
									<select class="" required="" name="kios" id="kios" onchange="change_kios()" >
									  <option value="">--Select Store--</option>
									  @foreach(\App\Kios::all() as $key)
									  	<option value="{{$key->id}}">{{$key->name}}</option>
									  @endforeach
									</select>
									<div class="clearfix"></div>
									<div id="product_div">
									<div class="clearfix"></div>
									<label>Product <span>*</span></label>
									<select class="" onchange="change_product()" required name="product" id="product">
									  <option value="">--Select Store First--</option>
									</select>
									</div>
									<div class="clearfix"></div>
									<label>Promotion<br>Text <span>*</span></label>
									<textarea rows="4" data-autoresize name="promotion_text" required class="mess" placeholder="Write few lines about your promotion"></textarea>
									<div class="clearfix"></div>
									<div style="display: none;" id="old_price_div">
									<div class="clearfix"></div>
									<label>Old Price <span>*</span></label>
									<input readonly name="old_price" id="old_price" type="text" class="price" placeholder="">
									</div>
									<div id="promotion_type_div">
									<div class="clearfix"></div>
									<label>Type <span>*</span></label>
									<select class="" onchange="change_type()" required name="type" id="type">
									  <option value="">--Select Type--</option>
									  <option value="percent">by percentage</option>
									  <option value="nominal">by nominal</option>
									</select>
									</div>
									<div style="display: none;" id="price_div">
									<div class="clearfix"></div>
									<label>Price <span>*</span></label>
									<input name="price" id="price" oninput="change_price()" type="text" class="price" placeholder="">
									</div>
									<div style="display: none;" id="percent_div">
									<div class="clearfix"></div>
									<label>Discount <span>*</span></label>
									<input name="percent" id="percent" oninput="change_percent()" type="text" class="" placeholder="">
									</div>
									<div style="display: none;" id="new_price_div">
									<div class="clearfix"></div>
									<label>New Price <span>*</span></label>
									<input name="new_price" id="new_price" type="text" class="price" placeholder="">
									</div>
									<div class="clearfix"></div>
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
	<script type="text/javascript">
	$('.price').priceFormat({
	    prefix: 'Rp',
	    centsSeparator: ',',
	    thousandsSeparator: '.',
    	clearPrefix: true,
    	centsLimit: 0
	});		
	$('#percent').priceFormat({
	    suffix: '%',
	    prefix: '',
	    centsSeparator: ',',
	    thousandsSeparator: '.',
    	clearPrefix: true,
    	centsLimit: 0,
    	limit:2
	});
	function showing(id) {
		$("#"+id).fadeIn();
		$("#"+id).attr('required',true);
	}
	function hiding(id) {
		$("#"+id).fadeOut();
		$("#"+id).attr('required',false);
	}
	function enabling(id) {
		$("#"+id).attr('disabled',false);
		$("#"+id).css('background-color','white');
	}
	function disabling(id) {
		$("#"+id).css('background-color','#ccc');
		$("#"+id).attr('disabled',true);
	}
	
	function rupiah(value)
	{
		value += '';
		x = value.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
		}
		return x1;
	}

	function change_product() {
		var isi = $("#product").val();

		$.ajax({
			url:"{{route('get_product_id')}}",
			data:{_token:"{{csrf_token()}}",id:isi},
			dataType:'json',
			type:'POST',
			success:function(data) {
				$("#old_price").val(rupiah(data.price));	
				if(isi!=""){
					showing("old_price_div");
					showing("new_price_div");
				}else{
					hiding('old_price_div');
					hiding('new_price_div');
				}
			}
		});
	}
	function change_type() {
		var isi = $("#type").val();
		if(isi=="percent"){
			$("#percent").val('');
			hiding("price_div");
			showing("percent_div");
		}else{
			$("#price").val('');
			hiding("percent_div");
			showing("price_div");
		}
	}
	function change_price() {
		var old_price = $("#old_price").unmask();
		var price = $("#price").unmask();
		var new_price = parseFloat(old_price)-parseFloat(price);
		if(old_price=="" || price==""){
			new_price = 0;
		}
		if(new_price<0){
			new_price = 0;
		}
		$("#new_price").val(rupiah(new_price));
	}
	function change_percent() {
		var old_price = $("#old_price").unmask();
		var percent = $("#percent").unmask();
		var new_price = parseFloat(old_price)-(parseFloat(old_price)*(parseFloat(percent)/100));
		if(old_price=="" || percent==""){
			new_price = 0;
		}
		if(new_price<0){
			new_price = 0;
		}
		$("#new_price").val(rupiah(new_price));
	}
	function change_kios() {
	var id = $("#kios").val();
	var html = '';
		$.ajax({
			url:"{{route('get_product_id_kios')}}",
			data:{_token:"{{csrf_token()}}",id_kios:id},
			dataType:'json',
			type:'POST',
			success:function(data) {
				if(data[0].name!="No Product"){
					html +='<option value="">--Select Product--</option>';
				}
				for(key in data){
					html +='<option value="'+data[key].id+'">'+data[key].name+'</option>';
				}		
				$("#product").html(html);

			hiding('old_price_div');
			hiding('new_price_div');
			$("#percent").val('');
			}
		});
	}

	</script>
@endsection