@extends('frontend.layouts.master')

@section('title', 'Den perfekte gaven for alle!')
@push('style')
    <style>
        #app {
            padding-top: 13px !important ;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row" id="searchbar">
            <div class="col-md-8 offset-md-2">
                <form action="{{route('home')}}" method="GET" name="search_form" id="search_form" enctype="multipart/form-data">
                    <div class="form-row mt-2">
                        <div class="form-group col-lg-8">
                            <input type="text" id="search" value="{{Session::has('search_name') ? Session::get('search_name') : ''}}" class="form-control" name="name" placeholder="Søk etter produkt..." title="Skriv inn et navn">
                        </div>
                        <div class="form-group col-lg-4" style="padding-left: 10px;">
                            <select name="sort_search" onchange="document.getElementById('search_form').submit();" id="sort_search" class="form-control">
                                <option value="" selected>Sorter etter</option>
                                <option value="high_price" {{Session::has('sort_search') && Session::get('sort_search') == 'high_price' ? 'selected' : ''}}>Høy pris</option>
                                <option value="low_price" {{Session::has('sort_search') && Session::get('sort_search') == 'low_price' ? 'selected' : ''}}>Lav pris</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach($boxes as $box)
                @if($box->type === 'paid')
                    <div class="col-md-4 myDIV" data-name="{{ $box->name }}">
                        <!-- Widget: Match Announcement -->
                        <aside  class="widget widget--sidebar card widget-preview ">
                            <div class="widget__title card__header">
                                <h4>{{ $box->name }}</h4>
                                <span class="price">{{ number_format($box->price) }},-</span>
                            </div>
                            <div class="widget__content card__content myDIV">
                                <div class="container-img">
                                    <img class="img" src="{{ Storage::disk('s3')->url($box->image_path) }}" style="position: relative; transform: scale(1.5); z-index: 1">
                                    <div class="img-shadow"></div>
                                </div>

                                <div class="match-preview__action match-preview__action--ticket">
                                    <a href="{{ route('box-details', [$box->id, Str::slug($box->name, '-')]) }}" class="btn btn-primary-purple btn-block">
                                        Se innhold
                                    </a>
                                </div>

                                <div class="match-preview__match-info match-preview__match-info--header">
                                    <div class="match-preview__match-place">Sist oppdatert:</div>
                                    @if ($box->updated_at == NULL)
                                        <time class="match-preview__match-time">{{ $box->created_at }}</time>
                                    @else
                                        <time class="match-preview__match-time">{{ $box->updated_at }}</time>
                                    @endif
                                </div>
                            </div>
                        </aside>
                    </div>
                @elseif($box->type === "free")
                    <div class="col-md-4 myDIV" data-name="{{ $box->name}}">

                        <aside class="widget widget--sidebar card widget-preview" style="height: 587px; border: 1px solid #f9bf35; background-color: #f9bf35">
                            <div class="widget__title" style="background: #f9bf35; padding: 17px 23px; border-radius: 4px 4px 0 0; position: relative; overflow: hidden;">
                                <h2 class="text-center" style="font-style: normal; margin-bottom: 3px; color: #fff;">
                                    {{ strtoupper($box->name) }}
                                </h2>
                                <h4 class="text-center" style="font-size: 16px; line-height: 1.2em; letter-spacing: -0.02em; margin-bottom: 0; text-transform: uppercase; font-style: normal; color: #fff;">
                                    HVER 24 TIME
                                </h4>

                                <canvas id="clock" width="80" height="50" class="float-right"
                                        style="display: none; position: absolute;right: 0; top: 0; margin-right: 10px; background: url('https://www.planwallpaper.com/static/images/96d186ef9ae1d063b50bc1d9a03af5cc--mobile-wallpaper-photo-wallpaper.jpg')"></canvas>
                            </div>
                            <div class="widget__content card__content  " style="background: #f9bf35; border-radius: 0 0 4px 4px;">
                                <div class="container-img" style="margin-top: 38px !important; margin-bottom: 57px !important;">
                                    <img class="img" src="{{ Storage::disk('s3')->url($box->image_path) }}" style="position: relative; transform: scale(1.15); z-index: 1">
                                    <div class="img-shadow"></div>
                                </div>

                                @php
                                    if(auth()->check()){
                                        $boxIsTimeCompleted = \App\Models\BoxOpen::whereBoxId($box->id)->whereIsOpened(0)->whereUserId(auth()->user()->id)->orderBy('id', 'desc')->first();
                                        $diffInMinutes = null;
                                        if($boxIsTimeCompleted){
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $boxIsTimeCompleted->created_at);
                                            $to = \Carbon\Carbon::now();
                                            $diffInMinutes = $from->diffInMinutes($to);
                                        }
                                    }
                                @endphp

                                @if(auth()->check())
                                    @if($diffInMinutes < 1440 && (isset($boxIsTimeCompleted->is_notified) && $boxIsTimeCompleted->is_notified != 1))
                                        <input type="hidden" id="created_at" value="{{ $boxIsTimeCompleted->created_at->format('Y-m-d H:i:s') }}">
                                        <div class="match-preview__action match-preview__action--ticket">
                                            <a href="{{ route('box-details', [$box->id, Str::slug($box->name, '-')]) }}" class="btn btn-yellow btn-lg btn-block">
                                                Se innhold
                                            </a>
                                            <a href="javascript:void(0)" style='color: #000; font-family: "Open Sans", sans-serif; font-weight: 900' class="btn btn-yellow btn-block">
                                                Gratis boks kan åpnes om
                                                <br>
                                                <span class="time-left"></span>
                                            </a>
                                        </div>
                                    @else
                                        @if($boxIsTimeCompleted)
                                            <div class="match-preview__action match-preview__action--ticket">
                                                <a href="{{ url('open-box/'.$box->id) }}" style='color: #000; font-family: "Open Sans", sans-serif; font-weight: 900;' class="btn btn-yellow btn-block">
                                                    Gratis boks klar til åpning
                                                </a>
                                            </div>
                                        @else
                                            <div class="match-preview__action match-preview__action--ticket">
                                                <a href="{{ url('open-box/'.$box->id) }}" style='color: #000; font-family: "Open Sans", sans-serif; font-weight: 900;' class="btn btn-yellow btn-block">
                                                    Gratis boks klar til åpning
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    <div class="match-preview__action match-preview__action--ticket">
                                        <a id="signup-user" style='color: #000; font-family: "Open Sans", sans-serif; font-weight: 900;' href="/#registerModal" class="btn btn-yellow btn-block">
                                            Registrer deg for å åpne!
                                        </a>
                                    </div>
                                @endif

                                <div class="match-preview__match-info match-preview__match-info--header">
                                    <div class="match-preview__match-place" style="color: #000">Sist oppdatert:</div>
                                    @if ($box->updated_at == NULL)
                                        <time class="match-preview__match-time" style="color: #000">{{ $box->created_at }}</time>
                                    @else
                                        <time class="match-preview__match-time" style="color: #000">{{ $box->updated_at }}</time>
                                    @endif
                                </div>
                            </div>
                        </aside>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    @if(auth()->check())
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>

        <script>
            // $(document).ready(function () {
            //     $('#sort_search').onchange(function () {
            //         $('#search_form').submit();
            //     });
            // });
            function drawClock() {
                $.ajax({
                    url: '{{url('getCurrentTime')}}',
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (response) {
                        var createdAt = moment.utc( $("#created_at").val(), "YYYY-MM-DD HH:mm:ss");
                        var now = moment.utc(response.datetime, "YYYY-MM-DD HH:mm:ss");
                        var duration = moment.utc(createdAt.diff(now)).format("HH:mm:ss");
                        var durationSeconds = moment.duration(duration).asSeconds();

                        if( parseInt( durationSeconds ) === 1 ){
                            window.location.reload();
                        }

                        if( parseInt( durationSeconds ) >= 86400 ){
                            $(".time-left").html("");
                            return true;
                        }

                        $(".time-left").html( duration );

                        /*var created_at = $("#created_at").val();
                        var c_date = new Date(created_at);
                        var now = new Date(response.datetime);

                        var hour = diff_hours(now, c_date);
                        var min = diff_minutes(now, c_date);
                        var seconds = Math.abs(Math.round((now.getTime() - c_date.getTime()) / 1000));

                        if (min >= 1440) {
                            $(".time-left").html("");
                            return true;
                        }

                        hour = 23 - hour;
                        min = 59 - (min % 60);
                        seconds = 59 - (seconds % 60);
                        hour = hour > 9 ? hour : '0' + hour;
                        min = min > 9 ? min : '0' + min;
                        seconds = seconds > 9 ? seconds : '0' + seconds;
                        $(".time-left").html(hour + ":" + min + ':' + seconds);*/
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
            /*function diff_minutes(dt2, dt1) {
                var diff = (dt2.getTime() - dt1.getTime()) / 1000;
                diff /= 60;
                return Math.abs(Math.round(diff));
            }
            function diff_hours(dt2, dt1) {
                var diff = (dt2.getTime() - dt1.getTime()) / 1000;
                diff /= (60 * 60);
                return Math.abs(Math.round(diff));
            }*/
            setInterval(drawClock, 1000);
        </script>
    @endif

@endsection

@push('style')
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script src="{{ asset('OneSignalSDKWorker.js') }}"></script>
    <script src="{{ asset('OneSignalSDKUpdaterWorker.js') }}"></script>

    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function () {
            OneSignal.init({
                appId: "5830efa6-6970-41f0-8212-3bcdf9f9f939"
            });
        });
    </script>
@endpush

@push('script')
    <script>
        var value_input = $("#search").val();
        if(value_input!=null) {
            $(document).ready(function () {
                $("#search").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    /*$(".myDIV aside").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });*/
                    $(".col-md-4.myDIV").filter(function () {
                        $(this).toggle($(this).data('name').toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        }
        
        $(document).ready(function () {
            $('#search').keydown(function(e){
                if(e.which==13){
                    $('#search_form').submit()
                }
            });
        });
        
        OneSignal.push(function () {
            var isPushSupported = OneSignal.isPushNotificationsSupported();
            if (isPushSupported) {
                OneSignal.isPushNotificationsEnabled( function(isEnabled) {
                    if (isEnabled) {
                        OneSignal.getUserId(function (userId) {
                            var _token = $("meta[name=csrf-token]").attr('value');
                            $.ajax({
                                url: '{{ url('update-user-push-id') }}',
                                method: 'POST',
                                data: {_token: _token, userId: userId},
                                dataType: 'json',
                                success:function(response){},
                                err: function (err) {}
                            });
                        });
                    } else {
                        OneSignal.push(function () {
                            OneSignal.showNativePrompt();
                        });
                    }
                });
            } else {}
        });
    </script>
@endpush
