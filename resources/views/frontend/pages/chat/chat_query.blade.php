@extends('frontend.layouts.master')

@section('title', 'Support')
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
        /*.inbox_msg {
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
            padding: 30px 15px 0 25px;
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
            height: 450px;
            overflow-y: auto;
        }*/
        .box_msg{
            margin-bottom: 12px;
        }
        .query_box{
            background-color: #323150;
            padding: 8px 5px;
            border-radius: 4px;
        }
        .query_box a,.dropdown-item:focus, .dropdown-item:hover{
            color:#fff;
        }
        .dropdown-item:focus, .dropdown-item:hover {
            background-color: #32324e;
        }
        .query_box a:hover{
            text-decoration: underline;
        }

        .dropdown-menu.show {
            background-color: #32324e;
        }

        .status_box{
            text-align: right;
        }
        .status{
            border-radius: 15px;
            width: 110px;
            white-space: nowrap;
            display: inline-block;
            text-align: center;
            vertical-align: sub;
        }
        .btn_status{
            padding: 0px 4px;
            color: #1e202f;
        }
        .active{
            background-color: green;
            color: white;
        }
        .closed{
            background-color: #712b2b;
            color: white;
        }
        .query_box .sender_info{
            color: #cafa5a;
        }
        .pending{
            background-color: #17a2b8;
            color: white;
        }
        .btn_status i{
            font-size: 18px;
        }
        .btn_status:hover,btn_status:focus{
            color: #1e202f;
        }
        .create_new{
            margin-bottom: 10px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .sender_info{
            line-height: 16px;
        }
        .messageForm textarea{
            color:#fff;
        }
        .alert-dismissible .close{
            opacity: 0.5;
        }
        .alert{
            color: #9e9caa;
        }
        .alert-success{
            background-color: transparent;
        }
        .new_msg{
            right: 0;
            top: 0;
            position: absolute;
        }
        .new_msg{
            height: 24px;
            text-align: center;
            background-color: #dc3545;
            width: 36px;
            font-size: 12px;
            border-radius: 50%;
            display: inline-block;
            color: white;
        }
        .btn-group, .btn-group-vertical {
            vertical-align: sub;
        }
    </style>
@endpush
@section('content')

    <div class="container" id="app">
        <div class="messaging">
            <div class="inbox_msg">
                <div class="create_new">
                    <button type="button" data-toggle="modal" data-target="#QueryModal" class="btn btn-info">Opprett ny henvendelse</button>
                </div>
                <div class="mesgs">
                    @foreach($queries as $querie)
                    <div class="box_msg col-lg-12">
                            <div class="query_box row" id="querie_{{$querie->id}}">
                                <div class="col-lg-3">
                                    <div class="sender_info">
                                        <i class="fa fa-user"></i> {{$querie->senderUser->name}}<br>
                                        <i class="fas fa-envelope"></i> {{$querie->senderUser->email}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <a href="{{route('chat',$querie->id)}}">{{$querie->message}}
                                        @if(isset($querie->count_unread) && $querie->count_unread > 0)
                                            <div class="new_msg"><span>Ny</span></div>
                                        @endif
                                    </a></div>
                                <div class="status_box col-lg-3">
                                    <span class="status {{$querie->status}}">
                                        {{$querie->status}}
                                    </span>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn_status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item pending_{{$querie->id}}" href="javascript:void(0)" onclick="changeStatus('{{$querie->id}}','pending')" id="pending" style="display: {{$querie->status == 'pending' ? 'none':'block'}};">Avventer svar</a>
{{--                                            <a class="dropdown-item active_{{$querie->id}}" href="javascript:void(0)" onclick="changeStatus('{{$querie->id}}','active')" id="active" style="display: {{$querie->status == 'active' ? 'none':'block'}};">Aktiv</a>--}}
                                            <a class="dropdown-item closed_{{$querie->id}}" href="javascript:void(0)" onclick="changeStatus('{{$querie->id}}','closed')" id="closed" style="display: {{$querie->status == 'closed' ? 'none':'block'}};">Lukk</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="time_date">{{$querie->created_at}}</span>
                    </div>
                    @endforeach
                    <!-- display messages box -->
                    <div class="msg_history">
                       {{-- @foreach($messages as $msg)
                            @if($msg->type == 'admin')
                                <div class="incoming_msg">
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p>{{$msg->message}}</p>
                                            <span class="time_date">{{$msg->created_at}}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p>{{$msg->message}}</p>
                                        <span class="time_date">{{$msg->created_at}}</span> </div>
                                </div>
                            @endif
                        @endforeach--}}

                    </div>
                    <!-- end message box -->
                </div>
                {{$queries->links()}}
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="QueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Oprett ny henvendelse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box_alert" >
                        <div class="Icon_loading" style="text-align: center; display:none;">
                            <img src="{{asset('images/sending_icon.gif')}}" style="height: 80px;">
                        </div>
                    </div>
                    <form name="messageForm" id="messageForm">
                        <div class="form-group">
                            <label for="modal_query" class="col-form-label">Melding:</label>
                            <textarea class="form-control" name="queryText" id="modal_query" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="sendMessage()" class="btn btn-success ">Send melding</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Lukk</button>
                </div>
            </div>
        </div>
    </div><!-- Modal -->
    <form action="{{ route('changeStatus') }}" id="statusForm" method="POST">
        @csrf
        <input type="hidden" name="chat_querie" id="chat_querie" >
        <input type="hidden" name="querie_status" id="querie_status">
    </form>
    <meta name="sendMessage" content="{{route('sendQuery')}}">
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="loggedInUser" content="{{Auth::user()}}">

@endsection
@push('script')
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>

    <script>
        var messages=[];
        var renderHtml='';
        var message_url='{{route('home')}}';
        var messageBox=$('.mesgs');
        var messageInput=$('#modal_query');
        var loggedInUser = JSON.parse($('meta[name=loggedInUser]').attr('content'));

        function moveToBottom(){
            var div = $('.mesgs');
            height = div.height();
            div.animate({scrollTop: 5000}, 500);
        }
        function sendMessage(){
            var message=$('#modal_query').val();
            var url = $('meta[name="sendMessage"]').attr('content');
            var data = new FormData($('#messageForm')[0]);
            if(message!="") {
                displayMessage(message);

                $('#messageForm')[0].reset();
                $('.Icon_loading').css('display', 'block');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    url: url,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (data) {
                        // location.reload();
                        $('.Icon_loading').css('display', 'none');
                        var successMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert"> \n' +
                            '                        Melding sendt! Du hører fra oss snart.\n' +
                            '                    <button type="button" class="close" data-dismiss="alert" aria-label="Lukk">\n' +
                            '                        <span aria-hidden="true">&times;</span>\n' +
                            '                    </button> \n' +
                            '                </div>';
                        $('.message_link').attr('href', message_url + '/chat/' + data.querie_id)
                        $('.message_link').removeClass('message_link');
                        $('#close_status').attr("onclick", "changeStatus(" + data.querie_id + ",'closed')");
                        $('#close_status').removeAttr('id');
                        $('.box_alert').append(successMsg);


                        // messages.push(message);
                    },
                    error: (error) => {
                        console.log(JSON.stringify(error));
                    }
                });
            }
        }

        function displayMessage(message){
            var d = new Date();
            var now = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate()+' '+d.getHours() + ":" + (d.getMinutes()) + ":" + d.getSeconds();
            jQuery('.mesgs').prepend(
            '<div class="box_msg col-lg-12">\n'+
                '<div class="query_box row">\n'+
                '<div class="col-lg-3">\n'+
                '<div class="sender_info">\n'+
                '<i class="fa fa-user"></i> '+ loggedInUser.name +'<br>\n'+
                '<i class="fas fa-envelope"></i> '+ loggedInUser.email +
                '</div>\n'+
             '</div>\n'+
                '<div class="col-lg-6">\n' +
                '<a href="" class="message_link">'+message+'</a></div>\n'+
            '<div class="status_box col-lg-3">\n'+
                '<span class="status pending">\n'+
                    'avventer svar' +
                '</span>\n'+
                '<div class="btn-group">\n'+
                '<button type="button" class="btn btn_status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n'+
                '<i class="fas fa-edit"></i>\n'+
                '</button>\n'+
                '<div class="dropdown-menu">\n'+
                // '<a class="dropdown-item" href="#">Active</a>\n'+
                '<a class="dropdown-item" href="javascript:void(0)" id="close_status">Lukk <henvendelse></henvendelse></a>\n'+
                '</div>\n'+
                '</div>\n'+
                '</div>\n'+
                '</div>\n'+
                '<span class="time_date">'+ now +'</span>\n'+
            '</div>');
            moveToBottom();
        }

        function changeStatus(querie,status){
            $('#chat_querie').val(querie);
            $('#querie_status').val(status);
            $('#statusForm').submit();
        }
        function closedstatus(data){
            var EventData=JSON.parse(data.message);
            //console.log(EventData);
            if(EventData.type == 'admin' && loggedInUser.id == EventData.receiver_id )
            {
                var status= $('#querie_'+EventData.querie_id +' .status');
                var status_previous= status.val();
                // $('#'+status_previous).css('display','none');
                // $('#'+EventData.status).css('display','block');
                status.removeClass('active');
                status.removeClass('pending');
                status.removeClass('closed');
                status.text(EventData.status);
                status.addClass(EventData.status);

            }
        }
        function statusChangeDisplay(data){
            var EventData=JSON.parse(data.message);
            //console.log(EventData);
            if(EventData.type == 'admin' && loggedInUser.id == EventData.receiver_id )
            {
                var status= $('#querie_'+EventData.querie_id +' .status');
                status.text('aktiv');
                status.removeClass('pending');
                status.addClass('active');
            }
        }


        // pusher js script
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;
        var pusher = new Pusher('375bbae2be23e1ec898f', {
            cluster: 'ap2',
            forceTLS: true
        });
        // var channel = pusher.subscribe('StatusChannel');
        // channel.bind('StatusEvent', function(data) {
        //     statusChangeDisplay(data);
        // });
        var channel = pusher.subscribe('ClosedChannel');
        channel.bind('ClosedEvent', function(data) {
            closedstatus(data);
        });
        //end pusher js script

        $(document).ready(function () {
            messageInput.keydown(function(e){
                if(e.which==13){
                    sendMessage();
                    e.preventDefault();
                }
            });

            moveToBottom();
        });
        $("#QueryModal").on('hide.bs.modal', function(){
            $("#QueryModal .alert").remove();
        });

    </script>
@endpush

