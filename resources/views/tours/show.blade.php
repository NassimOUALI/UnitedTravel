@extends('layouts.app')

@section('title', $tour->title . ' - United Travels')
@section('description', Str::limit($tour->description, 160))

@section('content')

<!-- Tour Header -->
<section class="hero" data-aos="fade">
    @php
        // Get primary image or first image
        $headerImage = null;
        if ($tour->relationLoaded('images') && $tour->images->count() > 0) {
            $primaryImage = $tour->images->where('is_primary', true)->first();
            $headerImage = $primaryImage ? $primaryImage->path : $tour->images->first()->path;
        } elseif ($tour->image_path) {
            $headerImage = $tour->image_path;
        }
    @endphp
    @if($headerImage)
        <div class="hero-bg">
            <img src="{{ asset('public/' . $headerImage) }}" alt="{{ $tour->title }}">
        </div>
    @else
        <div class="hero-bg bg-gray-gradient"></div>
    @endif
    <div class="bg-content container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tours</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $tour->title }}</li>
            </ol>
        </nav>
        
        <div class="hero-page-title">
            @if($tour->discount)
                <span class="badge bg-danger fs-6 mb-2">{{ $tour->discount->percentage }}% OFF</span>
            @endif
            <h1 class="display-3 hero-title">{{ $tour->title }}</h1>
            <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mt-3">
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    @if($tour->start_date && $tour->end_date)
                    <span class="text-white">
                        <i class="hicon hicon-calendar me-1"></i>
                        {{ $tour->start_date->format('M d') }} - {{ $tour->end_date->format('M d, Y') }}
                    </span>
                    @endif
                </div>
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    @if($tour->destinations->count() > 0)
                    <span class="text-white">
                        <i class="hicon hicon-location me-1"></i>
                        {{ $tour->destinations->pluck('name')->join(', ') }}
                    </span>
                    @endif
                    @if($tour->duration)
                    <span class="text-white">
                        <i class="hicon hicon-time-clock me-1"></i>
                        {{ $tour->duration }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Tour Header -->

<!-- Image Gallery -->
@if($tour->images && $tour->images->count() > 0)
<section class="pt-5 pb-0 bg-gray-gradient" data-aos="fade">
    <div class="container">
        <x-image-gallery 
            :images="$tour->images" 
            :item-id="$tour->id" 
            :fallback-image="$tour->image_path"
            :title="$tour->title" />
    </div>
</section>
@endif
<!-- /Image Gallery -->

<!-- Tour Content -->
<section class="p-top-60 p-bottom-90 bg-gray-gradient" data-aos="fade">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-12 col-lg-8">
                <!-- Price Banner (Mobile) -->
                <div class="card border-0 shadow-sm mb-4 d-lg-none bg-primary text-white">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="text-white mb-2">Price per person</h5>
                                @if($tour->is_price_defined && $tour->price)
                                    @if($tour->discount)
                                        <div class="text-white-50 text-decoration-line-through small">
                                            {{ format_price($tour->price, 2) }}
                                        </div>
                                        <div class="h3 text-white mb-0">
                                            {{ format_price($tour->price * (1 - $tour->discount->percentage / 100), 2) }}
                                        </div>
                                    @else
                                        <div class="h3 text-white mb-0">
                                            {{ format_price($tour->price, 2) }}
                                        </div>
                                    @endif
                                @else
                                    <span class="badge bg-white text-primary">Contact Us</span>
                                @endif
                            </div>
                            <div>
                                <button class="btn btn-light" disabled>
                                    <span class="badge bg-warning text-dark">Coming Soon</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">About This Tour</h2>
                        <div class="fs-5 text-muted">
                            {{ $tour->description }}
                        </div>
                    </div>
                </div>

                <!-- Tour Highlights -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h3 mb-4">Tour Highlights</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="hicon hicon-confirmation-instant text-primary me-3 mt-1"></i>
                                    <div>
                                        <strong>Instant Confirmation</strong>
                                        <p class="text-muted small mb-0">Book now, receive confirmation instantly</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="hicon hicon-flexibility text-primary me-3 mt-1"></i>
                                    <div>
                                        <strong>Safe & Secure</strong>
                                        <p class="text-muted small mb-0">Your safety is our top priority</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="hicon hicon-travel-guide text-primary me-3 mt-1"></i>
                                    <div>
                                        <strong>Expert Guides</strong>
                                        <p class="text-muted small mb-0">Professional local tour guides</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="hicon hicon-badge text-primary me-3 mt-1"></i>
                                    <div>
                                        <strong>Best Price Guarantee</strong>
                                        <p class="text-muted small mb-0">We match any competitor's price</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Destinations Included -->
                @if($tour->destinations->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h3 mb-4">Destinations Included</h2>
                        <div class="row g-3">
                            @foreach($tour->destinations as $destination)
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('destinations.show', $destination) }}">
                                                {{ $destination->name }}
                                            </a>
                                        </h5>
                                        <p class="card-text small text-muted">
                                            <i class="hicon hicon-location me-1"></i>
                                            {{ $destination->location }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Tour Attachments / Downloads -->
                @if($tour->attachments && $tour->attachments->count() > 0)
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="hicon hicon-download text-primary" style="font-size: 1.75rem;"></i>
                            </div>
                            <div>
                                <h2 class="h3 mb-1">Tour Documents & Resources</h2>
                                <p class="text-muted mb-0 small">Download helpful information about this tour</p>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="row g-3">
                            @foreach($tour->attachments as $attachment)
                            <div class="col-12">
                                <div class="document-card border rounded-3 h-100 position-relative overflow-hidden">
                                    <div class="document-card-body p-3 d-flex align-items-center">
                                        <!-- File Type Icon -->
                                        <div class="file-type-badge me-3 flex-shrink-0">
                                            @if($attachment->isPdf())
                                                <div class="file-icon bg-danger bg-opacity-10 rounded-3 p-3 text-center">
                                                    <i class="hicon hicon-file-text text-danger" style="font-size: 2rem;"></i>
                                                    <div class="small fw-bold text-danger mt-1">PDF</div>
                                                </div>
                                            @else
                                                <div class="file-icon bg-primary bg-opacity-10 rounded-3 p-3 text-center">
                                                    <i class="hicon hicon-photo text-primary" style="font-size: 2rem;"></i>
                                                    <div class="small fw-bold text-primary mt-1">{{ strtoupper($attachment->type) }}</div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- File Details -->
                                        <div class="flex-grow-1 me-3">
                                            <h6 class="mb-2 fw-semibold">{{ $attachment->filename }}</h6>
                                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                                <span class="badge bg-light text-dark border">
                                                    <i class="hicon hicon-file-text me-1" style="font-size: 0.75rem;"></i>
                                                    {{ strtoupper($attachment->type) }} File
                                                </span>
                                                <span class="text-muted small">
                                                    <i class="hicon hicon-info me-1"></i>
                                                    {{ $attachment->formatted_size }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <!-- Download Button -->
                                        <div class="flex-shrink-0">
                                            <a href="{{ asset('public/' . $attachment->path) }}" 
                                               target="_blank" 
                                               download 
                                               class="btn btn-primary btn-download">
                                                <i class="hicon hicon-download me-2"></i>
                                                <span class="d-none d-sm-inline">Download</span>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- Decorative Background -->
                                    <div class="document-card-bg"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Info Footer -->
                        <div class="alert alert-info d-flex align-items-start mt-4 mb-0 border-0">
                            <i class="hicon hicon-info text-info me-2 mt-1" style="font-size: 1.25rem;"></i>
                            <div class="small">
                                <strong>Download Tips:</strong> These documents contain important information about your tour. 
                                We recommend downloading and reviewing them before your departure.
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4 d-none d-lg-block">
                <!-- Booking Card -->
                <div class="card border-0 shadow-lg mb-4 sticky-top" style="top: 20px;">
                    <div class="card-header bg-secondary text-white p-4">
                        <h5 class="card-title mb-0 text-white">
                            Tour Information
                            <span class="badge bg-warning text-dark ms-2">Booking Coming Soon</span>
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4 text-center">
                            @if($tour->is_price_defined && $tour->price)
                                @if($tour->discount)
                                    <div class="text-decoration-line-through text-muted mb-1">
                                        {{ format_price($tour->price, 2) }}
                                    </div>
                                    <div class="h2 text-primary mb-1">
                                        {{ format_price($tour->price * (1 - $tour->discount->percentage / 100), 2) }}
                                    </div>
                                    <small class="badge bg-success">
                                        Save {{ format_price($tour->price * ($tour->discount->percentage / 100), 2) }}
                                    </small>
                                @else
                                    <div class="h2 text-primary mb-1">
                                        {{ format_price($tour->price, 2) }}
                                    </div>
                                @endif
                                <div class="text-muted">per person</div>
                            @else
                                <div class="alert alert-info mb-0">
                                    <i class="hicon hicon-telephone me-1"></i>
                                    Contact us for pricing
                                </div>
                            @endif
                        </div>

                        @if($tour->start_date && $tour->end_date)
                        <div class="mb-4 pb-4 border-bottom">
                            <div class="d-flex align-items-start mb-2">
                                <i class="hicon hicon-calendar text-primary me-2 mt-1"></i>
                                <div>
                                    <strong class="d-block">Tour Dates</strong>
                                    <span class="text-muted small">
                                        {{ $tour->start_date->format('M d, Y') }} - {{ $tour->end_date->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="hicon hicon-time-clock text-primary me-2 mt-1"></i>
                                <div>
                                    <strong class="d-block">Duration</strong>
                                    <span class="text-muted small">
                                        {{ $tour->start_date->diffInDays($tour->end_date) + 1 }} days
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <button class="btn btn-secondary btn-lg w-100 mb-2" disabled>
                            <i class="hicon hicon-menu-calendar me-1"></i>
                            Booking Coming Soon
                        </button>
                        <a href="{{ route('contact') }}" class="btn btn-primary w-100 mb-2">
                            <i class="hicon hicon-telephone me-1"></i>
                            Inquire About Tour
                        </a>
                        @auth
                            <button type="button" class="wishlist-btn-large btn btn-outline-danger w-100" data-tour-id="{{ $tour->id }}">
                                <i class="hicon hicon-menu-favorite me-1"></i>
                                <span class="wishlist-text">Add to Wishlist</span>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-danger w-100">
                                <i class="hicon hicon-menu-favorite me-1"></i>
                                Login to Save
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Why Book With Us -->
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body p-4">
                        <h6 class="card-title mb-3">
                            <i class="hicon hicon-badge text-primary me-1"></i>
                            Why Book With Us?
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-3">
                                <i class="hicon hicon-confirmation-instant text-success me-2"></i>
                                Instant booking confirmation
                            </li>
                            <li class="mb-3">
                                <i class="hicon hicon-flexibility text-success me-2"></i>
                                Safe & secure travel experience
                            </li>
                            <li class="mb-3">
                                <i class="hicon hicon-badge text-success me-2"></i>
                                Best price guarantee
                            </li>
                            <li class="mb-0">
                                <i class="hicon hicon-24h-customer-support text-success me-2"></i>
                                24/7 customer support
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Tours -->
        @if($relatedTours->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="h3 mb-4">Similar Tours You Might Like</h2>
            </div>
            @foreach($relatedTours as $related)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card-tour card-tour-style-1 border-0 shadow-sm h-100">
                    @if($related->discount)
                    <div class="card-badge">
                        <span class="badge bg-danger">{{ $related->discount->percentage }}% OFF</span>
                    </div>
                    @endif
                    <a href="{{ route('tours.show', $related) }}" class="card-img">
                        @if($related->image_path)
                            <img src="{{ asset('public/' . $related->image_path) }}" alt="{{ $related->title }}" class="w-100">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="hicon hicon-backpack" style="font-size: 64px; color: #ccc;"></i>
                            </div>
                        @endif
                    </a>
                    <div class="card-body">
                        <h3 class="card-title h5">
                            <a href="{{ route('tours.show', $related) }}">
                                {{ $related->title }}
                            </a>
                        </h3>
                        <p class="card-text small text-muted">
                            {{ Str::limit($related->description, 100) }}
                        </p>
                        <div class="card-footer-price d-flex justify-content-between align-items-center mt-3">
                            <div class="price">
                                @if($related->is_price_defined && $related->price)
                                    <span class="h5 mb-0 text-primary">{{ format_price($related->price, 0) }}</span>
                                @else
                                    <span class="badge bg-secondary">Contact Us</span>
                                @endif
                            </div>
                            <a href="{{ route('tours.show', $related) }}" class="btn btn-sm btn-outline-primary">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- /Tour Content -->

@endsection

@push('styles')
<style>
.hover-shadow {
    transition: all 0.3s ease;
}
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    transform: translateY(-2px);
}

/* Document Cards Styling */
.document-card {
    background: #fff;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid #e9ecef !important;
}

.document-card:hover {
    transform: translateX(4px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border-color: #dee2e6 !important;
}

.document-card-body {
    position: relative;
    z-index: 2;
}

.document-card-bg {
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 100%;
    background: linear-gradient(90deg, transparent 0%, rgba(var(--bs-primary-rgb), 0.02) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.document-card:hover .document-card-bg {
    opacity: 1;
}

.file-icon {
    transition: transform 0.3s ease;
    min-width: 90px;
}

.document-card:hover .file-icon {
    transform: scale(1.05);
}

.btn-download {
    transition: all 0.2s ease;
    padding: 0.5rem 1.25rem;
    white-space: nowrap;
}

.btn-download:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.icon-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .document-card-body {
        flex-direction: column;
        text-align: center;
    }
    
    .file-type-badge {
        margin-bottom: 1rem;
    }
    
    .btn-download {
        width: 100%;
        margin-top: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
    // Handle large wishlist button on tour show page
    document.addEventListener('DOMContentLoaded', function() {
        const largeBtn = document.querySelector('.wishlist-btn-large');
        if (!largeBtn) return;
        
        const tourId = largeBtn.dataset.tourId;
        
        // Check if in wishlist
        fetch(`/wishlist/check/${tourId}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.in_wishlist) {
                largeBtn.classList.add('in-wishlist');
                largeBtn.querySelector('.wishlist-text').textContent = 'Remove from Wishlist';
            }
        });
        
        // Handle click
        largeBtn.addEventListener('click', function() {
            const isInWishlist = largeBtn.classList.contains('in-wishlist');
            const url = isInWishlist ? `/wishlist/${tourId}` : '/wishlist';
            const method = isInWishlist ? 'DELETE' : 'POST';
            
            largeBtn.disabled = true;
            largeBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    _method: method,
                    tour_id: tourId
                })
            })
            .then(response => response.json())
            .then(data => {
                largeBtn.disabled = false;
                
                if (data.success) {
                    if (isInWishlist) {
                        largeBtn.classList.remove('in-wishlist');
                        largeBtn.innerHTML = '<i class="hicon hicon-menu-favorite me-1"></i><span class="wishlist-text">Add to Wishlist</span>';
                    } else {
                        largeBtn.classList.add('in-wishlist');
                        largeBtn.innerHTML = '<i class="hicon hicon-menu-favorite me-1"></i><span class="wishlist-text">Remove from Wishlist</span>';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                largeBtn.disabled = false;
                largeBtn.innerHTML = '<i class="hicon hicon-menu-favorite me-1"></i><span class="wishlist-text">Try Again</span>';
            });
        });
    });
</script>
@endpush


