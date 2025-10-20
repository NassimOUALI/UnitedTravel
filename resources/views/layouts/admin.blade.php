<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - United Travels</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logos/favicon.png') }}" rel="shortcut icon" type="image/png">

    <!-- CSS -->
    <link href="{{ asset('assets/css/theme-1.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme-3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/logo-sizing.css') }}" rel="stylesheet">

    @stack('styles')

    <style>
        /* Admin Sidebar Layout */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1a365d 0%, #0f2942 50%, #0a1f33 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 25px rgba(0,0,0,0.15);
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .admin-brand {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }

        .admin-brand::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
        }

        .admin-brand img {
            height: 45px;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .admin-brand-text {
            font-size: 1.35rem;
            font-weight: 700;
            color: white;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .admin-nav {
            padding: 1rem 0;
        }

        .admin-nav-section {
            padding: 0.75rem 1.5rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: rgba(255,255,255,0.6);
        }

        .admin-nav-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 3px solid transparent;
            font-size: 0.95rem;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .admin-nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0;
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.2) 0%, transparent 100%);
            transition: width 0.3s ease;
        }

        .admin-nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: white;
            padding-left: 2rem;
            border-left-color: rgba(59, 130, 246, 0.6);
        }

        .admin-nav-item:hover::before {
            width: 100%;
        }

        .admin-nav-item.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.25) 0%, rgba(59, 130, 246, 0.05) 100%);
            color: white;
            border-left-color: #3b82f6;
            font-weight: 600;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.1);
        }

        .admin-nav-item.active::before {
            width: 100%;
        }

        .admin-nav-item i {
            width: 24px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .admin-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .admin-topbar {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-bottom: 1px solid #e9ecef;
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            backdrop-filter: blur(10px);
        }

        .admin-topbar-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--bs-primary, #2c5f8d);
            margin: 0;
        }

        .admin-topbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .admin-user-menu:hover {
            background: #f8f9fa;
        }

        .admin-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .admin-user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .admin-user-name {
            font-weight: 600;
            font-size: 0.875rem;
        }

        .admin-user-role {
            font-size: 0.75rem;
            opacity: 0.7;
        }

        .admin-main {
            flex: 1;
            padding: 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: calc(100vh - 200px);
        }

        .admin-footer {
            border-top: 1px solid #e9ecef;
            padding: 1.5rem 2rem;
            text-align: center;
            font-size: 0.875rem;
            background: white;
            color: #6c757d;
        }

        .admin-footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 0.5rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .admin-sidebar.active {
                transform: translateX(0);
            }

            .admin-content {
                margin-left: 0;
            }

            .admin-topbar-title {
                font-size: 1.25rem;
            }

            .admin-main {
                padding: 1rem;
            }

            .mobile-menu-toggle {
                display: block !important;
            }
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Page Load Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .admin-main > * {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Enhanced Card Shadows */
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.12) !important;
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <!-- Brand -->
            <div class="admin-brand">
                <img src="{{ asset('assets/img/logos/footer-logo@2x.png') }}" alt="United Travels">
                <span class="admin-brand-text">Admin Panel</span>
            </div>

            <!-- Navigation -->
            <nav class="admin-nav">
                <!-- Main -->
                <div class="admin-nav-section">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="hicon hicon-dashboard"></i>
                    Dashboard
                </a>
                <a href="{{ route('home') }}" class="admin-nav-item" target="_blank">
                    <i class="hicon hicon-world"></i>
                    View Website
                    <i class="hicon hicon-external-link" style="float: right; margin-right: 0;"></i>
                </a>

                <!-- Content Management -->
                <div class="admin-nav-section">Content Management</div>
                <a href="{{ route('admin.destinations.index') }}" class="admin-nav-item {{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
                    <i class="hicon hicon-flights-pin"></i>
                    Destinations
                </a>
                <a href="{{ route('admin.tours.index') }}" class="admin-nav-item {{ request()->routeIs('admin.tours.*') ? 'active' : '' }}">
                    <i class="hicon hicon-menu-calendar"></i>
                    Tours
                </a>
                <a href="{{ route('admin.announcements.index') }}" class="admin-nav-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                    <i class="hicon hicon-megaphone"></i>
                    Announcements
                </a>

                <!-- Communication -->
                <div class="admin-nav-section">Communication</div>
                <a href="{{ route('admin.contact-messages.index') }}" class="admin-nav-item {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <i class="hicon hicon-email-envelope"></i>
                    Contact Messages
                </a>

                <!-- Marketing -->
                <div class="admin-nav-section">Marketing</div>
                <a href="{{ route('admin.discounts.index') }}" class="admin-nav-item {{ request()->routeIs('admin.discounts.*') ? 'active' : '' }}">
                    <i class="hicon hicon-discount"></i>
                    Discounts
                </a>

                <!-- User Management -->
                <div class="admin-nav-section">User Management</div>
                <a href="{{ route('admin.users.index') }}" class="admin-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="hicon hicon-account"></i>
                    Users
                </a>

                <!-- Settings -->
                <div class="admin-nav-section">Settings</div>
                <a href="{{ route('profile.edit') }}" class="admin-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="hicon hicon-user"></i>
                    My Profile
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="admin-content">
            <!-- Topbar -->
            <header class="admin-topbar">
                <div class="d-flex align-items-center">
                    <button class="mobile-menu-toggle" id="mobileMenuToggle">
                        <i class="hicon hicon-menu"></i>
                    </button>
                    <h1 class="admin-topbar-title">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="admin-topbar-actions">
                    <!-- User Menu -->
                    <div class="dropdown">
                        <div class="admin-user-menu" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('public/' . auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}" class="admin-user-avatar">
                            @else
                                <div class="admin-user-avatar bg-primary text-white d-flex align-items-center justify-content-center" style="font-weight: 600;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="admin-user-info">
                                <div class="admin-user-name">{{ auth()->user()->name }}</div>
                                <div class="admin-user-role">
                                    @foreach(auth()->user()->roles as $role)
                                        {{ $role->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </div>
                            </div>
                            <i class="hicon hicon-arrow-down"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="hicon hicon-user me-2"></i>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="hicon hicon-dashboard me-2"></i>
                                    User Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="hicon hicon-logout me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="admin-main">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="hicon hicon-confirmation-instant me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="hicon hicon-warning me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="admin-footer">
                <div class="admin-footer-links">
                    <a href="{{ route('home') }}" target="_blank">Visit Website</a>
                    <a href="{{ route('contact') }}" target="_blank">Support</a>
                    <a href="{{ route('about') }}" target="_blank">About</a>
                </div>
                <div>
                    &copy; {{ date('Y') }} United Travels. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script defer src="{{ asset('assets/js/theme-1.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/theme-2.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/theme-3.min.js') }}"></script>
    
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.getElementById('adminSidebar');
            
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (sidebar && mobileToggle && 
                        !sidebar.contains(event.target) && 
                        !mobileToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>

