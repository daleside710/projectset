@extends('frontend.layouts.master')

@section('title', 'Gjør et innskudd')
@section('content')
    <div class="container my-5">
        <form action="javascript:void(0)" id="couponForm" novalidate>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card__header card_header--has-checkbox">
                            <h4>Kupongkode</h4>
                        </div>
                        <div class="card__content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="billing_first_name">Kupongkode</label>
                                        <input type="text" id="coupon_code" name="coupon_code" class="form-control"
                                                placeholder="Skriv inn kupongkode..." autocomplete="off" required>
                                        <div class="valid-feedback" style="display: block !important"></div>
                                        <div class="invalid-feedback" style="display: block !important"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button class="btn btn-primary-turquoise btn-lg btn-block" type="button"
                                            id="submitCoupon" style="margin-top: 36px;">Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Checkout Form -->
        <form action="#" class="df-checkout bootstrap-form needs-validation" novalidate>

            <div class="row">
                <div class="col-lg-6">
                    <!-- Billing Details -->
                    <div class="card">
                        <div class="card__header card__header--has-checkbox">
                            <h4>Gjør et innskudd</h4>
                        </div>
                        <div class="card__content">
                            <div class="df-billing-fields">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="billing_first_name">Beløp <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" id="amount" class="form-control"
                                                   placeholder="Skriv inn ønsket beløp..." autocomplete="off" required>
                                            <div class="valid-feedback">
                                                Ser bra ut!
                                            </div>
                                            <div class="invalid-feedback">
                                                Huff da! Minimumsinnskudd er 50 kr! :(
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Billing Details / End -->
                </div>


                <div class="col-lg-6 push-col-center">

                    <div class="card card--no-paddings">
                        <div class="card__header">
                            <h4>Betalingsmetoder</h4>
                        </div>
                        <div class="card__content">
                            <!-- Checkout Payment -->
                            <div class="df-checkout-payment">
                                <ul class="df_payment_methods" style="list-style: none" id="df_payment_methods" role="tablist"
                                    aria-multiselectable="true">

                                    <li class="df_payment_method panel">
                                        <label class="radio radio-inline" for="payment_method_basc"
                                               data-toggle="collapse" data-target="#payment_method_basc_panel"
                                               id="headingOne">
                                            <input type="radio" id="payment_method_basc" name="payment_method"
                                                   value="cheque" checked> Visa/Mastercard
                                            <span class="radio-indicator"></span>
                                        </label>
                                        <div id="payment_method_basc_panel" class="payment_box collapse show"
                                             role="tabpanel" aria-labelledby="headingOne"
                                             data-parent="#df_payment_methods">
                                            <p>Betal med VISA eller Mastercard. Her kan du betale enten med bankkort
                                                eller kredittkort.</p>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <!-- Checkout Payment / End -->

                            <div class="df-checkout-payment">
                                <div class="place-order pt-0">
                                    <input type="button" id="pay" class="btn btn-primary-turquoise btn-lg btn-block"
                                           value="Fortsett til betaling">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Checkout Form / End -->
    </div>
    </div>
@endsection
@push('script')
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        $(document).ready(function () {
            $("#amount").on('blur', function(e){
                var amount = isEmpty( $('#amount').val() ) ? 0 : parseInt( $('#amount').val() );

                if( amount >= 50 && amount <= 10000 ){
                    $('#amount')
                        .removeClass('is-invalid')
                        .addClass('is-valid');
                } else {
                    $('#amount')
                        .removeClass('is-valid')
                        .addClass('is-invalid');
                    $('div.invalid-feedback:last').html('Minimumsinnskudd er 50 kr!');
                }
            });

            function pay(amount) {
                amount = amount * 100;
                var handler = StripeCheckout.configure({
                    key: '{{ env('STRIPE_KEY') }}',
                    locale: 'no',
                    currency: 'nok',
                    token: function (token) {
                        $.ajax({
                            url: '{{ route("deposit") }}',
                            method: 'post',
                            data: {
                                _token: '{{ csrf_token() }}',
                                tokenID: token.id,
                                amount: amount
                            },
                            success: (response) => {
                                if (response.status == true) {
                                    $('#amount').val('');
                                    notify(response.message);
                                    setTimeout(() => {
                                        window.location.href = document.referrer;
                                    }, 2000);
                                } else {
                                    notify(response.message);
                                }
                            },
                            error: (error) => {
                                notify("Noe gikk galt. Følgende feilmeilding: " + error);
                            }
                        });
                    }
                });
                handler.open({
                    email: '{{ auth()->user()->email }}',
                    name: 'Lykkeboks',
                    description: 'Kjøp av digital vare.',
                    amount: amount
                });
            }

            $("#pay").click(function (e) {
                e.preventDefault();
                var amount = $('#amount').val();
                if ( !isEmpty(amount) && parseInt(amount) >= 50 && parseInt(amount) <= 10000) {
                    pay( parseInt(amount) );
                } else {
                    $("div.invalid-feedback:last").html('Vennligst skriv inn et gyldig beløp.');
                }
            });

            $("button#submitCoupon").on('click', function () {
                var coupon_code = $("#coupon_code").val();
                $("div.valid-feedback:first").html('');
                $("div.invalid-feedback:first").html('');
                $.ajax({
                    url: '{{ url('applyCouponCode') }}',
                    method: 'GET',
                    data: {coupon_code: coupon_code, type: 'deposit'},
                    dataType: 'json',
                    success: function (data) {
                        if(data.status === true){
                            $("div.valid-feedback:first").html(data.message);
                            $(".info-block__cart-sum.total-balance").html(data.balance);
                            $("#coupon_code").val('');
                        }else if(data.status === false){
                            $("div.invalid-feedback:first").html(data.message);
                        }
                    },
                    error: function (err) {
                        $("div.invalid-feedback:first").html('Noe gikk galt. Prøv på nytt senere.');
                    }
                });
            });
        });

    </script>
@endpush
