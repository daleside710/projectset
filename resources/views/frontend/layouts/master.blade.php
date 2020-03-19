<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lykkeboks — @yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
        <meta name="csrf-token" value="{{ csrf_token() }}">

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

        <!-- Include widgets -->
        @include('frontend.layouts.partials.widgets')
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
    <script src="{{ asset('frontend/js/validator.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    @stack('script')
    </body>
</html>
