@extends('backend.layouts.master')
@section('title','Endre ofte stilte spørsmål')
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
            background-color: white;
            padding: 8px 5px;
            border-radius: 4px;

        }
        .query_box .sender_info{
            color: #e83e8c;
        }
        .query_box a,.dropdown-item:focus, .dropdown-item:hover{
            color:#1e202f;
        }
        .query_box a:hover{
            text-decoration: underline;
        }

        .status_box{
            text-align: right;
        }
        .status{
            border-radius: 15px;
            width: 70px;
            display: inline-block;
            text-align: center;
            padding: 3px 0;
        }
        .btn_status{
            padding: 0px 4px;
            color: #1e202f;
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
        .btn_status i{
            font-size: 18px;
        }
        .btn_status:hover,btn_status:focus{
            color: #1e202f;
        }
        .create_new{
            margin-bottom: 10px;
        }
        .sender_info{
            line-height: 16px;
        }
        a.query_message{
            color: #000 !important;
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
            color: white;}
        </style>
    @endpush

@section('content')
    <div class="container" id="app">
        <h3 class=" text-center">Queries</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="mesgs">
                    @if(count($queries) > 0)
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
                                        <a href="{{route('admin.chat',$querie->id)}}" class="query_message">{{$querie->message}}
                                            @if(isset($querie->count_unread) && $querie->count_unread > 0)
                                                <div class="new_msg"><span>New</span></div>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="status_box col-lg-3">
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
                                <span class="time_date">{{ $querie->created_at }}</span>
                            </div>
                        @endforeach
                    @else
                     <h4 style="margin-top: 90px; text-align: center;">Queries not found!</h4>
                    @endif
                </div>
                {{$queries->links()}}
            </div>

        </div>
    </div>
    <form action="{{ route('admin.changeStatus') }}" id="statusForm" method="POST">
        @csrf
        <input type="hidden" name="chat_querie" id="chat_querie" value="{{$querie->id}}">
        <input type="hidden" name="querie_status" id="querie_status">
    </form>
    <meta name="sendMessage" content="{{route('admin.sendQuery')}}">
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="loggedInUser" content="{{Auth::user()}}">

@endsection
@push('script')
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>

    <script>
        var messages=[];
        var renderHtml='';
        var messageBox=$('.mesgs');
        var messageInput=$('#modal_query');
        var loggedInUser = JSON.parse($('meta[name=loggedInUser]').attr('content'));

        function moveToBottom(){
            var div = $('.mesgs');
            height = div.height();
            div.animate({scrollTop: 5000}, 500);
        }

        function userMessage(data){
            var EventData=JSON.parse(data.message);
            if(EventData.type == 'user')
            {
                var d = new Date();
                var now = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate()+' '+d.getHours() + ":" + (d.getMinutes()) + ":" + d.getSeconds();
                jQuery('.mesgs').prepend(
                    '<div class="box_msg col-lg-12">\n'+
                    '<div class="query_box row">\n'+
                    '<div class="col-lg-3">\n'+
                    '<div class="sender_info">\n'+
                    '<i class="fa fa-user"></i> '+ EventData.sender_name +'<br>\n'+
                    '<i class="fas fa-envelope"></i> '+ EventData.sender_email +
                    '</div>\n'+
                    '</div>\n'+
                    '<div class="col-lg-6">\n' +
                    '<a href="'+EventData.query_url+'" class="query_message">'+ EventData.messages +'</a></div>\n'+
                    '<div class="status_box col-lg-3">\n'+
                    '<span class="status pending">\n'+
                    EventData.status +
                    '</span>\n'+
                    '<div class="btn-group">\n'+
                    '<button type="button" class="btn btn_status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n'+
                    '<i class="fas fa-edit"></i>\n'+
                    '</button>\n'+
                    '<div class="dropdown-menu">\n'+
                    '<a class="dropdown-item" href="javascript:void(0)" onclick="changeStatus('+EventData.querie_id+',"active")">Active</a>\n'+
                    '<a class="dropdown-item" href="javascript:void(0)" onclick="changeStatus('+EventData.querie_id+',"closed")">Closed</a>\n'+
                    '</div>\n'+
                    '</div>\n'+
                    '</div>\n'+
                    '</div>\n'+
                    '<span class="time_date">'+ now +'</span>\n'+
                    '</div>');
                moveToBottom();
            }
        }

        function changeStatus(querie,status){
            $('#chat_querie').val(querie);
            $('#querie_status').val(status);
            $('#statusForm').submit();
        }
        function closedstatus(data){
            var EventData=JSON.parse(data.message);
            console.log(EventData);
            if(EventData.type == 'user')
            {
                var status= $('#querie_'+EventData.querie_id +' .status');
                status.removeClass('active');
                status.removeClass('pending');
                status.removeClass('closed');
                status.text(EventData.status);
                status.addClass(EventData.status);

            }
        }

        // pusher js script
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;
        var pusher = new Pusher('375bbae2be23e1ec898f', {
            cluster: 'ap2',
            forceTLS: true
        });
        var channel = pusher.subscribe('QueryChannel');
        channel.bind('QueryEvent', function(data) {
            userMessage(data);
            // console.log(data);
        });

        var channel2 = pusher.subscribe('ClosedChannel');
        channel2.bind('ClosedEvent', function(data) {
            closedstatus(data);
        });
        // end pusher js script

        $(document).ready(function () {
            moveToBottom();
        });

    </script>
@endpush

