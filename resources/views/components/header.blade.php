<header id="header" data-aos="fade">

    <!-- Header Topbar -->
    <div class="header-topbar">
        <div class="container">
            <div class="row g-0">
                <div class="col-6 col-xl-7 col-md-8">
                    <div class="d-flex align-items-center">
                        <a href="tel:+212520697004" class="d-none d-lg-inline">
                            <i class="hicon hicon-telephone me-1"></i>
                            <span>+212 520 697 004</span>
                        </a>
                        <span class="vr bg-white d-none d-lg-inline ms-3 me-3"></span>
                        <a href="tel:+212666697004" class="d-lg-none">
                            <i class="hicon hicon-telephone me-1"></i>
                            <span>+212 666 697 004</span>
                        </a>
                        <span class="vr bg-white d-none d-md-inline ms-3 me-3"></span>
                        <a href="mailto:unitedtravelandservice@gmail.com" class="d-none d-md-inline">
                            <i class="hicon hicon-email-envelope me-1"></i>
                            <span>unitedtravelandservice@gmail.com</span>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-xl-5 col-md-4">
                    <div class="text-end">
                        @php
                            use App\Http\Controllers\LocaleController;
                            $currentLocale = session('locale', config('app.locale'));
                            $locales = LocaleController::getSupportedLocales();
                            $currentLocaleData = $locales[$currentLocale] ?? $locales['en'];
                        @endphp
                        <a class="d-inline-flex align-items-center me-3" data-bs-toggle="modal" href="#mdlLanguage">
                            <img src="{{ asset('assets/img/flags/' . $currentLocaleData['flag']) }}" height="14" class="me-1" alt="{{ $currentLocaleData['name'] }}">
                            <span class="me-1">{{ $currentLocaleData['name'] }}</span>
                            <i class="hicon hicon-thin-arrow-down hicon-bold hicon-60"></i>
                        </a>
                        <a class="d-inline-flex align-items-center" data-bs-toggle="modal" href="#mdlCurrency">
                            <span class="me-1">{{ get_currency() }}</span>
                            <i class="hicon hicon-thin-arrow-down hicon-bold hicon-60"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Header Topbar -->

    <!-- Header Navbar -->
    <div class="header-navbar">
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <i class="hicon hicon-bold hicon-hamburger-menu"></i>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logos/logo.png') }}" srcset="{{ asset('assets/img/logos/logo@2x.png') }} 2x" alt="United Travels">
                </a>
                <div class="offcanvas offcanvas-navbar offcanvas-start border-end-0" tabindex="-1" id="offcanvasNavbar">
                    <div class="offcanvas-header border-bottom p-4 p-xl-0">
                        <a href="{{ route('home') }}" class="d-inline-block">
                            <img src="{{ asset('assets/img/logos/menu-logo.png') }}" srcset="{{ asset('assets/img/logos/menu-logo@2x.png') }} 2x" alt="United Travels">
                        </a>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-4 p-xl-0">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                    <span>Home</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('destinations.*') ? 'active' : '' }}" href="{{ route('destinations.index') }}">
                                    <span>Destinations</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('tours.*') ? 'active' : '' }}" href="{{ route('tours.index') }}">
                                    <span>Tours</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                                    <span>About</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                                    <span>Contact</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex ms-auto">
                    <div class="dropdown user-menu ms-xl-auto">
                        @auth
                            <button class="circle-icon circle-icon-link circle-icon-link-hover" data-bs-toggle="dropdown" data-bs-display="static" style="padding: 0; overflow: hidden;">
                                @if(auth()->user()->profile_photo)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                                         alt="{{ auth()->user()->name }}" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="hicon hicon-mmb-account"></i>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end animate slideIn" data-bs-popper="static">
                                <li class="dropdown-header border-bottom pb-2 mb-2">
                                    <div class="d-flex align-items-center">
                                        @if(auth()->user()->profile_photo)
                                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                                                 alt="{{ auth()->user()->name }}" 
                                                 class="rounded-circle me-2"
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center me-2" 
                                                 style="width: 40px; height: 40px; font-size: 16px; font-weight: 600;">
                                                {{ substr(auth()->user()->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <strong class="d-block">{{ auth()->user()->name }}</strong>
                                            <small class="text-muted">{{ auth()->user()->email }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="hicon hicon-dashboard me-1"></i>
                                        <span>My Dashboard</span>
                                    </a>
                                </li>
                                @if(auth()->user()->roles->contains('name', 'admin'))
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="hicon hicon-ycs-dashboard me-1"></i>
                                            <span>Admin Panel</span>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="hicon hicon-mmb-account me-1"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('wishlist.index') }}">
                                        <i class="hicon hicon-menu-favorite me-1"></i>
                                        <span>My Wishlist</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item disabled" href="#" style="cursor: not-allowed; opacity: 0.6;">
                                        <i class="hicon hicon-menu-calendar me-1"></i>
                                        <span>My Bookings</span>
                                        <span class="badge bg-warning text-dark ms-2">Coming Soon</span>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="hicon hicon-close-popup me-1"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <button class="circle-icon circle-icon-link circle-icon-link-hover" data-bs-toggle="dropdown" data-bs-display="static">
                                <i class="hicon hicon-mmb-account"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end animate slideIn" data-bs-popper="static">
                                <li>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="hicon hicon-edit me-1"></i>
                                        <span>Register</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="hicon hicon-aps-lock me-1"></i>
                                        <span>Login</span>
                                    </a>
                                </li>
                            </ul>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- /Header Navbar -->

    <!-- Language Modal -->
    <x-language-modal />
    
    <!-- Currency Modal -->
    <x-currency-modal />

</header>

