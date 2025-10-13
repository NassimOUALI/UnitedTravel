@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')

<!-- Welcome Banner -->
<div class="card border-0 shadow-sm mb-4 bg-gradient-primary text-white overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="text-white mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h3>
                <p class="mb-0 text-white-50">Here's what's happening with your travel agency today.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="text-white-50 small">
                    <i class="hicon hicon-calendar me-1"></i>
                    {{ now()->format('l, F j, Y') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Statistics Overview -->
<div class="row g-4 mb-4">
    <!-- Destinations Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm hover-lift h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1 text-uppercase small fw-semibold">Destinations</p>
                        <h2 class="mb-0 fw-bold">{{ $stats['destinations'] }}</h2>
                    </div>
                    <div class="stat-icon bg-primary-soft text-primary">
                        <i class="hicon hicon-flights-pin"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-sm btn-outline-primary">
                        <span>Manage</span>
                        <i class="hicon hicon-thin-arrow-right ms-1"></i>
                    </a>
                    <span class="badge bg-primary-soft text-primary">+{{ $recentDestinations->count() }} new</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tours Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm hover-lift h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1 text-uppercase small fw-semibold">Tour Packages</p>
                        <h2 class="mb-0 fw-bold">{{ $stats['tours'] }}</h2>
                    </div>
                    <div class="stat-icon bg-success-soft text-success">
                        <i class="hicon hicon-backpack"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.tours.index') }}" class="btn btn-sm btn-outline-success">
                        <span>Manage</span>
                        <i class="hicon hicon-thin-arrow-right ms-1"></i>
                    </a>
                    <span class="badge bg-success-soft text-success">+{{ $recentTours->count() }} new</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm hover-lift h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1 text-uppercase small fw-semibold">Total Users</p>
                        <h2 class="mb-0 fw-bold">{{ $stats['users'] }}</h2>
                    </div>
                    <div class="stat-icon bg-info-soft text-info">
                        <i class="hicon hicon-mmb-account"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-info">
                        <span>Manage</span>
                        <i class="hicon hicon-thin-arrow-right ms-1"></i>
                    </a>
                    <span class="badge bg-info-soft text-info">Active</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Discounts Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm hover-lift h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1 text-uppercase small fw-semibold">Active Discounts</p>
                        <h2 class="mb-0 fw-bold">{{ $stats['discounts'] }}</h2>
                    </div>
                    <div class="stat-icon bg-danger-soft text-danger">
                        <i class="hicon hicon-discount"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.discounts.index') }}" class="btn btn-sm btn-outline-danger">
                        <span>Manage</span>
                        <i class="hicon hicon-thin-arrow-right ms-1"></i>
                    </a>
                    <span class="badge bg-danger-soft text-danger">{{ $activeDiscounts->count() }} active</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <div class="d-flex align-items-center">
            <i class="hicon hicon-flash text-warning me-2 fs-5"></i>
            <h5 class="mb-0 fw-semibold">Quick Actions</h5>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="row g-3">
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('admin.destinations.create') }}" class="quick-action-btn">
                    <div class="quick-action-icon bg-primary-soft text-primary">
                        <i class="hicon hicon-add"></i>
                    </div>
                    <span class="quick-action-text">Add Destination</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('admin.tours.create') }}" class="quick-action-btn">
                    <div class="quick-action-icon bg-success-soft text-success">
                        <i class="hicon hicon-add"></i>
                    </div>
                    <span class="quick-action-text">Add Tour</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('admin.announcements.create') }}" class="quick-action-btn">
                    <div class="quick-action-icon bg-warning-soft text-warning">
                        <i class="hicon hicon-speaker"></i>
                    </div>
                    <span class="quick-action-text">New Announcement</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('admin.discounts.create') }}" class="quick-action-btn">
                    <div class="quick-action-icon bg-danger-soft text-danger">
                        <i class="hicon hicon-discount"></i>
                    </div>
                    <span class="quick-action-text">New Discount</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('admin.users.create') }}" class="quick-action-btn">
                    <div class="quick-action-icon bg-info-soft text-info">
                        <i class="hicon hicon-mmb-account"></i>
                    </div>
                    <span class="quick-action-text">Add User</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('home') }}" class="quick-action-btn" target="_blank">
                    <div class="quick-action-icon bg-secondary-soft text-secondary">
                        <i class="hicon hicon-world"></i>
                    </div>
                    <span class="quick-action-text">View Website</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content Management -->
<div class="row g-4 mb-4">
    <!-- Active Announcements -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="hicon hicon-megaphone text-warning me-2"></i>
                    <h5 class="mb-0 fw-semibold">Active Announcements</h5>
                </div>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-sm btn-outline-primary">
                    View All <i class="hicon hicon-thin-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($recentAnnouncements->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentAnnouncements as $announcement)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-2">
                                            <h6 class="mb-0 me-2">{{ $announcement->title }}</h6>
                                            @if($announcement->visible)
                                                <span class="badge bg-success-soft text-success">Visible</span>
                                            @else
                                                <span class="badge bg-secondary-soft text-secondary">Hidden</span>
                                            @endif
                                        </div>
                                        <p class="mb-2 small text-muted">{{ Str::limit($announcement->content, 100) }}</p>
                                        <small class="text-muted">
                                            <i class="hicon hicon-time-clock me-1"></i>
                                            {{ $announcement->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <div class="btn-group btn-group-sm ms-3" role="group">
                                        <a href="{{ route('admin.announcements.edit', $announcement) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-start" 
                                           title="Edit Announcement"
                                           data-bs-toggle="tooltip">
                                            <i class="hicon hicon-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-end" 
                                                title="Delete Announcement"
                                                data-bs-toggle="tooltip"
                                                onclick="if(confirm('Are you sure you want to delete this announcement?\n\nThis action cannot be undone.')) { document.getElementById('dash-delete-form-announcement-{{ $announcement->id }}').submit(); }">
                                            <i class="hicon hicon-trash"></i>
                                        </button>
                                    </div>
                                    <form id="dash-delete-form-announcement-{{ $announcement->id }}" 
                                          action="{{ route('admin.announcements.destroy', $announcement) }}" 
                                          method="POST" 
                                          class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="hicon hicon-megaphone text-muted mb-3" style="font-size: 3rem;"></i>
                        <p class="text-muted mb-3">No announcements yet.</p>
                        <a href="{{ route('admin.announcements.create') }}" class="btn btn-sm btn-primary">
                            <i class="hicon hicon-add me-1"></i>
                            Create Your First Announcement
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Active Discounts -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="hicon hicon-discount text-danger me-2"></i>
                    <h5 class="mb-0 fw-semibold">Active Discounts</h5>
                </div>
                <a href="{{ route('admin.discounts.index') }}" class="btn btn-sm btn-outline-primary">
                    View All <i class="hicon hicon-thin-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($activeDiscounts->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($activeDiscounts as $discount)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <div class="discount-badge">
                                        <span class="fw-bold">{{ $discount->percentage }}%</span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ $discount->name }}</h6>
                                        @if($discount->valid_until)
                                            <small class="text-muted">
                                                <i class="hicon hicon-calendar me-1"></i>
                                                Valid until: {{ $discount->valid_until->format('M d, Y') }}
                                            </small>
                                        @else
                                            <small class="text-muted">
                                                <i class="hicon hicon-confirmation-instant me-1"></i>
                                                No expiration
                                            </small>
                                        @endif
                                    </div>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.discounts.edit', $discount) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-start"
                                           title="Edit Discount"
                                           data-bs-toggle="tooltip">
                                            <i class="hicon hicon-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-end" 
                                                title="Delete Discount"
                                                data-bs-toggle="tooltip"
                                                onclick="if(confirm('Are you sure you want to delete this discount?\n\nThis action cannot be undone.')) { document.getElementById('dash-delete-form-discount-{{ $discount->id }}').submit(); }">
                                            <i class="hicon hicon-trash"></i>
                                        </button>
                                    </div>
                                    <form id="dash-delete-form-discount-{{ $discount->id }}" 
                                          action="{{ route('admin.discounts.destroy', $discount) }}" 
                                          method="POST" 
                                          class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="hicon hicon-discount text-muted mb-3" style="font-size: 3rem;"></i>
                        <p class="text-muted mb-3">No active discounts.</p>
                        <a href="{{ route('admin.discounts.create') }}" class="btn btn-sm btn-danger">
                            <i class="hicon hicon-add me-1"></i>
                            Create Your First Discount
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Latest Content -->
<div class="row g-4">
    <!-- Recent Destinations -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="hicon hicon-flights-pin text-primary me-2"></i>
                    <h5 class="mb-0 fw-semibold">Recent Destinations</h5>
                </div>
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-sm btn-outline-primary">
                    View All <i class="hicon hicon-thin-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($recentDestinations->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentDestinations as $destination)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    @if($destination->image_path)
                                        <img src="{{ asset($destination->image_path) }}" 
                                             alt="{{ $destination->name }}" 
                                             class="rounded-3 shadow-sm me-3" 
                                             style="width: 70px; height: 70px; object-fit: cover;">
                                    @else
                                        <div class="bg-primary-soft rounded-3 me-3 d-flex align-items-center justify-content-center" 
                                             style="width: 70px; height: 70px;">
                                            <i class="hicon hicon-flights-pin text-primary fs-3"></i>
                                        </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $destination->name }}</h6>
                                        <small class="text-muted">
                                            <i class="hicon hicon-location me-1"></i>
                                            {{ $destination->location }}
                                        </small>
                                    </div>
                                    <a href="{{ route('admin.destinations.edit', $destination) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="hicon hicon-edit me-1"></i>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="hicon hicon-flights-pin text-muted mb-3" style="font-size: 3rem;"></i>
                        <p class="text-muted mb-3">No destinations yet.</p>
                        <a href="{{ route('admin.destinations.create') }}" class="btn btn-sm btn-primary">
                            <i class="hicon hicon-add me-1"></i>
                            Add Your First Destination
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Tours -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="hicon hicon-backpack text-success me-2"></i>
                    <h5 class="mb-0 fw-semibold">Recent Tours</h5>
                </div>
                <a href="{{ route('admin.tours.index') }}" class="btn btn-sm btn-outline-primary">
                    View All <i class="hicon hicon-thin-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($recentTours->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentTours as $tour)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    @if($tour->image_path)
                                        <img src="{{ asset($tour->image_path) }}" 
                                             alt="{{ $tour->title }}" 
                                             class="rounded-3 shadow-sm me-3" 
                                             style="width: 70px; height: 70px; object-fit: cover;">
                                    @else
                                        <div class="bg-success-soft rounded-3 me-3 d-flex align-items-center justify-content-center" 
                                             style="width: 70px; height: 70px;">
                                            <i class="hicon hicon-backpack text-success fs-3"></i>
                                        </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $tour->title }}</h6>
                                        <small class="text-muted">
                                            @if($tour->is_price_defined && $tour->price)
                                                <i class="hicon hicon-money me-1"></i>
                                                {{ format_price($tour->price, 0) }}
                                            @else
                                                <i class="hicon hicon-information me-1"></i>
                                                Price on request
                                            @endif
                                        </small>
                                    </div>
                                    <a href="{{ route('admin.tours.edit', $tour) }}" 
                                       class="btn btn-sm btn-outline-success">
                                        <i class="hicon hicon-edit me-1"></i>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="hicon hicon-backpack text-muted mb-3" style="font-size: 3rem;"></i>
                        <p class="text-muted mb-3">No tours yet.</p>
                        <a href="{{ route('admin.tours.create') }}" class="btn btn-sm btn-success">
                            <i class="hicon hicon-add me-1"></i>
                            Create Your First Tour
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Enhanced Stat Cards */
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }

    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-info-soft { background-color: rgba(13, 202, 240, 0.1); }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
    .bg-secondary-soft { background-color: rgba(108, 117, 125, 0.1); }

    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,.15) !important;
    }

    /* Quick Action Buttons */
    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        text-decoration: none;
        padding: 1.5rem;
        border-radius: 12px;
        background: #fff;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .quick-action-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.1);
        border-color: #dee2e6;
    }

    .quick-action-icon {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .quick-action-text {
        font-size: 0.875rem;
        font-weight: 600;
        color: #495057;
    }

    /* Discount Badge */
    .discount-badge {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
    }

    /* List Group Enhancements */
    .list-group-item-action {
        transition: all 0.2s ease;
    }

    .list-group-item-action:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    /* Gradient Header */
    .bg-gradient-primary {
        position: relative;
    }

    .bg-gradient-primary::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }
</style>
@endpush
