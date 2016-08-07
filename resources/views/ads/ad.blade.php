@extends('app')

@section('header')
	<link rel="stylesheet" href="{{url('assets/css/flexslider.css')}}" type="text/css" media="screen" />
@endsection

@section('body')
<div class="single-page main-grid-border">
		<div class="container">
			<ol class="breadcrumb" style="margin-bottom: 5px;margin-top: 20px;">
			  <li><a href="{{url()}}">Home</a></li>
			  <li><a href="{{route($brer,[$deta->id_kios])}}">{{$bret}}</a></li>
			  <li class="active">{{$name}}</li>
			</ol>
			<div class="product-desc">
				<div class="col-md-8 product-view">
					<h2>{{$deta->name}}</h2>
					<?php
					$sup = 'th';
					if(substr(date_format(date_create($deta->created_at),"d"),strlen(date_format(date_create($deta->created_at),"d"))-1,1)==2){
						$sup = 'nd';
					}else if(substr(date_format(date_create($deta->created_at),"d"),strlen(date_format(date_create($deta->created_at),"d"))-1,1)==1){
						$sup = 'st';
					}
					?>
					<p> <i class="glyphicon glyphicon-map-marker"></i><a href="#">{{\App\Province::find($kios->id_province)['nama']}}</a>, <a href="#">{{\App\City::find($kios->id_city)['nama']}}</a> | Added on {!!date_format(date_create($deta->created_at),"D, F d")."<sup>".$sup."</sup>".date_format(date_create($deta->created_at)," Y")." at ".date_format(date_create($deta->created_at),"H:i:s")!!}, Ad ID : #{{explode('-',$deta->slug)[sizeof(explode('-',$deta->slug))-1]}}</p>
					<div class="flexslider">
						<ul class="slides">
							@foreach(\App\Image::where('code','product-'.$deta->id)->get() as $key)
							<li data-thumb="{{url('uploads/'.$key->image)}}">
								<img src="{{url('uploads/'.$key->image)}}" />
							</li>
							@endforeach
							@if(sizeof(\App\Image::where('code','product-'.$deta->id)->get())==0)
							<li data-thumb="{{url('img-uploader/src/img/icon_add_image2.png')}}">
								<img src="{{url('img-uploader/src/img/icon_add_image2.png')}}" />
							</li>
							@endif
						</ul>
					</div>
					<div class="product-details" style="color: #222;">
						<p>{{$deta->description}}</p>
					</div>
				</div>
				<div class="col-md-4 product-details-grid">
					<div class="item-price">
						<div class="product-price">
							<p class="p-price">Price</p>
							<h4 class="rate">Rp. {{number_format($deta->price,2)}}</h4>
							<div class="clearfix"></div>
						</div>
						<div class="condition">
							<p class="p-price">Condition</p>
							<h4 class="rate">{{\App\Kategori::find(\App\ProductCategory::where('id_product',$deta->id)->where('id_kategori',\App\JKategori::where('code','condition')->first()['id'])->first()['value'])['name']}}</h4>
							<div class="clearfix"></div>
						</div>
						<div class="itemtype">
							<p class="p-price">Item Type</p>
							<h4 class="rate">{{\App\Pilar::find($deta->id_pilar)['name']}}</h4>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="interested">
						<h4>Interested in this Ad?<small> Contact the Seller!</small></h4><br>
						<span><img src="https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Download-Computer-512.png" style="width:30px;"> <a target="_blank" href="{{route('ads_download',$deta->slug)}}">Download Catalogue</a></span>
						<br>
						<span><img src="http://www.freeiconspng.com/uploads/dentist-rochester-ny--contemporary-dentistry-rochester-ny-24.png" style="width: 30px;"> {{$kios->phone}} @if($kios->accept_wa=="on") - WhatsApp Accepted @endif</span>
						<br>
						<span><img src="http://www.freeiconspng.com/uploads/logo-bbm-blackberry-messenger--logodesain-29.png" style="width:30px;"> {{$kios->bbm}}</span>
						<br>
						<span><img src="https://d30y9cdsu7xlg0.cloudfront.net/png/5982-200.png" style="width:30px;"> Chat to seller (Now Offline)</span>
					</div>
					<div class="">
					@if(Auth::check())
					@if($kios->id_user!=Auth::user()->id)
						<div class="chat">
						  <div class="chat-title">
						    <h1>{{\App\User::find($kios->id_user)['name']}}</h1>
						    <h2>{{$kios->name}}</h2>
						    <figure class="avatar">
						      <img src="http://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80_4.jpg" />
						    </figure>
						  </div>
						  <div class="messages">
						    <div class="messages-content" id="messages-content"></div>
						  </div>
						  <div class="message-box">
						    <textarea type="text" class="message-input" placeholder="Type message..."></textarea>
						    <button type="submit" class="message-submit">Send</button>
						  </div>
						</div>
						@endif
						@else
						<div class="chat">
						  <div class="chat-title">
						    <h1>{{\App\User::find($kios->id_user)['name']}}</h1>
						    <h2>{{$kios->name}}</h2>
						    <figure class="avatar">
						      <img src="http://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80_4.jpg" />
						    </figure>
						  </div>
						  <div class="messages">
						    <div class="messages-content" id="messages-content"></div>
						  </div>
						  <div class="message-box">
						    <textarea type="text" class="message-input" placeholder="Type message..."></textarea>
						    <button type="submit" class="message-submit">Send</button>
						  </div>
						  <div class="message-box" style="padding-bottom: 40px;">
						  	<span class="message-input">Signed As</span><span id="name" class="message-input">Guest</span>
						    <button onclick="logout()" id="logout-btn" class="message-submit" style="background: red;opacity: 0">Logout</button>
						  </div>
						</div>
						@endif
					</div>
				</div>
			<div class="clearfix"></div>
			</div>
		</div>
	</div>
@endsection

@section('footer')  

	<script src="https://js.pusher.com/3.2/pusher.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js"></script>
	<script defer src="{{url('assets/js/jquery.flexslider.js')}}"></script>
	<script>
	var $messages = $('.messages-content'),
    d, h, m,
    i = 0;

var nama = '';
var email = '';
var phone = '';
var uniqid = '';
var pusher = null;
var channel = null;
function binding_pusher(uniqid) {
	pusher = new Pusher('5476ad624b397dfd30f3', {
	  encrypted: false
	});
	channel = pusher.subscribe('chat');
	channel.bind('chat_x_'+uniqid, function(dats) {
  		robot_ask(dats.pesan);
	});
}

function ajax_set_data(key,value) {
  	$.ajax({
  		url:'{{route('chat_set_data')}}',
  		type:'POST',
  		dataType:'json',
  		data:{key:key,value:value,_token:'{{csrf_token()}}'},
  		success:function(data) {
  			uniqid = data.uniqid;
		}
  	});
}
pusher = new Pusher('5476ad624b397dfd30f3', {
  encrypted: false
});
channel = pusher.subscribe('chat');

@if(Auth::check())
	nama = '{{Auth::user()->name}}';
	email = '{{Auth::user()->email}}';
	phone = '{{Auth::user()->phone}}';
	uniqid = '{{Auth::user()->id}}';
	$("#name").html(nama);
  	$("#logout-btn").css('opacity',1);
@else
	nama = '{{\Session::get('nama')}}';
	email = '{{\Session::get('email')}}';
	phone = '{{\Session::get('phone')}}';
	uniqid = '{{\Session::get('uniqid')}}';

	if(uniqid!=""){
		binding_pusher(uniqid);
	}
	if(nama!=""){
		$("#name").html(nama);
  		$("#logout-btn").css('opacity',1);
	}
@endif

	$(window).load(function() {
  $messages.mCustomScrollbar();
	  $('.flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails"
	  });
	  setTimeout(function() {
	    // fakeMessage();
	    if(nama==""){
	    	askname();
	    }else if(email==""){
	    	askemail();
	    }else if(phone==""){
	    	askphone();
	    }else{
	    	greetings();
	    }
	  }, 100);
	});

function logout() {
	nama = "";
	email = "";
	phone = "";
	uniqid = "";
	pusher = null;
	ajax_set_data('nama',null);
	ajax_set_data('email',null);
	ajax_set_data('phone',null);
	ajax_set_data('uniqid',null);
	$("#name").html('Guest');
  	$("#logout-btn").css('opacity',0);

    if(nama==""){
    	askname();
    }else if(email==""){
    	askemail();
    }else if(phone==""){
    	askphone();
    }else{
    	greetings();
    }
	//location.reload();
}

function greetings() {
	@if(Auth::check())
	robot_ask('Hai, saya {{\App\User::find($kios->id_user)['name']}}. Ada yang bisa kami bantu?');
	@else
	robot_ask('Hai '+nama+', saya {{\App\User::find($kios->id_user)['name']}}. Ada yang bisa kami bantu?');
	@endif
}
function askname() {
	@if(!Auth::check())
	robot_ask('Hai, saya {{\App\User::find($kios->id_user)['name']}}. Silakan tulis nama Anda...');
	@endif
}
function askphone() {
	robot_ask('Hai '+nama+', saya {{\App\User::find($kios->id_user)['name']}}. Silakan tulis nomor telepon Anda...');
}
function askemail() {
	robot_ask('Hai '+nama+', saya {{\App\User::find($kios->id_user)['name']}}. Silakan tulis email Anda...');
}
function robot_ask(msg) {
	  $('<div class="message loading new"><figure class="avatar"><img src="http://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80_4.jpg" /></figure><span></span></div>').appendTo($('.mCSB_container'));
	  updateScrollbar();

	  setTimeout(function() {
	    $('.message.loading').remove();
	    $('<div class="message new"><figure class="avatar"><img src="http://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80_4.jpg" /></figure>'+msg+'</div>').appendTo($('.mCSB_container')).addClass('new');
		setDate();
		updateScrollbar();
	  }, 1000);
}
function updateScrollbar() {
	var objDiv = document.getElementById("messages-content");
	objDiv.scrollTop = objDiv.scrollHeight;
}

function setDate(){
  d = new Date()
  if (m != d.getMinutes()) {
    m = d.getMinutes();
    $('<div class="timestamp">' + d.getHours() + ':' + m + '</div>').appendTo($('.message:last'));
  }
}

function insertMessage() {
  msg = $('.message-input').val();
  if ($.trim(msg) == '') {
    return false;
  }
  if(nama==""){
  	nama = msg;
  	setTimeout(function() {
  		ajax_set_data('nama',msg);
  		$("#name").html(nama);
  		$("#logout-btn").css('opacity','1');
  		robot_ask('Hai '+nama+', sekarang silakan tulis email Anda :)');
  		return;
  	},500);
  }
  else if(email==""){
  	email = msg;
  	setTimeout(function() {
  		ajax_set_data('email',msg);
  		robot_ask('Silakan tulis nomor telepon Anda yang bisa kami hubungi');
  	},1000);
  }
  else if(phone==""){
  	phone = msg;
  	setTimeout(function() {
  		ajax_set_data('phone',msg);
  		robot_ask('Selamat Datang di BursaOto<br>ini adalah pesan otomatis kami, silakan tinggalkan pesan<br><br>Setelah itu kami akan segera menghubungi Anda melalui telepon atau email :)');
  	},1000);
  }else{
  	$.ajax({
  		url:'{{route('chat_send')}}',
  		type:'POST',
  		dataType:'json',
  		data:{to:'{{md5($kios->id_user)}}',mova:{{$kios->id_user}},pesan:msg,_token:'{{csrf_token()}}'}
	});
  }  	
  	setTimeout(function() {
  		if(pusher==null){
			binding_pusher(uniqid);
		}
	},1000);
  $('<div class="message message-personal">' + msg + '</div>').appendTo($('.mCSB_container')).addClass('new');
  setDate();
  $('.message-input').val(null);
  updateScrollbar();
  // setTimeout(function() {
  //   fakeMessage();
  // }, 1000 + (Math.random() * 20) * 100);
}

$('.message-submit').click(function() {
  insertMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    insertMessage();
    return false;
  }
});

// var Fake = [
//   'Hi there, I\'m Fabio and you?',
//   'Nice to meet you',
//   'How are you?',
//   'Not too bad, thanks',
//   'What do you do?',
//   'That\'s awesome',
//   'Codepen is a nice place to stay',
//   'I think you\'re a nice person',
//   'Why do you think that?',
//   'Can you explain?',
//   'Anyway I\'ve gotta go now',
//   'It was a pleasure chat with you',
//   'Time to make a new codepen',
//   'Bye',
//   ':)'
// ]

// function fakeMessage() {
//   if ($('.message-input').val() != '') {
//     return false;
//   }
//   $('<div class="message loading new"><figure class="avatar"><img src="http://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80_4.jpg" /></figure><span></span></div>').appendTo($('.mCSB_container'));
//   updateScrollbar();

//   setTimeout(function() {
//     $('.message.loading').remove();
//     $('<div class="message new"><figure class="avatar"><img src="http://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80_4.jpg" /></figure>' + Fake[i] + '</div>').appendTo($('.mCSB_container')).addClass('new');
//     setDate();
//     updateScrollbar();
//     i++;
//   }, 1000 + (Math.random() * 20) * 100);

// }
	</script>
@endsection