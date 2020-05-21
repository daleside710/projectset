@extends('frontend.layouts.master')

@section('title', 'Min side')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card__content">
                    <nav class="df-account-navigation">
                        <ul class="nav nav-pills">
                            <li class="df-account-navigation__link">
                                <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                    <small>Min konto</small>Kontoinformasjon
                                </a>
                            </li>
                            <li class="df-account-navigation__link">
                                <a id="items-tab" data-toggle="tab" href="#items" role="tab" aria-controls="items" aria-selected="false">
                                    <small>Min konto</small>Produkter
                                </a>
                            </li>
                            <li class="df-account-navigation__link">
                                <a id="shipments-tab" data-toggle="tab" href="#shipments" role="tab" aria-controls="shipments" aria-selected="false">
                                    <small>Min konto</small>Bestillinger
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @include('frontend.pages.account.partials.profile-tab')
                </div>
                <div class="tab-pane fade" id="items" role="tabpanel" aria-labelledby="items-tab">
                    @include('frontend.pages.account.partials.items-tab')
                </div>
                <div class="tab-pane fade" id="shipments" role="tabpanel" aria-labelledby="shipments-tab">
                    @include('frontend.pages.account.partials.shipments-tab')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function(){
            var hash = window.location.hash;
            if (!hash) {
                $('#profile-tab').parent().addClass('active');
            } else {
                $('li a[href="' + hash + '"]').click();
            }

            $('li a').click(function (e) {
                window.location.hash = this.hash;
            });

            // Create NOK currency formatter
            var formatter = new Intl.NumberFormat('NO', {
                style: 'decimal',
                currency: 'NOK',
            });

            $(".sellBackBTN").click(function(e) {
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
                            $(".info-block__cart-sum.total-balance").html(formatter.format(response.data.balance));
                            $(elm).parent().parent().remove();
                            notify('Produkt har blitt solgt.');
                        } else {
                            notify(response.message);
                        }
                    }
                });
            });

            function setActiveLinks() {
                var current = location.pathname;
                $('ul li a').each(function() {
                    var $this = $(this);
                    var $hash = location.href.substr(location.href.indexOf('#') + 1);

                    if ($this.attr('href') == '#' + $hash) $this.parent().addClass('active');
                })
            }

            setActiveLinks();

            $('ul li a').click(function() {
                $('ul li').removeClass('active');
                $(this).parent().addClass('active');
            });
        });
    </script>
@endpush
