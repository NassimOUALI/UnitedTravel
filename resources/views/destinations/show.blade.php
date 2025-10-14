@extends('layouts.app')

@section('title', $destination->name . ' - United Travels')
@section('description', Str::limit($destination->description, 160))

@section('content')

<!-- Destination Hero -->
<section class="hero" data-aos="fade">
    @php
        // Get primary image or first image
        $headerImage = null;
        if ($destination->relationLoaded('images') && $destination->images->count() > 0) {
            $primaryImage = $destination->images->where('is_primary', true)->first();
            $headerImage = $primaryImage ? $primaryImage->path : $destination->images->first()->path;
        } elseif ($destination->image_path) {
            $headerImage = $destination->image_path;
        }
    @endphp
    @if($headerImage)
        <div class="hero-bg">
            <img src="{{ asset('public/' . $headerImage) }}" alt="{{ $destination->name }}">
        </div>
    @else
        <div class="hero-bg bg-gray-gradient"></div>
    @endif
    <div class="bg-content container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('destinations.index') }}">Destinations</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $destination->name }}</li>
            </ol>
        </nav>
        
        <div class="hero-page-title">
            <span class="hero-sub-title">Explore Destination</span>
            <h1 class="display-3 hero-title">{{ $destination->name }}</h1>
            <div class="d-flex flex-wrap gap-3 align-items-center justify-content-end mt-3">
                <span class="text-white">
                    <i class="hicon hicon-location me-1"></i>
                    {{ $destination->location }}
                </span>
                @if($destination->tours->count() > 0)
                <span class="text-white">
                    <i class="hicon hicon-backpack me-1"></i>
                    {{ $destination->tours->count() }} {{ Str::plural('tour', $destination->tours->count()) }} available
                </span>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- /Destination Hero -->

<!-- Image Gallery -->
@if($destination->images && $destination->images->count() > 0)
<section class="pt-5 pb-0 bg-gray-gradient" data-aos="fade">
    <div class="container">
        <x-image-gallery 
            :images="$destination->images" 
            :item-id="'dest-' . $destination->id" 
            :fallback-image="$destination->image_path"
            :title="$destination->name" />
    </div>
</section>
@endif
<!-- /Image Gallery -->

<!-- Destination Content -->
<section class="p-top-60 p-bottom-90 bg-gray-gradient" data-aos="fade">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-12 col-lg-8">
                <!-- Description -->
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header bg-primary text-white p-4">
                        <h2 class="h5 mb-0 text-white">
                            <i class="hicon hicon-location me-2"></i>
                            About {{ $destination->name }}
                        </h2>
                    </div>
                    <div class="card-body p-4 p-lg-5 bg-white">
                        <div class="fs-5 text-muted">
                            {{ $destination->description }}
                        </div>
                    </div>
                </div>

                <!-- Destination Highlights -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h4 mb-4">Why Visit {{ $destination->name }}?</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="hicon hicon-badge text-primary me-3 mt-1 fs-4"></i>
                                    <div>
                                        <strong>Top Rated Destination</strong>
                                        <p class="text-muted small mb-0">Highly recommended by travelers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="hicon hicon-travel-guide text-primary me-3 mt-1 fs-4"></i>
                                    <div>
                                        <strong>Expert Local Guides</strong>
                                        <p class="text-muted small mb-0">Professional tour guides available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="hicon hicon-24h-customer-support text-primary me-3 mt-1 fs-4"></i>
                                    <div>
                                        <strong>24/7 Support</strong>
                                        <p class="text-muted small mb-0">We're always here to help</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="hicon hicon-confirmation-instant text-primary me-3 mt-1 fs-4"></i>
                                    <div>
                                        <strong>Easy Booking</strong>
                                        <p class="text-muted small mb-0">Quick and instant confirmation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Tours -->
                @if($destination->tours->count() > 0)
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white p-4">
                        <h2 class="h5 mb-0 text-white">
                            <i class="hicon hicon-backpack me-2"></i>
                            Available Tours ({{ $destination->tours->count() }})
                        </h2>
                    </div>
                    <div class="card-body p-4 bg-white">
                        <div class="row g-3">
                            @foreach($destination->tours as $tour)
                            <div class="col-12">
                                <div class="card border-0 shadow-sm hover-lift">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="col-lg-7">
                                                @if($tour->discount)
                                                    <span class="badge bg-danger mb-2">{{ $tour->discount->percentage }}% OFF</span>
                                                @endif
                                                <h5 class="mb-2">
                                                    <a href="{{ route('tours.show', $tour) }}" class="text-decoration-none text-dark hover-primary">
                                                        {{ $tour->title }}
                                                    </a>
                                                </h5>
                                                <p class="text-muted mb-3">
                                                    {{ Str::limit($tour->description, 150) }}
                                                </p>
                                                <div class="d-flex flex-wrap gap-3 small text-muted">
                                                    @if($tour->start_date && $tour->end_date)
                                                    <span>
                                                        <i class="hicon hicon-calendar me-1 text-primary"></i>
                                                        {{ $tour->start_date->format('M d') }} - {{ $tour->end_date->format('M d, Y') }}
                                                    </span>
                                                    @endif
                                                    @if($tour->duration)
                                                    <span>
                                                        <i class="hicon hicon-time-clock me-1 text-primary"></i>
                                                        {{ $tour->duration }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                                                @if($tour->is_price_defined && $tour->price)
                                                    <div class="d-flex flex-column align-items-lg-end">
                                                        @if($tour->discount)
                                                            <div class="text-decoration-line-through text-muted small mb-1">
                                                                {{ format_price($tour->price, 2) }}
                                                            </div>
                                                            <div class="h3 text-primary mb-1">
                                                                {{ format_price($tour->price * (1 - $tour->discount->percentage / 100), 2) }}
                                                            </div>
                                                        @else
                                                            <div class="h3 text-primary mb-1">
                                                                {{ format_price($tour->price, 2) }}
                                                            </div>
                                                        @endif
                                                        <small class="text-muted mb-3">per person</small>
                                                        <a href="{{ route('tours.show', $tour) }}" class="btn btn-primary">
                                                            <i class="hicon hicon-thin-arrow-right me-1"></i>
                                                            View Details
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="d-flex flex-column align-items-lg-end">
                                                        <span class="badge bg-secondary mb-3">Contact for Price</span>
                                                        <a href="{{ route('tours.show', $tour) }}" class="btn btn-primary">
                                                            <i class="hicon hicon-thin-arrow-right me-1"></i>
                                                            View Details
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4">
                <!-- Destination Info -->
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header bg-primary text-white p-4">
                        <h5 class="mb-0 text-white">
                            <i class="hicon hicon-information me-2"></i>
                            Destination Info
                        </h5>
                    </div>
                    <div class="card-body p-4 bg-white">
                        <div class="mb-4 pb-4 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <span class="circle-icon bg-light-primary text-primary">
                                        <i class="hicon hicon-location"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <strong class="d-block mb-1">Location</strong>
                                    <span class="text-muted">{{ $destination->location }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <span class="circle-icon bg-light-primary text-primary">
                                        <i class="hicon hicon-backpack"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <strong class="d-block mb-1">Available Tours</strong>
                                    <span class="text-muted">{{ $destination->tours->count() }} {{ Str::plural('tour', $destination->tours->count()) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light p-4">
                        <a href="{{ route('contact') }}" class="btn btn-primary w-100">
                            <i class="hicon hicon-email-envelope me-1"></i>
                            Contact Us
                        </a>
                    </div>
                </div>

                <!-- Browse All Tours CTA -->
                <div class="card border-0 shadow-lg bg-primary text-white mb-4">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="hicon hicon-backpack" style="font-size: 48px;"></i>
                        </div>
                        <h5 class="card-title text-white mb-3">Looking for More Tours?</h5>
                        <p class="card-text mb-4">Explore all our amazing tour packages and find your perfect adventure</p>
                        <a href="{{ route('tours.index') }}" class="btn btn-light btn-lg">
                            <span>Browse All Tours</span>
                            <i class="hicon hicon-thin-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Related Destinations -->
                @if($relatedDestinations->count() > 0)
                <div class="card border-0 shadow-lg bg-light">
                    <div class="card-body p-4">
                        <h6 class="card-title mb-3">
                            <i class="hicon hicon-location text-primary me-1"></i>
                            More in {{ $destination->location }}
                        </h6>
                        <div class="list-group list-group-flush">
                            @foreach($relatedDestinations as $related)
                            <a href="{{ route('destinations.show', $related) }}" 
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 px-0 hover-primary">
                                <span>
                                    <i class="hicon hicon-flights-pin text-primary me-2"></i>
                                    {{ $related->name }}
                                </span>
                                <i class="hicon hicon-thin-arrow-right"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- /Destination Content -->

@endsection

@push('styles')
<style>
    /* Hover Lift Effect for Tour Cards */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }

    /* Circle Icon Background */
    .bg-light-primary {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .circle-icon {
        width: 45px;
        height: 45px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.25rem;
    }

    /* Hover Effects for Links */
    .hover-primary {
        transition: color 0.3s ease;
    }

    .hover-primary:hover {
        color: var(--bs-primary) !important;
    }

    /* List Group Item Hover */
    .list-group-item:hover {
        background-color: rgba(13, 110, 253, 0.05);
        padding-left: 0.5rem !important;
        transition: all 0.3s ease;
    }

    /* Button Hover Enhancement */
    .btn {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .btn:active {
        transform: translateY(0);
    }

    /* Card Header Enhancement */
    .card-header {
        border-bottom: 3px solid rgba(255, 255, 255, 0.2);
    }
</style>
@endpush

