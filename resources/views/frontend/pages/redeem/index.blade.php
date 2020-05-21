@extends('frontend.layouts.master')
@section('title', 'Redeem & Win')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend/css/style1.css') }}">
    <style>
        .mouse-hover {
            cursor: url('https://lykkeboks.s3.eu-north-1.amazonaws.com/images/box-opening/knife.png') 5 50, auto;
        }
        .hide {
            position: absolute;
            left: -10000px;
        }
    </style>

    <div>
        <input type="hidden" id="boxID" value="{{ $boxID }}">

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <section class="above-fold">
                        <div class="text-center pb-5" id="wrap-present">
                            <div id="bar">
                                <input type="range" id="rangeId" step="1" value="0"
                                       style="position:absolute; top:118px; height:64px;"
                                       class="mouse-hover">
                            </div>
                            <img id="boxId" src="https://lykkeboks.s3.eu-north-1.amazonaws.com/images/box-opening/box.png" style="display: inline-block;">
                            <img id="animation" src="https://lykkeboks.s3.eu-north-1.amazonaws.com/images/box-opening/cut-box.gif" style="display: none">
                            <img id="opening" src="https://lykkeboks.s3.eu-north-1.amazonaws.com/images/box-opening/unfold-box.gif" style="display: none">
                        </div>
                    </section>
                </div>

                <div class="col-md-10" id="products">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title d-md-flex justify-content-between">
                                Produkter nylig vunnet
                                <button class="btn btn-success btn-pulse btn-sm mt-2mt-md-0 mt-md-0 order-2" id="openBox">
                                    Åpne boks automatisk
                                </button>
                                <div class="d-flex justify-content-between" id="couponWrapper">
                                    <input class="form-control" type="text" id="coupon_code" name="coupon_code" placeholder="Skriv inn kupongkode..." required>
                                    <button class="btn btn-purple btn-sm ml-1" type="button" id="submitCoupon">Sjekk</button>
                                </div>
                            </h6>
                            <div id="wonedProducts" style="overflow: auto; max-height: 25em;" class="col-12 mt-1">
                                @include('frontend.pages.redeem.items')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/spinner.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/prismjs@1.16.0/themes/prism.css">

    <style type="text/css">
        #wonedProducts table tbody {
            overflow-y: auto;
            height: 100px;
        }
    </style>

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
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.16.0/prism.min.js"></script>
    <script src="{{ asset('global.js') }}"></script>

    <script type="text/javascript">
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

        // Create NOK currency formatter
        var formatter = new Intl.NumberFormat('NO', {
            style: 'decimal',
            currency: 'NOK',
            minimumFractionDigits: 2
        });

        var balance = {!! json_encode($user_balance) !!},
            balanceStatus = balance['original'].status;

        var animation = true;
        var isLocked = false;
        var isInitialized = true;
        var imagePath = 'https://lykkeboks.s3.eu-north-1.amazonaws.com/images';

        function initialize(){

            $('#app').css({
                'background-image': 'unset',
                'background-size': 'unset'
            });

            $('#boxId').removeAttr('src')
                .attr('src', imagePath + '/box-opening/box.png')
                .css({
                    'display': 'inline-block',
                    'width': 'unset',
                    'height': 'unset',
                    'margin': 'unset',
                    'animation': 'unset'
                });

            $('#animation').removeAttr('src')
                .css({
                    'display': 'none',
                    'visibility': 'visible',
                    'opacity': 1
                });

            $('#opening').removeAttr('src')
                .css({
                    'display': 'none',
                    'visibility': 'visible',
                    'opacity': 1
                });

            $('#bar').html(`<input type="range" id="rangeId" step="1" value="0"
                            style="position: absolute; top: 118px; height: 64px"
                            class="mouse-hover">`);

            isInitialized = true;
        }

        function spin( isAutoOpen = true ) {
            var coupon_code = $("#coupon_code").val();

            if ( isEmpty( coupon_code ) ) {
                isInitialized = false;

                $('#boxId').css('display', 'none');
                $('#rangeId').val(0)
                    .remove();

                var selector = '#animation';
                var delayTime = 2500;
                var selectorImg = imagePath + '/box-opening/cut-box.gif';

                if( !isAutoOpen ) {
                    selector = '#opening';
                    delayTime = 850;
                    selectorImg = imagePath + '/box-opening/unfold-box.gif';
                }

                $( selector ).removeAttr('src');

                $( selector ).css('display', 'block')
                    .attr('src', selectorImg)
                    .delay( delayTime )
                    .fadeTo(500, 0, function(){
                        $( selector ).css("visibility", "hidden");

                        $.ajax({
                            url: 'spin',
                            method: 'POST',
                            data: {
                                boxID: $("#boxID").val(),
                                _token: $("input[name=_token]").val()
                            },
                            success: function (response) {
                                if ( response.status === true ){

                                    $(".d-inline-block.total-balance").html( response.data.balance + ' kr' );

                                    var boxProducts = {!! json_encode($boxProducts) !!};
                                    for( var i = 0; i < boxProducts.length; i ++ ){

                                        if( parseInt( boxProducts[i].product_id) === parseInt( response.data.result.product_id ) ){
                                            var lastSegment = boxProducts[i].image_path.split('/').pop();

                                            $('#app').css({
                                                'background-image': 'url(' + imagePath + '/box-opening/fireworks.gif)',
                                                'background-size': 'contain'
                                            });

                                            $('#boxId').attr('src', imagePath + '/products/' + lastSegment )
                                                .css({
                                                    'display': 'inline-block',
                                                    'width': '320px',
                                                    'margin': '20px 0',
                                                    'animation': 'hover 1.5s ease-in-out infinite alternate'
                                                });

                                            $( selector ).css('display', 'none');

                                            updateProducts();

                                            $.ajax({
                                                url: 'checkBalance',
                                                method: 'POST',
                                                data: {
                                                    boxID: $('#boxID').val(),
                                                    _token: $('input[name=_token]').val()
                                                },
                                                success: function (response) {
                                                    if (response.status === true) {
                                                        balanceStatus = true;
                                                    } else {
                                                        balanceStatus = false;
                                                    }

                                                    isLocked = false;
                                                },
                                                error: function (error) {
                                                    notify(error);
                                                    isLocked = false;
                                                }
                                            });
                                        }
                                    }
                                } else {
                                    notify(response.message);
                                    isLocked = false;
                                }
                            },
                            error: function (error) {
                                notify(error);
                                isLocked = false;
                            }
                        });

                    });

            } else {
                $.ajax({
                    url: 'checkDiscountedCoupon',
                    method: 'POST',
                    data: {
                        boxID: $("#boxID").val(),
                        coupon_code: coupon_code,
                        _token: $("input[name=_token]").val()
                    },
                    success: function (response) {
                        if (response.status === true) {
                            isInitialized = false;

                            $('#boxId').css('display', 'none');
                            $('#rangeId').val(0)
                                .remove();

                            var selector = '#animation';
                            var delayTime = 2500;
                            var selectorImg = imagePath + '/box-opening/cut-box.gif';

                            if( !isAutoOpen ) {
                                selector = '#opening';
                                delayTime = 850;
                                selectorImg = imagePath + '/box-opening/unfold-box.gif';
                            }

                            $( selector ).removeAttr('src');

                            $( selector ).css('display', 'block')
                                .attr('src', selectorImg)
                                .delay( delayTime )
                                .fadeTo(500, 0, function(){
                                    $( selector ).css("visibility", "hidden");

                                    $.ajax({
                                        url: 'spin',
                                        method: 'POST',
                                        data: {
                                            boxID: $("#boxID").val(),
                                            coupon_code: coupon_code,
                                            _token: $("input[name=_token]").val()
                                        },
                                        success: function (response) {
                                            if ( response.status === true ){

                                                $(".d-inline-block.total-balance").html( response.data.balance + ' kr' );

                                                var boxProducts = {!! json_encode($boxProducts) !!};
                                                for( var i = 0; i < boxProducts.length; i ++ ){

                                                    if( parseInt( boxProducts[i].product_id) === parseInt( response.data.result.product_id ) ){
                                                        var lastSegment = boxProducts[i].image_path.split('/').pop();

                                                        $('#app').css({
                                                            'background-image': 'url(' + imagePath + '/box-opening/fireworks.gif)',
                                                            'background-size': 'contain'
                                                        });

                                                        $('#boxId').attr('src', imagePath + '/products/' + lastSegment )
                                                            .css({
                                                                'display': 'inline-block',
                                                                'width': '320px',
                                                                'margin': '20px 0',
                                                                'animation': 'hover 1.5s ease-in-out infinite alternate'
                                                            });

                                                        $( selector ).css('display', 'none');

                                                        updateProducts();

                                                        $.ajax({
                                                            url: 'checkBalance',
                                                            method: 'POST',
                                                            data: {
                                                                boxID: $('#boxID').val(),
                                                                _token: $('input[name=_token]').val()
                                                            },
                                                            success: function (response) {
                                                                if (response.status === true) {
                                                                    balanceStatus = true;
                                                                } else {
                                                                    balanceStatus = false;
                                                                }

                                                                isLocked = false;
                                                            },
                                                            error: function (error) {
                                                                notify(error);
                                                                isLocked = false;
                                                            }
                                                        });
                                                    }
                                                }
                                            } else {
                                                notify(response.message);
                                                isLocked = false;
                                            }
                                        },
                                        error: function (error) {
                                            notify(error);
                                            isLocked = false;
                                        }
                                    });
                                });

                        } else if (response.status === false) {
                            notify(response.message);
                            isLocked = false;
                        }
                    },
                    error: function (err) {
                        notify('Noe gikk galt. Prøv på nytt senere.');
                        isLocked = false;
                    }
                });
            }
        }

        function updateProducts() {
            $.ajax({
                url: '{{route('loadItem')}}',
                method: 'POST',
                data: {
                    _token: $("input[name=_token]").val()
                },
            }).done(function (data) {
                $("#wonedProducts").html(data.html)

                
                if ($("#wonedProducts").html(data.html)) {
                    $('.sellBackBTN').click(function(e) {
                        e.preventDefault();
                        var elm = this;
                        $.ajax({
                            url: "{{ route('sellBack') }}",
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                productID: $(this).attr('data-id'),
                                _token: '{{ csrf_token() }}'
                            },
                            "success": function (response) {
                                if (response.status == true) {
                                    $(".d-inline-block.total-balance").html(response.data.balance + ' kr');
                                    $(elm).parent().parent().remove();
                                    notify('Produkt har blitt solgt.');
                                } else {
                                    notify(response.message);
                                }
                            }
                        });
                    });
                }
                

            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                notify('Serveren er for øyeblikket utilgjengelig...');
            });
        }

        $(document).ready(function () {

            $('#openBox, #submitCoupon').click(function () {
                if( !isLocked ){
                    if( !isInitialized ){
                        initialize();
                    } else {
                        isLocked = true;

                        $.ajax({
                            url: 'checkBalance',
                            method: 'POST',
                            data: {
                                boxID: $('#boxID').val(),
                                _token: $('input[name=_token]').val()
                            },
                            success: function (response) {
                                if (response.status === true) {
                                    spin( true );
                                } else {
                                    notify(response.message);
                                    isLocked = false;
                                }
                            },
                            error: function (error) {
                                notify(error);
                                isLocked = false;
                            }
                        });
                    }
                }
            });

            $('.sellBackBTN').click(function(e) {
                e.preventDefault();
                var elm = this;
                $.ajax({
                    url: "{{ route('sellBack') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        productID: $(this).attr('data-id'),
                        _token: '{{ csrf_token() }}'
                    },
                    "success": function (response) {
                        if (response.status == true) {
                            $(".d-inline-block.total-balance").html(response.data.balance + ' kr');
                            $(elm).parent().parent().remove();
                            notify('Produkt har blitt solgt.');
                        } else {
                            notify(response.message);
                        }
                    }
                });
            });
        });

        $(document).on('mousemove touchmove', '#rangeId', function () {
            // Get Range Percent
            var rangePercent = parseInt( $('#rangeId').val() );

            // Check if user has insufficient balance
            if( balanceStatus === false && rangePercent > 33) {
                $('#rangeId').animate({ value: 0}, 'fast', function(){
                    notify(balance['original'].message);
                    initialize();
                });
            }

            // Continue with box opening if user balance is sufficient
            if (balanceStatus === true && rangePercent === 100) {
                animation = false;
                spin( false );
            }
        });

    </script>
@endpush
