@extends('layouts.app')

@section('title', 'Admin Dashboard - United Travels')

@section('content')

<div class="p-top-90 p-bottom-90 bg-gray-gradient" data-aos="fade">

    <!-- Title -->
    <section class="container">
        <div class="d-lg-flex align-items-lg-end pb-4">
            <div class="block-title me-auto">
                <small class="sub-title">Admin Panel</small>
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
            <!-- Overview Stats -->
            <div class="col-12">
                <div class="row g-3 g-md-4">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="mini-card shadow-sm rounded p-4 bg-white">
                            <span class="card-icon text-primary">
                                <i class="hicon hicon-bold hicon-150 hicon-location"></i>
                            </span>
                            <div class="card-content">
                                <h2 class="card-title display-6">{{ $stats['destinations'] }}</h2>
                                <p class="mb-0">Destinations</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="mini-card shadow-sm rounded p-4 bg-white">
                            <span class="card-icon text-success">
                                <i class="hicon hicon-bold hicon-150 hicon-backpack"></i>
                            </span>
                            <div class="card-content">
                                <h2 class="card-title display-6">{{ $stats['tours'] }}</h2>
                                <p class="mb-0">Tours</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="mini-card shadow-sm rounded p-4 bg-white">
                            <span class="card-icon text-info">
                                <i class="hicon hicon-bold hicon-150 hicon-mmb-account"></i>
                            </span>
                            <div class="card-content">
                                <h2 class="card-title display-6">{{ $stats['users'] }}</h2>
                                <p class="mb-0">Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="mini-card shadow-sm rounded p-4 bg-white">
                            <span class="card-icon text-warning">
                                <i class="hicon hicon-bold hicon-150 hicon-megaphone"></i>
                            </span>
                            <div class="card-content">
                                <h2 class="card-title display-6">{{ $stats['announcements'] }}</h2>
                                <p class="mb-0">Announcements</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Overview Stats -->

            <!-- Quick Actions -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h3 mb-4 text-body-emphasis">Quick Actions</h2>
                        <div class="row g-3">
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="{{ route('admin.destinations.create') }}" class="btn btn-outline-primary w-100">
                                    <i class="hicon hicon-location me-1"></i>
                                    <span>Add Destination</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="{{ route('admin.tours.create') }}" class="btn btn-outline-success w-100">
                                    <i class="hicon hicon-backpack me-1"></i>
                                    <span>Add Tour</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="{{ route('admin.announcements.create') }}" class="btn btn-outline-warning w-100">
                                    <i class="hicon hicon-megaphone me-1"></i>
                                    <span>Add Announcement</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="{{ route('admin.discounts.create') }}" class="btn btn-outline-danger w-100">
                                    <i class="hicon hicon-discount me-1"></i>
                                    <span>Add Discount</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Quick Actions -->

            <!-- Management Sections -->
            <div class="col-12 col-xl-6">
                <!-- Recent Destinations -->
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
                            <h2 class="h4 mb-0 text-body-emphasis">Recent Destinations</h2>
                            <a href="{{ route('admin.destinations.index') }}" class="fw-medium">
                                <span>View All</span>
                                <i class="hicon hicon-flights-one-ways"></i>
                            </a>
                        </div>
                        @if($recentDestinations->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($recentDestinations as $destination)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-1">{{ $destination->name }}</h5>
                                            <small class="text-muted">
                                                <i class="hicon hicon-location me-1"></i>
                                                {{ $destination->location }}
                                            </small>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="hicon hicon-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="hicon hicon-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center py-4">No destinations yet.</p>
                        @endif
                    </div>
                </div>
                <!-- /Recent Destinations -->
            </div>

            <div class="col-12 col-xl-6">
                <!-- Recent Tours -->
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
                            <h2 class="h4 mb-0 text-body-emphasis">Recent Tours</h2>
                            <a href="{{ route('admin.tours.index') }}" class="fw-medium">
                                <span>View All</span>
                                <i class="hicon hicon-flights-one-ways"></i>
                            </a>
                        </div>
                        @if($recentTours->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($recentTours as $tour)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">{{ $tour->title }}</h5>
                                            <div class="d-flex gap-3 align-items-center">
                                                @if($tour->is_price_defined && $tour->price)
                                                    <small class="text-success fw-bold">${{ number_format($tour->price, 2) }}</small>
                                                @else
                                                    <small class="text-muted">Price TBD</small>
                                                @endif
                                                @if($tour->discount)
                                                    <span class="badge bg-danger">{{ $tour->discount->percentage }}% OFF</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="hicon hicon-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="hicon hicon-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center py-4">No tours yet.</p>
                        @endif
                    </div>
                </div>
                <!-- /Recent Tours -->
            </div>

            <div class="col-12 col-xl-6">
                <!-- Announcements -->
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
                            <h2 class="h4 mb-0 text-body-emphasis">Active Announcements</h2>
                            <a href="{{ route('admin.announcements.index') }}" class="fw-medium">
                                <span>View All</span>
                                <i class="hicon hicon-flights-one-ways"></i>
                            </a>
                        </div>
                        @if($recentAnnouncements->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($recentAnnouncements as $announcement)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">{{ $announcement->title }}</h5>
                                            <p class="mb-1 small text-muted">{{ Str::limit($announcement->content, 80) }}</p>
                                            <small class="text-muted">{{ $announcement->created_at->diffForHumans() }}</small>
                                            @if($announcement->visible)
                                                <span class="badge bg-success ms-2">Visible</span>
                                            @else
                                                <span class="badge bg-secondary ms-2">Hidden</span>
                                            @endif
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="hicon hicon-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="hicon hicon-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center py-4">No announcements yet.</p>
                        @endif
                    </div>
                </div>
                <!-- /Announcements -->
            </div>

            <div class="col-12 col-xl-6">
                <!-- Discounts -->
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
                            <h2 class="h4 mb-0 text-body-emphasis">Active Discounts</h2>
                            <a href="{{ route('admin.discounts.index') }}" class="fw-medium">
                                <span>View All</span>
                                <i class="hicon hicon-flights-one-ways"></i>
                            </a>
                        </div>
                        @if($recentDiscounts->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($recentDiscounts as $discount)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-1">{{ $discount->name }}</h5>
                                            <div class="d-flex gap-3 align-items-center">
                                                <span class="badge bg-danger">{{ $discount->percentage }}% OFF</span>
                                                @if($discount->valid_until)
                                                    <small class="text-muted">Valid until: {{ $discount->valid_until->format('M d, Y') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="hicon hicon-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="hicon hicon-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center py-4">No discounts yet.</p>
                        @endif
                    </div>
                </div>
                <!-- /Discounts -->
            </div>
        </div>
    </section>
    <!-- /Dashboard -->

</div>

@endsection

