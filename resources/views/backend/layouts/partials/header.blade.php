<!-- begin::header -->
<div class="header">

    <!-- begin::header left -->
    <ul class="navbar-nav">

        <!-- begin::navigation-toggler -->
        <li class="nav-item navigation-toggler">
            <a href="#" class="nav-link">
                <i data-feather="menu"></i>
            </a>
        </li>
        <!-- end::navigation-toggler -->

        <!-- begin::header-logo -->
        <li class="nav-item" id="header-logo">
            <a href="{{ url('/') }}">
              <img src="{{ asset('logo.svg') }}" alt="Lykkeboks logo" class="logo-dark" style="width: 100px">
            </a>
        </li>
        <!-- end::header-logo -->
    </ul>
    <!-- end::header left -->

    <!-- begin::header-right -->
    <div class="header-right">
        <ul class="navbar-nav">

            <!-- begin::search-form -->
            <li class="nav-item search-form">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Søk...">
                                <div class="input-group-append">
                                    <button class="btn btn-default" type="button">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            <!-- end::search-form -->

            <!-- begin::header minimize/maximize -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                    <i class="maximize" data-feather="maximize"></i>
                    <i class="minimize" data-feather="minimize"></i>
                </a>
            </li>
            <!-- end::header minimize/maximize -->

            <!-- begin::header notification dropdown -->
            <li class="nav-item dropdown">
                <a href="#" title="Notifications" data-toggle="dropdown">
                  <figure class="d-inline-block mb-0">
                      <img src="https://api.adorable.io/avatars/16/{{ Auth::user()->name }}.png" class="rounded-circle" alt="{{ Auth::user()->name }}">
                  </figure>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                    <div class="p-4 text-center" data-backround-image="{{ asset('dropdown-image.png') }}">
                        <h6 class="mb-1">Welcome back, {{ Auth::user()->name }}</h6>
                        <small class="font-size-11 opacity-7">1 unread notifications</small>
                    </div>
                    <div>
                        <ul class="list-group list-group-flush">
                            <li>
                                <a href="#" class="list-group-item d-flex hide-show-toggler">
                                    <div>
                                        <figure class="avatar avatar-sm m-r-15">
                                            <span class="avatar-title bg-success-bright text-success rounded-circle">
                                                <i class="ti-user"></i>
                                            </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 line-height-20 d-flex justify-content-between">
                                            New customer registered
                                            <i title="Make unread" data-toggle="tooltip"
                                               class="hide-show-toggler-item fa fa-circle-o font-size-11"></i>
                                        </p>
                                        <span class="text-muted small">20 min ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="text-divider small pb-2 pl-3 pt-3">
                                <span>Old notifications</span>
                            </li>
                            <li>
                                <a href="#" class="list-group-item d-flex hide-show-toggler">
                                    <div>
                                        <figure class="avatar avatar-sm m-r-15">
                                            <span class="avatar-title bg-warning-bright text-warning rounded-circle">
                                                <i class="ti-package"></i>
                                            </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 line-height-20 d-flex justify-content-between">
                                            New Order Recieved
                                            <i title="Mark as read" data-toggle="tooltip"
                                               class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                        </p>
                                        <span class="text-muted small">45 sec ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="list-group-item d-flex align-items-center hide-show-toggler">
                                    <div>
                                        <figure class="avatar avatar-sm m-r-15">
                                            <span class="avatar-title bg-danger-bright text-danger rounded-circle">
                                                <i class="ti-server"></i>
                                            </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 line-height-20 d-flex justify-content-between">
                                            Server Limit Reached!
                                            <i title="Make unread" data-toggle="tooltip"
                                               class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                        </p>
                                        <span class="text-muted small">55 sec ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="list-group-item d-flex align-items-center hide-show-toggler">
                                    <div>
                                        <figure class="avatar avatar-sm m-r-15">
                                            <span class="avatar-title bg-info-bright text-info rounded-circle">
                                                <i class="ti-layers"></i>
                                            </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 line-height-20 d-flex justify-content-between">
                                            Apps are ready for update
                                            <i title="Make unread" data-toggle="tooltip"
                                               class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                        </p>
                                        <span class="text-muted small">Yesterday</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="p-2 text-right">
                        <ul class="list-inline small">
                            <li class="list-inline-item">
                                <a href="#">Mark All Read</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <!-- end::header notification dropdown -->
        </ul>

        <!-- begin::mobile header toggler -->
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item header-toggler">
                <a href="#" class="nav-link">
                    <i data-feather="arrow-down"></i>
                </a>
            </li>
        </ul>
        <!-- end::mobile header toggler -->
    </div>
    <!-- end::header-right -->
</div>
<!-- end::header -->
