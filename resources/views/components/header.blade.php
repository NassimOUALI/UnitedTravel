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
                        <span class="vr bg-white d-none d-md-inline ms-3 me-3"></span>
                        <a href="mailto:unitedtravelandservice@gmail.com" class="d-none d-md-inline">
                            <i class="hicon hicon-email-envelope me-1"></i>
                            <span>unitedtravelandservice@gmail.com</span>
                        </a>
                        <span class="vr bg-white d-none d-md-inline ms-3 me-3"></span>

                        <a href="https://www.instagram.com/united_services_and_events/" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="d-none d-md-inline instagram-link"
                           title="Follow us on Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                            </svg>
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
                                    <img src="{{ asset('public/' . auth()->user()->profile_photo) }}" 
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
                                            <img src="{{ asset('public/' . auth()->user()->profile_photo) }}" 
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

