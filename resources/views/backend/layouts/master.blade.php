<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title') - Lykkeboks Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" value="{{ csrf_token() }}">

        @if(array_key_exists(Route::current()->getName(), config()->get('meta')))
            @foreach(config()->get('meta')[Route::current()->getName()] as $name => $content)
                <meta name="{{ $name }}" value="{{ $content }}">
            @endforeach
        @endif

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style.css') }}">
        @stack('style')

        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
        <script src="{{ asset('OneSignalSDKUpdaterWorker.js') }}"></script>
        <script src="{{ asset('OneSignalSDKWorker.js') }}"></script>
        <script>
            var OneSignal = window.OneSignal || [];
            OneSignal.push(function () {
                OneSignal.init({
                    appId: "bb73d5e6-daa8-4364-bef6-7221865bbf67",
                });
            });
        </script>
    </head>
    <body class="dark">

    <!-- Include navigation -->
    @include('backend.layouts.partials.navigation')

    <div id="main">

    <!-- Include header -->
    @include('backend.layouts.partials.header')

      <!-- begin::main content -->
      <main class="main-content">
        @yield('content')
      </main>
      <!-- end::main content -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-migrate@3.0.1/dist/jquery-migrate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.nicescroll@3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script src="{{ asset('backend/js/main.js') }}"></script>
    @if(\Request::route()->getName() === 'redeem')
      <script type="text/javascript">
          OneSignal.push(function () {
              /* These examples are all valid */
              var isPushSupported = OneSignal.isPushNotificationsSupported();
              if (isPushSupported) {
                  console.log('Supported');
                  OneSignal.isPushNotificationsEnabled(function (isEnabled) {
                      if (isEnabled) {
                          console.log("Push notifications are enabled!");
                          OneSignal.getUserId(function (userId) {
                              console.log(userId);
                              var _token = $("meta[name=csrf-token]").attr('value');
                              $.ajax({
                                  url: '{{ url('update-user-push-id') }}',
                                  method: 'POST',
                                  data: {_token: _token, userId: userId},
                                  dataType: 'json',
                                  success:function(response){
                                      console.log(response);
                                  },
                                  err: function (err) {
                                      console.log(err);
                                  }
                              });
                          });
                      } else {
                          OneSignal.push(function () {
                              OneSignal.showNativePrompt();
                          });
                          console.log("Push notifications are not enabled yet.");
                      }
                  });
                  // Push notifications are supported
              } else {
                  console.log('Not Supported');
                  // Push notifications are not supported
              }
          });
      </script>
    @endif
    @stack('script')
    </body>
</html>