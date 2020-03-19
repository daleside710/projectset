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
                                       style="position:absolute;top:118px;height:64px;"
                                       class="mouse-hover">
                            </div>
                            <img id="boxId" src="https://lykkeboks.s3.eu-north-1.amazonaws.com/images/box-opening/box.png">
                            <img id="animation" src="https://lykkeboks.s3.eu-north-1.amazonaws.com/images/box-opening/cut-box.gif" style="display: none">
                            <img id="opening" src="https://lykkeboks.s3.eu-north-1.amazonaws.com/images/box-opening/unfold-box.gif" style="display: none">
                        </div>
                    </section>
                </div>
                <div class="col-md-4 text-center">
                </div>
                <div class="col-md-10" id="products">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title d-md-flex justify-content-between">
                                Produkter nylig vunnet
                                <button class="btn btn-success btn-pulse btn-sm mt-2mt-md-0 mt-md-0 order-2" id="openBox">
                                    Åpne ny boks
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
                appId: "bb73d5e6-daa8-4364-bef6-7221865bbf67"
            });
        });
    </script>
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.16.0/prism.min.js"></script>
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

        // Create NOK currency formatter
        var formatter = new Intl.NumberFormat('NO', {
            style: 'decimal',
            currency: 'NOK',
            minimumFractionDigits: 2
        });

        $('#animation').hide();
        var animation = true;
        var balance = {!! json_encode($user_balance) !!},
            balanceStatus = balance['original'].status;
        
        $(document).on('mousemove touchmove', '#rangeId', function () {
            /**
             * Defines the undeclared box opening variables
             */
            var rangePercent = $('[type="range"]').val();

            /**
             * Check if user has insufficient balance
             */
            if (balanceStatus === false && parseInt(rangePercent) >= 35) {
                $('#rangeId').remove();
                $('#bar').append(
                    '<input type="range" id="rangeId" step="1" value="0"' +
                    'style="position: absolute; top: 118px; height: 64px;" class="mouse-hover">'
                );
                // Notify if user balance is insufficient
                notify(balance['original'].message);
            }

            /**
             * Continue with box opening if user balance is sufficient
             */
            if (balanceStatus !== false && parseInt(rangePercent) === 100) {
                animation = false;
                rangePercent = $('[type="range"]').val(0);

                $('#rangeId').remove();
                $('#boxId').attr('style', 'display: none');
                $('#openBox').attr('disabled', true);

                /**
                 * Call the box opening function
                 */
                $('#opening').attr('style', 'display: block').delay(900).fadeOut(500, function(){
                    spin();
                });
            }
        }); 

        $(document).ready(function () {
            $('#openBox, #submitCoupon').click(function () {
                $.ajax({
                    url: 'checkBalance',
                    method: 'POST',
                    data: {
                        boxID: $('#boxID').val(),
                        _token: $('input[name=_token]').val()
                    },
                    success: function (response) {
                        if (response.status == true) {
                            if (animation == true) {
                                // Initialize animation
                                $('#boxId').attr('style', 'display: none');
                                $('#rangeId').remove();

                                $('#animation').attr('style', 'display: block').delay(2500).fadeOut(500, function(){
                                    spin();
                                });

                                // Disable animation
                                animation = false;
                            } else {
                                // Get url of image path and retrieve last segment
                                var imagePath = 'https://lykkeboks.s3.eu-north-1.amazonaws.com/images';

                                $('#app').attr('style', 'background-image: unset; background-size: unset');
                                $('#boxId').attr({
                                    src: imagePath + '/box-opening/box.png',
                                    style: 'width: unset; height: unset; animation: unset; margin: unset'
                                });
                                $("#bar").append(
                                    '<input type="range" id="rangeId" step="1" value="0"' +
                                    'style="position: absolute; top: 118px; height: 64px" class="mouse-hover">'
                                );

                                animation = true;
                            }
                        } else {
                            notify(response.message);
                        }
                    },
                    error: function (error) {
                        notify(error);
                    }
                });
            });
        });

        function spin() {
            //$('#openBox').attr('disabled', true);

            var coupon_code = $("input[name=coupon_code]").val();

            if (coupon_code === "") {
                $.ajax({
                    url: 'spin',
                    method: 'POST',
                    data: {
                        boxID: $("#boxID").val(),
                        _token: $("input[name=_token]").val()
                    },
                    success: function (response) {
                        if (response.status == true) {
                            $(".d-inline-block.total-balance").html(formatter.format(response.data.balance) + ' kr');
                            $('#openBox').attr('disabled', false);

                            var boxProducts ={!! json_encode($boxProducts); !!};
                            for (var i in boxProducts) {
                                if (boxProducts[i].product_id == response.data.result.product_id) {
                                    console.log(response.data.result.product_id);
                                    $('#animation').attr('style', 'display: none')

                                    // Get url of image path and retrieve last segment
                                    var imagePath = 'https://lykkeboks.s3.eu-north-1.amazonaws.com/images';
                                    var lastSegment = boxProducts[i].image_path.split('/').pop();

                                    $("#boxId").fadeOut(100, function () {
                                        $('#app').attr(
                                            'style', 'background-image: url(' + imagePath + '/box-opening/fireworks.gif); background-size: contain'
                                        );
                                        $('#boxId').attr({
                                            src: imagePath + '/products/' + lastSegment,
                                            style: 'width: 320px; animation: hover 1.5s ease-in-out infinite alternate; margin: 20px 0'
                                        });
                                        $('#openBox').show();
                                    }).fadeIn(100, function(){
                                        updateProducts();

                                        $.ajax({
                                            url: 'checkBalance',
                                            method: 'POST',
                                            data: {
                                                boxID: $('#boxID').val(),
                                                _token: $('input[name=_token]').val()
                                            },
                                            success: function (response) {
                                                if (response.status == true) {
                                                    balanceStatus = true;
                                                } else {
                                                    balanceStatus = false;
                                                }
                                            },
                                            error: function (error) {
                                                notify(error);
                                            }
                                        });
                                    });
                                    
                                    return false;
                                }
                            }
                        } else {
                            notify(response.message); 
                        }
                    },
                    error: function (error) {
                        notify(error);
                    }
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
                            $.ajax({
                                url: 'spin',
                                method: 'POST',
                                data: {
                                    boxID: $("#boxID").val(),
                                    coupon_code: coupon_code,
                                    _token: $("input[name=_token]").val()
                                },
                                success: function (data) {
                                    if (data.status == true) {
                                        $(".d-inline-block.total-balance").html(formatter.format(data.data.balance) + ' kr');
                                        $('#openBox').attr('disabled', false);

                                        var boxProducts ={!! json_encode($boxProducts); !!};
                                        for (var i in boxProducts) {
                                            if (boxProducts[i].product_id == data.data.result.product_id) {
                                                $('#animation').attr('style', 'display: none')

                                                // Get url of image path and retrieve last segment
                                                var imagePath = 'https://lykkeboks.s3.eu-north-1.amazonaws.com/images';
                                                var lastSegment = boxProducts[i].image_path.split('/').pop();

                                                $("#boxId").fadeOut(100, function () {
                                                    $('#app').attr(
                                                        'style', 'background-image: url(' + imagePath + '/box-opening/fireworks.gif); background-size: contain'
                                                    );
                                                    $('#boxId').attr({
                                                        src: imagePath + '/products/' + lastSegment,
                                                        style: 'width: 320px; animation: hover 1.5s ease-in-out infinite alternate; margin: 20px 0'
                                                    });
                                                    $('#openBox').show();
                                                }).fadeIn(100);
                                                
                                                return false;
                                            }
                                        }
                                    } else {
                                        notify(data.message);
                                    }
                                },
                                error: function (error) {
                                    notify(error);
                                }
                            });
                        } else if (response.status === false) {
                            notify(response.message);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        notify('Noe gikk galt. Prøv på nytt senere.');
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
                                    $(".d-inline-block.total-balance").html(formatter.format(response.data.balance) + ' kr');
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
    </script>
@endpush
