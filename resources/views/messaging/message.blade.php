@extends('app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/messaging.css')}}">
@endsection

@section('body')
<div class="">
    <div class="container"><a href="{{route('account')}}">Back to Account</a></div>
</div>
<div class="post-ad-form" style="padding:0px !important;margin:0px !important;">
<form>
<hr>
<label style="width:9%">Status <span></span></label>
<select style="margin-bottom:0px" class="" onchange="update_status()" required="" name="active_chat" id="active_chat">
    <option {{$user->active_chat=="Online"?"selected":""}} value="Online">Online</option>
    <option {{$user->active_chat=="Offline"?"selected":""}} value="Offline">Offline</option>
</select>   
</form>
</div>
<div class="wrapper">
    <div class="container">
        <div class="left" style="overflow-y:scroll;overflow-x:hidden;">
            <ul class="people" style="list-style-type: none;">
                @foreach(\App\Chat::groupBy('uniqid')->orderBy('id','desc')->get() as $key)
                <li class="person" data-chat="{{$key->uniqid}}" onclick="set_uniq('{{$key->uniqid}}')">
                    <img src="" alt="" />
                    <span class="name">{{$key->tmp_name}}</span>
                    <span class="time">{{\App\Chat::where('uniqid',$key->uniqid)->orderBy('id','desc')->first()['created_at']}}</span>
                    <span class="preview">{{\App\Chat::where('uniqid',$key->uniqid)->orderBy('id','desc')->first()['message']}}</span>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="right">
            <div class="top"><span>To: <span class="name"></span></span></div>
            @foreach(\App\Chat::groupBy('uniqid')->get() as $key)
            <div class="chat" data-chat="{{$key->uniqid}}">
                <div class="inside-chat" id="inside-chat_{{$key->uniqid}}">
                    
                <div class="conversation-start">
                    <span>{{$key->created_at}}</span>
                </div>
                @foreach(\App\Chat::where('uniqid',$key->uniqid)->orderBy('id','asc')->get() as $kay)
                <div class="bubble {{Auth::user()->id==$kay->id_user?"me":"you"}}">
                    {{$kay->message}}
                </div>
                @endforeach
                </div>
            </div>      
            @endforeach
            <div class="write">
                <input type="text" class="pesan"  />
                <a href="javascript:;" class="write-link send"></a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script src="https://js.pusher.com/3.2/pusher.min.js"></script>
    
<script type="text/javascript">

var uniqid = '';
function set_uniq(uniq) {
    uniqid = uniq;
}

$('.left .person').mousedown(function(){
    if ($(this).hasClass('.active')) {
        return false;
    } else {
        var findChat = $(this).attr('data-chat');
        var personName = $(this).find('.name').text();
        $('.right .top .name').html(personName);
        $('.chat').removeClass('active-chat');
        $('.left .person').removeClass('active');
        $(this).addClass('active');
        $('.chat[data-chat = '+findChat+']').addClass('active-chat');
    }
});


    var pusher = new Pusher('5476ad624b397dfd30f3', {
      encrypted: false
    });

    var channel = pusher.subscribe('chat');
    channel.bind('chat_z_{{md5(Auth::user()->id)}}', function(data) {
        //robot_ask(data.pesan);
        if($("#inside-chat_"+data.uniqid).length){
            $("#inside-chat_"+data.uniqid).append('<div class="bubble you">'+data.pesan+'</div>');
        }else{

        $('.chat').removeClass('active-chat');
        $('.left .person').removeClass('active');
                var htm = '<li class="person active" data-chat="'+data.uniqid+'" onc'+'lick="set_'+"uniq('"+data.uniqid+"')"+'">'+
                    '<img src="" alt="" />'+
                    '<span class="name">'+data.user+'</span>'+
                    '<span class="time">'+data.datetime+'</span>'+
                    '<span class="preview">'+data.pesan+'</span>'+
                '</li>';
                $(".people").prepend(htm);
                var htmd = '<div class="chat active-chat" data-chat="'+data.uniqid+'">'+
                        '<div class="inside-chat" id="inside-chat_'+data.uniqid+'">'+
                        '<div class="conversation-start">'+
                            '<span>'+data.datetime+'</span>'+
                        '</div>'+
                        '<div class="bubble you">'+
                            data.pesan+
                        '</div>'+
                        '</div>'+
                    '</div>';
                $(".write").before(htmd);

            var personName = data.user;
            $('.right .top .name').html(personName);

                $('.left .person').mousedown(function(){
                    if ($(this).hasClass('.active')) {
                        return false;
                    } else {
                        var findChat = $(this).attr('data-chat');
                        var personName = $(this).find('.name').text();
                        $('.right .top .name').html(personName);
                        $('.chat').removeClass('active-chat');
                        $('.left .person').removeClass('active');
                        $(this).addClass('active');
                        $('.chat[data-chat = '+findChat+']').addClass('active-chat');
                    }
                });
                uniqid = data.uniqid;
        }

        updateScrollbar(data.uniqid);
    });

$('.write-link send').click(function() {
  insertMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    insertMessage();
    return false;
  }
});

function update_status() {
    var status = $("#active_chat").val();
    $.ajax({
        url:'{{route('active_chat')}}',
        type:'POST',
        dataType:'json',
        data:{active_chat:status,_token:'{{csrf_token()}}'}
      });
}

function insertMessage() {
    msg = $('.pesan').val();
    if ($.trim(msg) == '') {
        return false;
    }

    $.ajax({
        url:'{{route('m_chat_send')}}',
        type:'POST',
        dataType:'json',
        data:{uniqid:uniqid,pesan:msg,_token:'{{csrf_token()}}'}
      });
    $("#inside-chat_"+uniqid).append('<div class="bubble me">'+msg+'</div>');
    $(".pesan").val('');
    updateScrollbar(uniqid);
}

function updateScrollbar(uniq) {
    var objDiv = document.getElementById("inside-chat_"+uniq);
    objDiv.scrollTop = objDiv.scrollHeight;
}
</script>
@endsection