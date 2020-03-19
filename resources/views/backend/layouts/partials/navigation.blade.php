<!-- begin::navigation -->
<div class="navigation">

    <!-- begin::logo -->
    <div id="logo">
        <a href="/">
            <img src="{{ asset('logo.svg') }}" alt="Lykkeboks logo" class="logo-dark" style="width: 180px">
        </a>
    </div>
    <!-- end::logo -->

    <!-- begin::navigation header -->
    <header class="navigation-header">
        <div>
            <ul class="nav">
                <li class="nav-item mt-2">
                    <a href="{{ route('account') }}" class="btn btn-outline-info" title="Profil" data-toggle="tooltip">
                        <i data-feather="user"></i>
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ route('admin.settings') }}" class="btn btn-outline-warning" title="Innstillinger" data-toggle="tooltip">
                        <i data-feather="settings"></i>
                    </a>
                </li>
                <li class="nav-item mt-2">
                  <form action="{{ route('logout') }}" method="post">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <button class="btn btn-outline-danger" title="Logg ut" data-toggle="tooltip"><i data-feather="log-out"></i></button>
                  </form>
                </li>
            </ul>
        </div>
    </header>
    <!-- end::navigation header -->

    <!-- begin::navigation menu -->
    <div class="navigation-menu-body">
        <ul>

            <li class="navigation-divider">Kontrollpanel</li>

            <li>
                <a class="{{ (request()->is('admin/analytics*')) ? 'ul active' : '' }}" href="{{ route('admin.analytics.index') }}">
                    <i class="nav-link-icon" data-feather="bar-chart-2"></i>
                    <span>Statistikk</span>
                </a>
            </li>
            <li>
                <a class="{{ (request()->is('admin/orders*')) ? 'ul active' : '' }}" href="{{ route('admin.orders.index') }}">
                    <i class="nav-link-icon" data-feather="trending-up"></i>
                    <span>Ordrer</span>
                </a>
            </li>
            <li>
                <a class="{{ (request()->is('admin/boxes*')) ? 'ul active' : '' }}" href="#">
                    <i class="nav-link-icon" data-feather="codesandbox"></i>
                    <span>Bokser</span>
                </a>
                <ul>
                    <li><a class="{{ (request()->is('admin/boxes')) ? 'active' : '' }}" href="{{ route('admin.boxes.index') }}">Oversikt</a></li>
                    <li><a class="{{ (request()->is('admin/boxes/create')) ? 'active' : '' }}" href="{{ route('admin.boxes.create') }}">Opprett boks</a></li>
                </ul>
            </li>
            <li>
                <a class="{{ (request()->is('admin/products*')) ? 'ul active' : '' }}" href="#">
                    <i class="nav-link-icon" data-feather="box"></i>
                    <span>Produkter</span>
                </a>
                <ul>
                    <li><a class="{{ (request()->is('admin/products')) ? 'active' : '' }}" href="{{ route('admin.products.index') }}">Oversikt</a></li>
                    <li><a class="{{ (request()->is('admin/products/create')) ? 'active' : '' }}" href="{{ route('admin.products.create') }}">Opprett produkt</a></li>
                </ul>
            </li>
            <li>
                <a class="{{ (request()->is('admin/coupons*')) ? 'ul active' : '' }}" href="#">
                    <i class="nav-link-icon" data-feather="gift"></i>
                    <span>Kupongkoder</span>
                </a>
                <ul>
                    <li><a class="{{ (request()->is('admin/coupons')) ? 'active' : '' }}" href="{{ route('admin.coupons.index') }}">Oversikt</a></li>
                    <li><a class="{{ (request()->is('admin/coupons/create')) ? 'active' : '' }}" href="{{ route('admin.coupons.create') }}">Opprett kupong</a></li>
                </ul>
            </li>

            <li class="navigation-divider">E-post og varslinger</li>

            <li>
                <a class="{{ (request()->is('admin/mail*')) ? 'ul active' : '' }}" href="{{ route('admin.mail.index') }}">
                    <i class="nav-link-icon" data-feather="mail"></i>
                    <span>E-post</span>
                </a>
            </li>
            <li>
                <a class="{{ (request()->is('admin/newsletter')) ? 'ul active' : '' }}" href="{{ route('admin.newsletter.index') }}">
                    <i class="nav-link-icon" data-feather="columns"></i>
                    <span>Nyhetsbrev</span>
                </a>
            </li>
            <li>
                <a class="{{ (request()->is('admin/notification')) ? 'ul active' : '' }}" href="{{ route('admin.notification.index') }}">
                    <i class="nav-link-icon" data-feather="bell"></i>
                    <span>Push-varsling</span>
                </a>
            </li>
            <li>
                <a class="{{ (request()->is('admin/sms')) ? 'ul active' : '' }}" href="{{ route('admin.sms.create') }}">
                    <i class="nav-link-icon" data-feather="message-circle"></i>
                    <span>SMS</span>
                </a>
            </li>

            <li class="navigation-divider">Artikler</li>

            <li>
                <a class="{{ (request()->is('admin/news')) ? 'ul active' : '' }}" href="{{ route('admin.news.edit') }}">
                    <i class="nav-link-icon" data-feather="file-text"></i>
                    <span>Nyheter</span>
                </a>
            </li>
            <li>
                <a class="{{ (request()->is('admin/faqs*')) ? 'ul active' : '' }}" href="{{ route('admin.faqs.edit') }}">
                    <i class="nav-link-icon" data-feather="help-circle"></i>
                    <span>Ofte stilte spørsmål</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- end::navigation menu -->

</div>
<!-- end::navigation -->
