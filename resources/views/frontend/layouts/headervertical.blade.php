<header id="page-topbar" class="isvertical-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('backend/dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/backend/images/logo-dark-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/backend/images/logo-dark-sm.png')}}" alt="" height="22">
                    </span>
                </a>

                <a href="{{ url('backend/dashboard') }}" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('assets/backend/images/logo-light.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/backend/images/logo-light-sm.png')}}" alt="" height="22">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn topnav-hamburger">
                <div class="hamburger-icon open">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            <div style="padding-top:15px;" class="d-none d-sm-block ms-5 align-self-center">
                 @component('components.breadcrumb', ['page_breadcrumbs' => $page_breadcrumbs])
                     @slot('title'){{ $config['page_title'] }}@endslot
                 @endcomponent
            </div>

        </div>

        <div class="d-flex">









            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{asset('assets/backend/images/users/avatar-1.jpg')}}"
                    alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="p-3 border-bottom">
                        <h6 class="mb-0">Jennifer Bennett</h6>
                        <p class="mb-0 font-size-11 text-muted">jennifer.bennett@email.com</p>
                    </div>
                    <a class="dropdown-item" href="contacts-profile.html"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('backend/settings') }}"><i class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</header>
