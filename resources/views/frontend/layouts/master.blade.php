<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lykkeboks — @yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
        <meta name="csrf-token" value="{{ csrf_token() }}">

        @if(\Request::route()->getName() == 'chat')
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
        @endif
        @if(array_key_exists(Route::current()->getName(), config()->get('meta')))
            @foreach(config()->get('meta')[Route::current()->getName()] as $name => $content)
                <meta name="{{ $name }}" value="{{ $content }}">
            @endforeach
        @endif

        <link rel="shortcut icon" href="https://lykkeboks.s3.eu-north-1.amazonaws.com/images/static/favicon.png" type="image/x-icon">
        <link rel="icon" href="https://lykkeboks.s3.eu-north-1.amazonaws.com/images/static/favicon.png" type="image/x-icon">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Exo+2:400,700,700i,800|Roboto:400,400i">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
            integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/css/intlTelInput.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}">
        @stack('style')
    </head>
    <body>
    <div class="site-wrapper clearfix">
        <div class="site-overlay"></div>

        <!-- Include POST modals -->
        @if(!Auth::user())
            @include('frontend.layouts.partials.modals')
        @endif

        <!-- Include header and navigation -->
        @include('frontend.layouts.partials.header')

        <!-- Include breadcrumb -->
        @if(\Request::route()->getName() !== 'redeem')
            @include('frontend.layouts.partials.breadcrumb')
        @endif

        <div id="app" class="py-5">
            <!-- Include alerts -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @include('frontend.layouts.partials.alerts')
                    </div>
                </div>
            </div>

            <!-- Include content -->
            @yield('content')
        </div>

        <!-- Include footer -->
        @include('frontend.layouts.partials.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-migrate@3.0.1/dist/jquery-migrate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/svg4everybody@2.1.9/dist/svg4everybody.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-countdown@2.2.0/dist/jquery.countdown.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/instafeed.js/1.4.1/instafeed.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.marquee@1.5.0/jquery.marquee.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/js/intlTelInput-jquery.min.js"></script>
    <script src="{{ asset('jquery-cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('global.js') }}"></script>
    <script src="{{ asset('frontend/js/validator.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    <script>
        window.intercomSettings = {
            app_id: "w763h8lj"
        };
    </script>
    <script>
        // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/w763h8lj'
        (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/w763h8lj';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
    </script>
    @if(\Request::route()->getName() == 'chat')
        <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    @endif
    @stack('script')
    @yield('page_js')
    </body>
</html>
