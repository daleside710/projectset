@extends('backend.layouts.master')
@section('title','Endre ofte stilte spørsmål')
@section('content')
    @push('style')
        <style>
            .container{max-width:1170px; margin:auto;}
            img{ max-width:100%;}
            .inbox_people {
                background: #f8f8f8 none repeat scroll 0 0;
                float: left;
                overflow: hidden;
                width: 40%; border-right:1px solid #c4c4c4;
            }
            .inbox_msg {
                border: 1px solid #c4c4c4;
                clear: both;
                overflow: hidden;
            }
            .top_spac{ margin: 20px 0 0;}


            .recent_heading {float: left; width:40%;}
            .srch_bar {
                display: inline-block;
                text-align: right;
                width: 100%;
            }
            .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

            .recent_heading h4 {
                color: #05728f;
                font-size: 21px;
                margin: auto;
            }
            .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
            .srch_bar .input-group-addon button {
                background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
                border: medium none;
                padding: 0;
                color: #707070;
                font-size: 18px;
            }
            .srch_bar .input-group-addon { margin: 0 0 0 -27px;}

            .chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
            .chat_ib h5 span{ font-size:13px; float:right;}
            .chat_ib p{ font-size:14px; color:#989898; margin:auto}
            .chat_img {
                float: left;
                width: 11%;
            }
            .chat_ib {
                float: left;
                padding: 0 0 0 15px;
                width: 88%;
            }

            .chat_people{ overflow:hidden; clear:both;}
            .chat_list {
                border-bottom: 1px solid #c4c4c4;
                margin: 0;
                padding: 18px 16px 10px;
            }
            .inbox_chat { height: 550px; overflow-y: scroll;}

            .active_chat{ background:#ebebeb;}

            .incoming_msg_img {
                display: inline-block;
                width: 6%;
            }
            .received_msg {
                display: inline-block;
                padding: 0 0 0 10px;
                vertical-align: top;
                width: 92%;
            }
            .received_withd_msg p {
                background: #ebebeb none repeat scroll 0 0;
                border-radius: 3px;
                color: #646464;
                font-size: 14px;
                margin: 0;
                padding: 5px 10px 5px 12px;
                width: 100%;
            }
            .time_date {
                color: #747474;
                display: block;
                font-size: 12px;
                margin: 8px 0 0;
            }
            .received_withd_msg { width: 57%;}
            .mesgs {
                float: left;
                padding: 15px 15px 0 25px;
                width: 100%;
            }

            .sent_msg p {
                background: #05728f none repeat scroll 0 0;
                border-radius: 3px;
                font-size: 14px;
                margin: 0; color:#fff;
                padding: 5px 10px 5px 12px;
                width:100%;
            }
            .outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
            .sent_msg {
                float: right;
                width: 46%;
                margin-right: 35px;
            }
            .input_msg_write input {
                background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
                border: medium none;
                color: #fff;
                font-size: 15px;
                min-height: 48px;
                width: 100%;
                padding-left: 15px;
            }

            .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
            .msg_send_btn {
                background: #05728f none repeat scroll 0 0;
                border: medium none;
                border-radius: 50%;
                color: #fff;
                cursor: pointer;
                font-size: 17px;
                height: 33px;
                position: absolute;
                right: 0;
                top: 11px;
                width: 33px;
            }
            .messaging { padding: 0 0 50px 0;}
            .msg_history {
                margin-top: 10px;
                height: 450px;
                overflow-y: auto;
            }
            .query_box{
                margin-left: 0px;
                background-color: #e12a4c;
                color: #fff;
                padding: 8px;
                margin-right: 0px;
                border-radius: 4px;
            }
            .status_box{
                text-align: right;
            }
            .status{
                border-radius: 15px;
                padding: 5px 10px;
                line-height: 30px;
            }
            .status.active{
                background-color: green;
                color: white;
            }
            .closed{
                background-color: darkslategray;
                color: white;
            }
            .pending{
                background-color: #17a2b8;
                color: white;
            }
            .sender_info{
                line-height: 16px;
            }
            .btn_status{
                padding: 7px 34px;
            }
            .btn_status i{
                font-size: 15px;
            }
            .dropdown-menu{
                min-width: 6rem;
            }
            .chat_status{
                display: block;
                background-color: #fff;
                color: #000;
                padding: 2px 9px;
                border-radius: 7px;
                margin: 30px 54px;
                text-align: center;
                font-weight: 400;
            }
        </style>
    @endpush
    <div class="container" id="app">
        <h3 class=" text-center">Messaging</h3>

        <div class="messaging">
            <div class="inbox_msg">
                <div class="mesgs">
                    <div class="row query_box">
                        <div class="col-lg-4">
                            <div class="sender_info">
                                <i class="fa fa-user"></i> {{$querie->senderUser->name}}<br>
                                <i class="fas fa-envelope"></i> {{$querie->senderUser->email}}
                            </div>
                        </div>
                        <div class="col-lg-5">
                            {{$querie->message}}
                        </div>
                        <div class="col-lg-3">
                            <div class="status_box">
                                <span class="status {{$querie->status}}">
                                    {{$querie->status}}
                                </span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn_status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="changeStatus('{{$querie->id}}','pending')" id="pending" style="display: {{$querie->status == 'pending' ? 'none':'block'}};">Pending</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="changeStatus('{{$querie->id}}','active')" id="active" style="display: {{$querie->status == 'active' ? 'none':'block'}};">Active</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="changeStatus('{{$querie->id}}','closed')" id="closed" style="display: {{$querie->status == 'closed' ? 'none':'block'}};">Closed</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- display messages box -->
                    <div class="msg_history">
                        @foreach($messages as $msg)
                            @if($msg->type == 'admin')
                                <div class="incoming_msg">
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p>{{$msg->message}}</p>
                                            <span class="time_date"> {{$msg->created_at}}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p>{{$msg->message}}</p>
                                        <span class="time_date"> {{$msg->created_at}}</span> </div>
                                </div>
                            @endif
                        @endforeach
                        @if($querie->status == 'closed')
                            <div class="chat_status">
                               {{ $querie->chat_msg }}
                            </div>
                        @endif

                    </div>
                    <!-- end message box -->
                    <!-- chat form-->
                    @if($querie->status != 'closed')
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <form name="messageForm" id="messageForm">
                                <input type="hidden" name="sender_id" value="{{$querie->sender_id}}">
                                <input type="hidden" name="querie_id" value="{{$querie->id}}">
                                <input type="text" name="message" id="messageText" class="write_msg" placeholder="Type a message" />
                            </form>
                            <button class="msg_send_btn" onclick="sendMessage()" type="button"><i class="fa fa-location-arrow" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    @endif
                    <!-- chat form -->
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.changeStatus') }}" id="statusForm" method="POST">
        @csrf
        <input type="hidden" name="chat_querie" id="chat_querie" value="{{$querie->id}}">
        <input type="hidden" name="querie_status" id="querie_status">
    </form>
    <meta name="sendMessage" content="{{route('admin.Message_chat')}}">
    <meta name="fetchMessages" content="{{route('admin.fetchMessages')}}">
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="loggedInUser" content="{{Auth::user()}}">
    <meta name="chatId" content="{{$querie->id}}">

@endsection
@push('script')
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>

    <script>
        var messages=[];
        var renderHtml='';
        var query_id='{{$querie->id}}';
        var chat_id=$('meta[name="chatId"]').attr('content');
        var messageBox=$('.msg_history');
        var messageInput=$('#messageText');
        var loggedInUser = JSON.parse($('meta[name=loggedInUser]').attr('content'));

        function moveToBottom(){
            var div = $('.msg_history');
            height = div.height();
            div.animate({scrollTop: 5000}, 500);
        }
        function sendMessage(){
            var message=$('#messageText').val();
            var url = $('meta[name="sendMessage"]').attr('content');
            var data = new FormData($('#messageForm')[0]);
            displayMessage(message);
            $('#messageForm')[0].reset();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: url,
                type: 'post',
                processData: false,
                contentType:  false,
                data: data,
                success : function(data){
                    //  console.log('success');
                },
                error : (error) => { console.log(JSON.stringify(error)); }
            });
        }

        function fetchMessages(){
            var url = $('meta[name="fetchMessages"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: url,
                type: 'get',
                processData: false,
                contentType:  false,
                data: '',
                success : function(data){
                    // messages.push(message);
                    $('#messageForm')[0].reset();
                    // console.log(data.messages)
                },
                error : (error) => { console.log(JSON.stringify(error)); }
            });
        }
        function displayMessage(message){
            var d = new Date();
            var now = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate()+' '+d.getHours() + ":" + (d.getMinutes()) + ":" + d.getSeconds();
            jQuery('.msg_history').append(
                '<div class="outgoing_msg">' +
                '<div class="sent_msg">' +
                '<p>'+message +'</p>\n' +
                '<span class="time_date">'+now+'</span> </div>\n' +
                '</div>');
            moveToBottom();
        }
        function userMessage(data){
            var EventData=JSON.parse(data.message);
            console.log(EventData);
            if(EventData.type == 'user')
            {
                var d = new Date();
                var now = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate()+' '+d.getHours() + ":" + (d.getMinutes()) + ":" + d.getSeconds();
                jQuery('.msg_history').append('<div class="incoming_msg">'+
                    '<div class="received_msg">'+
                    '<div class="received_withd_msg">'+
                    '<p>'+ EventData.message +'</p>'+
                    '<span class="time_date">'+now+'</span>'+
                    '</div></div></div>');
                moveToBottom();
            }
        }

        function changeStatus(querie,status){
            $('#chat_querie').val(querie);
            $('#querie_status').val(status);
            $('#statusForm').submit();
           /* var url = '';
            url1 = url+'/'+querie+'/'+status;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: url1,
                type: 'get',
                processData: false,
                contentType:  false,
                data: {},
                success : function(data){
                    //console.log('Querie status success');
                    location.reload();
                },
                error : (error) => { console.log(JSON.stringify(error)); }
            });*/
        }

        function fetchMessages(){
            var url = $('meta[name="fetchMessages"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: url,
                type: 'get',
                processData: false,
                contentType:  false,
                data: '',
                success : function(data){
                    // messages.push(message);
                    $('#messageForm')[0].reset();
                    // console.log(data.messages)
                },
                error : (error) => { console.log(JSON.stringify(error)); }
            });
        }
        function closedstatus(data){
            var EventData=JSON.parse(data.message);
            //console.log(EventData);
            if(EventData.type == 'user' && query_id == EventData.querie_id )
            {
                location.reload();
            }
        }
        // pusher js script
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;
        var pusher = new Pusher('375bbae2be23e1ec898f', {
            cluster: 'ap2',
            forceTLS: true
        });
        var channel = pusher.subscribe('MessageChannel');
        channel.bind('MessageEvent', function(data) {
            userMessage(data);
        });
        var channel2 = pusher.subscribe('ClosedChannel');
        channel2.bind('ClosedEvent', function(data) {
            closedstatus(data);
        });
        // end pusher js script

        $(document).ready(function () {
            messageInput.keydown(function(e){

                if(e.which==13){
                    sendMessage();
                    e.preventDefault();
                }
            });

            moveToBottom();
        });

    </script>
@endpush

