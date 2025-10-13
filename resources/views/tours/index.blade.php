@extends('layouts.app')

@section('title', 'Tour Packages - United Travels')
@section('description', 'Browse our amazing tour packages and find your perfect adventure')

@section('content')

    <!-- Title -->
    <section class="hero" data-aos="fade">
        <div class="hero-bg">
            <img src="{{ asset('assets/img/tours/t1.jpg') }}" alt="Tours">
        </div>
        <div class="bg-content container">
            <div class="hero-page-title">
                <span class="hero-sub-title">United Travels</span>
                <h1 class="display-3 hero-title">
                    Tour Packages
                </h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tours</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- /Title -->

    <!-- Search tour -->
    <section class="bg-light" data-aos="fade">
        <h2 class="d-none">Search tours</h2>
        <div class="container">
            <div class="search-tours">
                <form class="search-tour-form" method="GET" action="{{ route('tours.index') }}">
                    <div class="search-tour-input">
                        <div class="row g-3 g-xl-2">
                            <div class="col-12 col-xl-4 col-md-6">
                                <div class="input-icon-group">
                                    <label for="txtKeyword" class="input-icon hicon hicon-backpack"></label>
                                    <input id="txtKeyword" type="text" name="search" class="form-control shadow-sm"
                                        placeholder="Search tours..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-12 col-xl-3 col-md-6">
                                <div class="input-icon-group">
                                    <label class="input-icon hicon hicon-location" for="selDestination"></label>
                                    <select class="form-select dropdown-select shadow-sm" id="selDestination" name="destination">
                                        <option value="">All destinations</option>
                                        @foreach ($destinations as $dest)
                                            <option value="{{ $dest->id }}"
                                                {{ request('destination') == $dest->id ? 'selected' : '' }}>
                                                {{ $dest->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-xl-3 col-md-6">
                                <div class="input-icon-group">
                                    <label class="input-icon hicon hicon-sort" for="selSort"></label>
                                    <select class="form-select dropdown-select shadow-sm" id="selSort" name="sort">
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest First</option>
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-xl-2 col-md-6">
                                <button type="submit" class="btn btn-primary btn-uppercase w-100">
                                    <i class="hicon hicon-bold hicon-search-box"></i>
                                    <span>Search</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /Search tour -->

    <!-- Tours Grid -->
    <section class="p-top-90 p-bottom-90 bg-gray-gradient">
        <div class="container">
            <!-- Title -->
            <div class="d-xl-flex align-items-xl-center pb-4" data-aos="fade">
                <div class="block-title me-auto">
                    <small class="sub-title">Explore United Travels</small>
                    <h2 class="h1 title">Amazing Tour Packages</h2>
                </div>
                <div class="extra-info mt-3">
                    <strong class="text-body">{{ $tours->total() }}+</strong>
                    <span class="text-secondary">Tours available</span>
                </div>
            </div>
            <!-- /Title -->

            @if ($tours->count() > 0)
                <!-- Advanced Filters (Collapsible) -->
                <div class="mb-4">
                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#advancedFilters">
                        <i class="hicon hicon-filter me-1"></i>
                        Advanced Filters
                    </button>
                    
                    <div class="collapse mt-3" id="advancedFilters">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('tours.index') }}" method="GET">
                                    <div class="row g-3">
                                        <!-- Price Range -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Price Range</label>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <input type="number" name="min_price" class="form-control" placeholder="Min"
                                                        value="{{ request('min_price') }}">
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" name="max_price" class="form-control" placeholder="Max"
                                                        value="{{ request('max_price') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Discount Filter -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold d-block mb-3">Offers</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="has_discount" value="1"
                                                    id="hasDiscount" {{ request('has_discount') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hasDiscount">
                                                    Only show discounted tours
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                                        <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary">Clear Filters</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tour Cards -->
                <div class="row">
                    @foreach($tours as $tour)
                        <div class="col-12 col-xxl-3 col-xl-4 col-md-6" data-aos="fade">
                            <!-- Tour Card -->
                            <div class="tour-card destination bottom-overlay hover-effect rounded mb-4 position-relative">
                                @if ($tour->discount)
                                    <div class="float-badge bg-danger">
                                        <span>{{ $tour->discount->percentage }}% OFF</span>
                                    </div>
                                @endif
                                <!-- Wishlist Button -->
                                <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                                    <x-wishlist-button :tour-id="$tour->id" />
                                </div>
                                <a href="{{ route('tours.show', $tour) }}" class="tour-card-link d-block">
                                    <figure class="image-hover image-hover-overlay">
                                        <x-image-carousel 
                                            :images="$tour->images" 
                                            :item-id="$tour->id" 
                                            :fallback-image="$tour->image_path"
                                            :alt-prefix="$tour->title" />
                                        <i class="hicon hicon-plus-thin image-hover-icon"></i>
                                    </figure>
                                    <div class="bottom-overlay-content">
                                        <div class="tour-card-content">
                                            <div class="tour-info">
                                                <h3 class="destination-title">{{ $tour->title }}</h3>
                                                @if ($tour->destinations->count() > 0)
                                                    <span class="text-white-50 small">
                                                        <i class="hicon hicon-location me-1"></i>
                                                        {{ $tour->destinations->first()->name }}
                                                    </span>
                                                @endif
                                                @if ($tour->start_date && $tour->end_date)
                                                    <span class="text-white-50 small d-block mt-1">
                                                        <i class="hicon hicon-calendar me-1"></i>
                                                        {{ $tour->start_date->format('M d') }} - {{ $tour->end_date->format('M d, Y') }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="tour-price">
                                                @if ($tour->is_price_defined && $tour->price)
                                                    @if ($tour->discount)
                                                        <small class="text-decoration-line-through text-white-50 d-block">
                                                            {{ format_price($tour->price) }}
                                                        </small>
                                                        <span class="h5 mb-0 text-white fw-bold">
                                                            {{ format_price($tour->price * (1 - $tour->discount->percentage / 100)) }}
                                                        </span>
                                                    @else
                                                        <span class="h5 mb-0 text-white fw-bold">{{ format_price($tour->price) }}</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-white text-dark">Contact Us</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- /Tour Card -->
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if ($tours->hasPages())
                    <nav aria-label="Page navigation" class="pt-3 text-center" data-aos="fade">
                        <ul class="pagination pagination-circle d-inline-flex mb-0">
                            {{-- Previous Page Link --}}
                            @if ($tours->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="hicon hicon-edge-arrow-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tours->previousPageUrl() }}" rel="prev">
                                        <i class="hicon hicon-edge-arrow-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach (range(1, $tours->lastPage()) as $page)
                                @if ($page == $tours->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $tours->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($tours->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tours->nextPageUrl() }}" rel="next">
                                        <i class="hicon hicon-edge-arrow-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="hicon hicon-edge-arrow-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="hicon hicon-backpack text-muted" style="font-size: 80px;"></i>
                    </div>
                    <h3 class="h4 mb-3">No Tours Found</h3>
                    <p class="text-muted mb-4">
                        @if (request('search') || request('destination'))
                            We couldn't find any tours matching your search criteria.
                            <br>Try adjusting your filters or search terms.
                        @else
                            There are no tours available at the moment.
                            <br>Please check back later.
                        @endif
                    </p>
                    @if (request('search') || request('destination'))
                        <a href="{{ route('tours.index') }}" class="btn btn-primary">
                            <i class="hicon hicon-refresh me-1"></i>
                            Clear Filters
                        </a>
                    @endif
                </div>
                <!-- /Empty State -->
            @endif
        </div>
    </section>
    <!-- /Tours Grid -->

@endsection

@push('styles')
    <style>
        /* Tour Card Styles */
        .tour-card {
            overflow: hidden;
        }

        .tour-card .tour-card-link {
            text-decoration: none;
            color: inherit;
        }

        .tour-card figure {
            height: 320px;
        }

        .tour-card-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 1rem;
        }

        .tour-info {
            flex: 1;
        }

        .tour-price {
            text-align: right;
        }

        .float-badge.bg-danger {
            background-color: #dc3545 !important;
            color: white;
        }

        /* Responsive */
        @media (max-width: 767px) {
            .tour-card figure {
                height: 240px;
            }

            .tour-card-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .tour-price {
                text-align: left;
            }
        }
    </style>
@endpush
