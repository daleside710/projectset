<!-- Header Mobile -->
<div class="header-mobile clearfix" id="header-mobile">
    <div class="header-mobile__logo">
        <span class="main-nav__back"></span>
        <a href="{{ route('home') }}">
            <img src="{{ asset('logo.svg') }}" alt="Lykkeboks logo" class="header-mobile__logo-img">
        </a>
    </div>
    <div class="header-mobile__inner">
        <a id="header-mobile__toggle" class="burger-menu-icon"><span class="burger-menu-icon__line"></span></a>
    </div>
</div>
<!-- Header Mobile / End -->

<!-- Header Desktop -->
<header class="header header--layout-3">

    <!-- Header Top Bar -->
    <div class="header__top-bar clearfix">
        <div class="container">
            <div class="header__top-bar-inner">

                <!-- Social Links -->
                <ul class="social-links social-links--inline social-links--main-nav social-links--top-bar">
                    <li class="social-links__item">
                        <a href="https://www.facebook.com/Lykkeboks-113343623482456/" class="social-links__link" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facebook">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                    </li>
                    <!--
                    <li class="social-links__item">
                        <a href="#" class="social-links__link" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    -->
                </ul>
                <!-- Social Links / End -->

                <!-- Account Navigation -->
                <ul class="nav-account">

                    @auth
                    @if(Auth::user()->type === 1)

                    <li class="nav-account__item">
                        <a>Velkommen tilbake, <span class="highlight">{{ Auth::user()->name }}</span></a>
                    </li>
                    <li class="main-nav__item--shopping-cart">
                        <a href="#" class="info-block__link-wrapper">
                            <h6 class="info-block__heading">Lommebok</h6>
                            <span class="info-block__cart-sum total-balance" id="balance">
                                {{ number_format(auth()->user()->balanceFloat, 2, ',', ' ') }} kr
                            </span>
                        </a>
                    </li>
                    <li class="nav-account__item">
                        <a href="#" title="Fullscreen" data-toggle="fullscreen">
                            <i class="maximize" data-feather="maximize"></i>
                            <i class="minimize" data-feather="minimize"></i>
                        </a>
                    </li>
                    <li class="nav-account__item main-nav__sub-title">
                        <figure style="margin: 0; padding: 3px 0;">
                            <img class="rounded-circle w-35 h-35" src="{{ Storage::disk('s3')->url(auth()->user()->image_path ?? 'images/avatars/default.png') }}">
                        </figure>
                        <ul class="main-nav__sub">
                            <li><a href="{{ route('account') }}">Min konto</a></li>
                            <li><a href="{{ route('deposit') }}">Gjør et innskudd</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    <button class="nav-account__item--logout">Logg ut</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    @else

                    <li class="nav-account__item">
                        <a>Velkommen tilbake, <span class="highlight">{{ Auth::user()->name }}</span></a>
                    </li>
                    <li class="main-nav__item--shopping-cart">
                        <a href="#" class="info-block__link-wrapper">
                            <h6 class="info-block__heading">Lommebok</h6>
                            <span class="info-block__cart-sum total-balance" id="balance">
                                {{ number_format(auth()->user()->balanceFloat, 2, ',', ' ') }} kr
                            </span>
                        </a>
                    </li>
                    <li class="nav-account__item">
                        <a href="#" title="Fullscreen" data-toggle="fullscreen">
                            <i class="maximize" data-feather="maximize"></i>
                            <i class="minimize" data-feather="minimize"></i>
                        </a>
                    </li>
                    <li class="nav-account__item main-nav__sub-title">
                        <figure style="margin: 0; padding: 3px 0;">
                            <img class="rounded-circle w-35 h-35" src="{{ Storage::disk('s3')->url(auth()->user()->image_path ?? 'images/avatars/default.png') }}">
                        </figure>
                        <ul class="main-nav__sub">
                            <li><a href="{{ route('account') }}">Min konto</a></li>
                            <li><a href="{{ route('deposit') }}">Gjør et innskudd</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    <button class="nav-account__item--logout">Logg ut</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-account__item">
                        <a href="{{ route('admin.analytics.index') }}" title="Admin KP">
                            <i class="target" data-feather="target"></i>
                        </a>
                    </li>

                    @endif

                    @else

                    <li class="nav-account__item nav-account__item--wishlist"><a>Utgivelsesnotater &nbsp; 
                        <span class="label label-danger extra-small">Kommer snart</span></a>
                    </li>
                    <li class="nav-account__item">
                        <a href="#" title="Fullscreen" data-toggle="fullscreen">
                            <i class="maximize" data-feather="maximize"></i>
                            <i class="minimize" data-feather="minimize"></i>
                        </a>
                    </li>
                    <li class="nav-account__item"><a href="/#loginModal">Logg inn</a></li>
                    <li class="nav-account__item"><a id="linkRegister" href="javascript:void(0);">Opprett en konto</a></li>

                    @endauth
                </ul>
                <!-- Account Navigation / End -->

            </div>
        </div>
    </div>
    <!-- Header Top Bar / End -->


    <!-- Header Primary -->
    <div class="header__primary">
        <div class="container">
            <div class="header__primary-inner">

                <!-- Header Logo -->
                <div class="header-logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('logo.svg') }}" alt="Lykkeboks logo" class="header-logo__img"></a>
                </div>
                <!-- Header Logo / End -->

                <!-- Main Navigation -->
                <nav class="main-nav clearfix">
                    <ul class="main-nav__list">
                        <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="/">Hjem</a></li>
                        <li class="{{ (request()->is('/account*')) ? 'active' : '' }}"><a href="/account#items">Bestill vare hjem &nbsp; <span class="label label-new small">SPOR PAKKEN</span></a></li>
                        <!--<li class="{{ (request()->is('/chat*')) ? 'active' : '' }}"><a href="{{ route('ChatQueries') }}">Support</a></li>-->
                    </ul>
                </nav>
                <!-- Main Navigation / End -->

                @auth
                    <div class="header__primary-spacer"></div>
                    <ul class="info-block info-block--header">
                        <li class="info-block__item info-block__item--shopping-cart js-info-block__item--onclick has-children">
                            <a class="d-inline-block" style="font-family: Montserrat,sans-serif; font-weight: 700; font-size: 20px; background-color: rgb(40, 40, 64); border-radius: 50px; box-shadow: 0 5px 10px rgba(0,0,0,0.12); border: 1px solid #282840;" href="/deposit">
                                @if(Auth::user()->balanceFloat > 0)
                                    <div class="d-inline-block total-balance" id="balance" style="padding: 8px 15px; padding-right: 15px; margin-right: 0; padding-right: 0; vertical-align: bottom;">
                                        {{ number_format(auth()->user()->balanceFloat, 2, ',', ' ') }} kr
                                    </div>
                                @else
                                    <div class="d-inline-block" style="padding: 8px 15px; padding-right: 15px; margin-right: 0; padding-right: 0; font-size: 14px; vertical-align: bottom;">
                                        Gjør et innskudd
                                    </div>
                                @endif
                                <i class="fas fa-plus-circle" style="font-size: 1.3em; margin: 10px;"></i>
                            </a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
    <!-- Header Primary / End -->
</header>
