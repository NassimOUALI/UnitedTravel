@extends('layouts.app')

@section('title', 'My Dashboard - United Travels')

@section('content')

<div class="p-top-90 p-bottom-90 bg-gray-gradient" data-aos="fade">

    <!-- Title -->
    <section class="container">
        <div class="d-lg-flex align-items-lg-end pb-4">
            <div class="block-title me-auto">
                <small class="sub-title">My Account</small>
                <h1 class="display-5 title">Dashboard</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-3">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- /Title -->

    <!-- Dashboard -->
    <section class="container">
        <div class="row g-4">
            
            <!-- Welcome Card -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="h3 mb-2">Welcome back, {{ $user->name }}! 👋</h2>
                                <p class="text-muted mb-0">Manage your bookings, profile, and wishlist</p>
                            </div>
                            @if($user->roles->contains('name', 'admin'))
                            <div>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                                    <i class="hicon hicon-dashboard me-1"></i>
                                    <span>Admin Panel</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Welcome Card -->

            <!-- Quick Stats -->
            <div class="col-12 col-md-4">
                <div class="mini-card shadow-sm rounded p-4 bg-light h-100 position-relative" style="opacity: 0.7;">
                    <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">Coming Soon</span>
                    <span class="card-icon text-muted">
                        <i class="hicon hicon-bold hicon-150 hicon-menu-calendar"></i>
                    </span>
                    <div class="card-content">
                        <h2 class="card-title display-6">{{ $bookings->count() }}</h2>
                        <p class="mb-0">Total Bookings</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="mini-card shadow-sm rounded p-4 bg-light h-100 position-relative" style="opacity: 0.7;">
                    <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">Coming Soon</span>
                    <span class="card-icon text-muted">
                        <i class="hicon hicon-bold hicon-150 hicon-confirmation-instant"></i>
                    </span>
                    <div class="card-content">
                        <h2 class="card-title display-6">{{ $upcomingBookings->count() }}</h2>
                        <p class="mb-0">Upcoming Tours</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="mini-card shadow-sm rounded p-4 bg-white h-100">
                    <span class="card-icon text-danger">
                        <i class="hicon hicon-bold hicon-150 hicon-menu-favorite"></i>
                    </span>
                    <div class="card-content">
                        <h2 class="card-title display-6">{{ $wishlistCount }}</h2>
                        <p class="mb-0">Saved Tours</p>
                    </div>
                </div>
            </div>
            <!-- /Quick Stats -->

            <!-- Quick Actions -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h4 mb-4 text-body-emphasis">Quick Actions</h2>
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <a href="{{ route('tours.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="hicon hicon-backpack me-1"></i>
                                    <span>Browse Tours</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <button class="btn btn-outline-secondary w-100" disabled>
                                    <i class="hicon hicon-menu-calendar me-1"></i>
                                    <span>My Bookings</span>
                                    <small class="d-block">Coming Soon</small>
                                </button>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('wishlist.index') }}" class="btn btn-outline-danger w-100">
                                    <i class="hicon hicon-menu-favorite me-1"></i>
                                    <span>My Wishlist</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-info w-100">
                                    <i class="hicon hicon-mmb-account me-1"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Quick Actions -->

            <!-- Upcoming Bookings -->
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
                            <h2 class="h4 mb-0 text-body-emphasis">Upcoming Tours</h2>
                            <a href="#" class="fw-medium">
                                <span>View All</span>
                                <i class="hicon hicon-flights-one-ways"></i>
                            </a>
                        </div>
                        @if($upcomingBookings->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($upcomingBookings as $booking)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">{{ $booking->tour->title }}</h5>
                                            <p class="mb-1 small text-muted">
                                                <i class="hicon hicon-calendar me-1"></i>
                                                {{ $booking->start_date->format('M d, Y') }}
                                            </p>
                                            <span class="badge bg-success">Confirmed</span>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="hicon hicon-150 hicon-backpack text-muted mb-3" style="font-size: 48px;"></i>
                                <p class="text-muted mb-3">You don't have any upcoming tours yet.</p>
                                <a href="{{ route('tours.index') }}" class="btn btn-primary">
                                    Browse Tours
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Upcoming Bookings -->

            <!-- Account Info -->
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="h4 mb-4 text-body-emphasis">Account Information</h2>
                        <div class="text-center mb-4">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                     alt="{{ $user->name }}" 
                                     class="rounded-circle mb-3" 
                                     style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; font-size: 36px;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <p class="text-muted small">{{ $user->email }}</p>
                        </div>
                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Member Since:</span>
                                <strong>{{ $user->created_at->format('M Y') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Total Bookings:</span>
                                <strong>{{ $bookings->count() }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Account Type:</span>
                                <strong>{{ $user->roles->pluck('name')->map(fn($r) => ucfirst($r))->join(', ') }}</strong>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary w-100">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Account Info -->

        </div>
    </section>
    <!-- /Dashboard -->

</div>

@endsection

