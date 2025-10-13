@extends('layouts.app')

@section('title', 'Destinations - United Travels')

@section('content')

    <!-- Title -->
    <section class="hero" data-aos="fade">
        <div class="hero-bg">
            <img src="{{ asset('assets/img/destinations/d7.jpg') }}" alt="Destinations">
        </div>
        <div class="bg-content container">
            <div class="hero-page-title">
                <span class="hero-sub-title">United Travels</span>
                <h1 class="display-3 hero-title">
                    Destinations
                </h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Destinations</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- /Title -->

    <!-- Search tour -->
    <section class="bg-light" data-aos="fade">
        <h2 class="d-none">Search destinations</h2>
        <div class="container">
            <div class="search-tours">
                <form class="search-tour-form" method="GET" action="{{ route('destinations.index') }}">
                    <div class="search-tour-input">
                        <div class="row g-3 g-xl-2">
                            <div class="col-12 col-xl-5 col-md-6">
                                <div class="input-icon-group">
                                    <label for="txtKeyword" class="input-icon hicon hicon-flights-pin"></label>
                                    <input id="txtKeyword" type="text" name="search" class="form-control shadow-sm"
                                        placeholder="Where are you going?" value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-12 col-xl-5 col-md-6">
                                <div class="input-icon-group">
                                    <label class="input-icon hicon hicon-location" for="selLocation"></label>
                                    <select class="form-select dropdown-select shadow-sm" id="selLocation" name="location">
                                        <option value="">All locations</option>
                                        @foreach ($destinations->pluck('location')->unique() as $location)
                                            <option value="{{ $location }}"
                                                {{ request('location') == $location ? 'selected' : '' }}>
                                                {{ $location }}
                                            </option>
                                        @endforeach
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

    <!-- Destination -->
    <section class="p-top-90 p-bottom-90 bg-gray-gradient">
        <div class="container">
            <!-- Title -->
            <div class="d-xl-flex align-items-xl-center pb-4" data-aos="fade">
                <div class="block-title me-auto">
                    <small class="sub-title">Explore United Travels</small>
                    <h2 class="h1 title">Amazing Destinations</h2>
                </div>
                <div class="extra-info mt-3">
                    <strong class="text-body">{{ $destinations->total() }}+</strong>
                    <span class="text-secondary">Attractive destinations</span>
                </div>
            </div>
            <!-- /Title -->

            @if ($destinations->count() > 0)
                <!-- Destination list -->
                <div class="row">
                    @foreach ($destinations as $destination)
                        <div class="col-12 col-xxl-3 col-xl-4 col-md-6" data-aos="fade">
                            <!-- Destination -->
                            <a href="{{ route('destinations.show', $destination) }}" 
                               class="destination bottom-overlay hover-effect rounded mb-4">
                                <figure class="image-hover image-hover-overlay">
                                    <x-image-carousel 
                                        :images="$destination->images" 
                                        :item-id="'dest-' . $destination->id" 
                                        :fallback-image="$destination->image_path ?: 'assets/img/destinations/d1.jpg'"
                                        :alt-prefix="$destination->name" />
                                    <i class="hicon hicon-plus-thin image-hover-icon"></i>
                                </figure>
                                <div class="bottom-overlay-content">
                                    <div class="destination-content">
                                        <div class="destination-info">
                                            <h3 class="destination-title">{{ $destination->name }}</h3>
                                            <span>{{ $destination->tours->count() }} {{ Str::plural('tour', $destination->tours->count()) }}</span>
                                        </div>
                                        <span class="circle-icon circle-icon-link">
                                            <i class="hicon hicon-flights-pin"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <!-- /Destination -->
                        </div>
                    @endforeach
                </div>
                <!-- /Destination list -->

                <!-- Pagination -->
                @if ($destinations->hasPages())
                    <nav aria-label="Page navigation" class="pt-3 text-center" data-aos="fade">
                        <ul class="pagination pagination-circle d-inline-flex mb-0">
                            {{-- Previous Page Link --}}
                            @if ($destinations->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="hicon hicon-edge-arrow-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $destinations->previousPageUrl() }}" rel="prev">
                                        <i class="hicon hicon-edge-arrow-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach (range(1, $destinations->lastPage()) as $page)
                                @if ($page == $destinations->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $destinations->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($destinations->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $destinations->nextPageUrl() }}" rel="next">
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
                <!-- /Pagination -->
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="hicon hicon-location text-muted" style="font-size: 80px;"></i>
                    </div>
                    <h3 class="h4 mb-3">No Destinations Found</h3>
                    <p class="text-muted mb-4">
                        @if (request('search') || request('location'))
                            We couldn't find any destinations matching your search criteria.
                            <br>Try adjusting your filters or search terms.
                        @else
                            There are no destinations available at the moment.
                            <br>Please check back later.
                        @endif
                    </p>
                    @if (request('search') || request('location'))
                        <a href="{{ route('destinations.index') }}" class="btn btn-primary">
                            <i class="hicon hicon-refresh me-1"></i>
                            Clear Filters
                        </a>
                    @endif
                </div>
                <!-- /Empty State -->
            @endif
        </div>
    </section>
    <!-- /Destination -->

@endsection

@push('styles')
    <style>
        /* Destination Cards - Simple Grid Layout */
        .destination {
            display: block;
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem;
        }

        .destination figure {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 320px;
            position: relative;
            overflow: hidden;
        }

        .destination figure img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        /* Bottom overlay gradient */
        .bottom-overlay::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.75), transparent);
            z-index: 1;
        }

        .bottom-overlay-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            color: white;
            z-index: 2;
        }

        .destination-content {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .destination-info {
            flex: 1;
        }

        .destination-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: white;
        }

        .destination-info span {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.875rem;
        }

        .circle-icon-link {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
        }

        /* Responsive heights */
        @media (max-width: 1399px) {
            .destination figure {
                height: 280px;
            }
        }

        @media (max-width: 991px) {
            .destination figure {
                height: 260px;
            }
        }

        @media (max-width: 767px) {
            .destination figure {
                height: 240px;
            }

            .bottom-overlay-content {
                padding: 1rem;
            }

            .destination-title {
                font-size: 1.1rem;
            }

            .destination-info span {
                font-size: 0.8rem;
            }
        }

        /* Browser compatibility for object-fit */
        .destination figure img {
            -o-object-fit: cover;
            -webkit-object-fit: cover;
            -moz-object-fit: cover;
        }
    </style>
@endpush
