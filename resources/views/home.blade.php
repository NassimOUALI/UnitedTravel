@extends('layouts.app')

@section('title', 'Home - United Travels')
@section('description', 'Discover amazing destinations and tours with United Travels')

@section('content')

<!-- Hero -->
<section class="hero" data-aos="fade">
    <h1 class="d-none">United Travels</h1>
    <!-- Carousel -->
    <div id="heroCarousel" class="hero-carousel carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Carousel item 1 -->
            <div class="hero-item carousel-item active">
                <div class="hero-bg">
                    <img src="{{ asset('assets/img/hero/h2.jpg') }}" srcset="{{ asset('assets/img/hero/h2@2x.jpg') }} 2x" alt="Beautiful nature">
                </div>
                <div class="hero-caption text-sm-start">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-xxl-6 col-xl-7 col-md-10">
                                <div class="hero-sub-title">
                                    <span>Explore United Travels</span>
                                </div>
                                <h2 class="display-3 hero-title">
                                    Enjoy the beautiful and romantic nature
                                </h2>
                                <div class="hero-action">
                                    <a href="{{ route('destinations.index') }}" class="btn btn-outline-light btn-uppercase mnw-180 me-4">
                                        <span>Explore</span>
                                        <i class="hicon hicon-flights-one-ways"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Carousel item 1 -->
            <!-- Carousel item 2 -->
            <div class="hero-item carousel-item">
                <div class="hero-bg">
                    <img src="{{ asset('assets/img/hero/h3.jpg') }}" srcset="{{ asset('assets/img/hero/h3@2x.jpg') }} 2x" alt="Mountain ranges">
                </div>
                <div class="hero-caption text-sm-start">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-xxl-6 col-xl-7 col-md-10">
                                <div class="hero-sub-title">
                                    <span>Explore United Travels</span>
                                </div>
                                <h2 class="display-3 hero-title">
                                    Explore majestic mountain ranges
                                </h2>
                                <div class="hero-action">
                                    <a href="{{ route('tours.index') }}" class="btn btn-outline-light btn-uppercase mnw-180 me-4">
                                        <span>Explore</span>
                                        <i class="hicon hicon-flights-one-ways"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Carousel item 2 -->
            <!-- Carousel item 3 -->
            <div class="hero-item carousel-item">
                <div class="hero-bg">
                    <img src="{{ asset('assets/img/hero/h1.jpg') }}" srcset="{{ asset('assets/img/hero/h1@2x.jpg') }} 2x" alt="Local culture">
                </div>
                <div class="hero-caption text-sm-start">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-xxl-6 col-xl-7 col-md-10">
                                <div class="hero-sub-title">
                                    <span>Explore United Travels</span>
                                </div>
                                <h2 class="display-3 hero-title">
                                    Experience the unique local culture
                                </h2>
                                <div class="hero-action">
                                    <a href="{{ route('tours.index') }}" class="btn btn-outline-light btn-uppercase mnw-180 me-4">
                                        <span>Explore</span>
                                        <i class="hicon hicon-flights-one-ways"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Carousel item 3 -->
        </div>
        <div class="carousel-control">
            <button class="carousel-control-next prev-custom" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-prev next-custom" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="carousel-indicators hero-indicators-right">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
    </div>
    <!-- /Carousel -->
    <!-- Search tour -->
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-xl-6">
                <div class="search-tours search-hero search-hero-half">
                    <form class="search-tour-form" action="{{ route('tours.index') }}" method="GET">
                        <div class="search-tour-input">
                            <div class="row g-3 g-xl-2">
                                <div class="col-12 col-md-6">
                                    <div class="input-icon-group">
                                        <label for="txtKeyword" class="input-icon hicon hicon-flights-pin"></label>
                                        <input id="txtKeyword" type="text" name="search" class="form-control shadow-sm" placeholder="Where are you going?" value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-icon-group">
                                        <label class="input-icon hicon hicon-location hicon-bold" for="selLocation"></label>
                                        <select class="form-select dropdown-select shadow-sm" id="selLocation" name="location">
                                            <option value="">All Locations</option>
                                            @foreach(\App\Models\Destination::select('location')->distinct()->get() as $loc)
                                                <option value="{{ $loc->location }}" {{ request('location') == $loc->location ? 'selected' : '' }}>{{ $loc->location }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
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
        </div>
    </div>
    <!-- /Search tour -->
</section>
<!-- /Hero -->

<!-- Featured Stats -->
<section class="pt-5 pb-4" data-aos="fade">
    <div class="container">
        <ul class="stats-list row g-0">
            <li class="col-6 col-xl-3">
                <div class="stats-item">
                    <h3 class="h1 stats-number">{{ $toursCount }}+</h3>
                    <p class="stats-desc">
                        Attractive tours <br> around the world
                    </p>
                </div>
            </li>
            <li class="col-6 col-xl-3">
                <div class="stats-item">
                    <h3 class="h1 stats-number">{{ $destinationsCount }}+</h3>
                    <p class="stats-desc">
                        Beautiful <br> destinations
                    </p>
                </div>
            </li>
            <li class="col-6 col-xl-3">
                <div class="stats-item">
                    <h3 class="h1 stats-number">4.9</h3>
                    <p class="stats-desc">
                        <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-50"></span></span>
                        <br>
                        <span>On Tripadvisor</span>
                    </p>
                </div>
            </li>
            <li class="col-6 col-xl-3">
                <div class="stats-item">
                    <h3 class="h1 stats-number">+98%</h3>
                    <p class="stats-desc">
                        Our clients <br>are satisfied
                    </p>
                </div>
            </li>
        </ul>
    </div>
</section>
<!-- /Featured Stats -->

<!-- Announcements -->
@if($announcements->count() > 0)
<section class="p-top-90 p-bottom-90 bg-primary-gradient" data-aos="fade">
    <div class="container">
        <!-- Section Header -->
        <div class="row align-items-end mb-5">
            <div class="col-12 col-lg-8">
                <div class="block-title">
                    <small class="sub-title">Stay Updated</small>
                    <h2 class="h1 title">Latest News & Announcements</h2>
                    <p class="mb-0">
                        Stay informed about our latest updates, special offers, and travel news. 
                        Be the first to know about exciting opportunities and important information.
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-lg-end mt-3 mt-lg-0">
                @if($announcements->count() > 4)
                    <a href="#" class="btn btn-outline-dark btn-uppercase">
                        <span>View all news</span>
                        <i class="hicon hicon-thin-arrow-right"></i>
                    </a>
                @endif
            </div>
        </div>

        <!-- Announcements Grid -->
        <div class="row g-4">
            @foreach($announcements as $announcement)
            <div class="col-12 col-lg-6">
                <!-- Announcement Card -->
                <div class="announcement-card card border-0 shadow-lg h-100">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-primary">
                                <i class="hicon hicon-bell me-1"></i>
                                Announcement
                            </span>
                            <small class="text-muted">
                                <i class="hicon hicon-calendar me-1"></i>
                                {{ $announcement->created_at->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h3 class="h4 mb-3 card-title">
                            <a href="#" class="text-decoration-none text-dark hover-primary">
                                {{ $announcement->title }}
                            </a>
                        </h3>
                        <p class="card-text text-muted mb-0">
                            {{ Str::limit($announcement->content, 180) }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 p-4 pt-0">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            <span>Read More</span>
                            <i class="hicon hicon-thin-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <!-- /Announcement Card -->
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- /Announcements -->

<!-- Featured Destinations -->
<section class="p-top-90 p-bottom-90" data-aos="fade">
    <div class="container">
        <!-- Section Header -->
        <div class="row align-items-end mb-5">
            <div class="col-12 col-lg-8">
                <div class="block-title">
                    <small class="sub-title">Explore the world</small>
                    <h2 class="h1 title">Popular Destinations</h2>
                    <p class="mb-0">
                        Discover our most popular travel destinations. From exotic beaches to historic cities, 
                        find your perfect getaway and start planning your dream vacation today.
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('destinations.index') }}" class="btn btn-primary btn-uppercase">
                    <span>View all destinations</span>
                    <i class="hicon hicon-flights-one-ways"></i>
                </a>
            </div>
        </div>

        <!-- Destinations Grid -->
        <div class="row g-4">
            @forelse($featuredDestinations as $destination)
            <div class="col-12 col-xxl-3 col-xl-4 col-md-6">
                <!-- Destination Card -->
                <a href="{{ route('destinations.show', $destination->id) }}" 
                   class="home-destination-card destination bottom-overlay hover-effect rounded h-100 d-block">
                    <figure class="image-hover image-hover-overlay mb-0">
                        <x-image-carousel 
                            :images="$destination->images" 
                            :item-id="'dest-' . $destination->id" 
                            :fallback-image="$destination->image_path"
                            :alt-prefix="$destination->name" />
                        <i class="hicon hicon-plus-thin image-hover-icon"></i>
                    </figure>
                    <div class="bottom-overlay-content">
                        <div class="destination-content">
                            <div class="destination-info">
                                <h3 class="destination-title mb-2">{{ $destination->name }}</h3>
                                <span class="text-white-50 small d-block mb-1">
                                    <i class="hicon hicon-location me-1"></i>
                                    {{ $destination->location }}
                                </span>
                                <span class="text-white-50 small">
                                    {{ $destination->tours->count() }} {{ Str::plural('tour', $destination->tours->count()) }} available
                                </span>
                            </div>
                            <span class="circle-icon circle-icon-link mt-3">
                                <i class="hicon hicon-flights-pin"></i>
                            </span>
                        </div>
                    </div>
                </a>
                <!-- /Destination Card -->
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="hicon hicon-location text-muted" style="font-size: 80px;"></i>
                    </div>
                    <h3 class="h4 mb-3">No Destinations Available Yet</h3>
                    <p class="text-muted mb-4">
                        Check back soon for amazing travel destinations!
                    </p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
<!-- /Featured Destinations -->

<!-- Featured Tours -->
<section class="p-top-90 p-bottom-90 bg-gray-gradient" data-aos="fade">
    <div class="container">
        <!-- Section Header -->
        <div class="row align-items-end mb-5">
            <div class="col-12 col-lg-8">
                <div class="block-title">
                    <small class="sub-title">Best Offers</small>
                    <h2 class="h1 title">Featured Tour Packages</h2>
                    <p class="mb-0">
                        Browse our selection of curated tour packages designed to give you 
                        the best travel experience at unbeatable prices.
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('tours.index') }}" class="btn btn-outline-primary btn-uppercase">
                    <span>View all tours</span>
                    <i class="hicon hicon-flights-one-ways"></i>
                </a>
            </div>
        </div>

        <!-- Tours Grid -->
        <div class="row g-4">
            @forelse($featuredTours as $tour)
            <div class="col-12 col-xxl-4 col-xl-4 col-lg-6">
                <!-- Tour Card -->
                <div class="home-tour-card destination bottom-overlay hover-effect rounded h-100 position-relative">
                    @if($tour->discount)
                        <div class="float-badge bg-danger">
                            <span>{{ $tour->discount->percentage }}% OFF</span>
                        </div>
                    @endif
                    <!-- Wishlist Button -->
                    <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                        <x-wishlist-button :tour-id="$tour->id" />
                    </div>
                    <a href="{{ route('tours.show', $tour->id) }}" class="tour-card-link d-block h-100">
                        <figure class="image-hover image-hover-overlay mb-0">
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
                                    <h3 class="destination-title mb-2">{{ $tour->title }}</h3>
                                    @if($tour->destinations->count() > 0)
                                        <span class="text-white-50 small d-block mb-1">
                                            <i class="hicon hicon-location me-1"></i>
                                            {{ $tour->destinations->first()->name }}
                                        </span>
                                    @endif
                                    @if($tour->start_date && $tour->end_date)
                                        <span class="text-white-50 small d-block">
                                            <i class="hicon hicon-calendar me-1"></i>
                                            {{ $tour->start_date->format('M d') }} - {{ $tour->end_date->format('M d, Y') }}
                                        </span>
                                    @endif
                                    @if($tour->duration)
                                        <span class="text-white-50 small d-block mt-1">
                                            <i class="hicon hicon-time-clock me-1"></i>
                                            {{ $tour->duration }}
                                        </span>
                                    @endif
                                </div>
                                <div class="tour-price text-end">
                                    @if($tour->is_price_defined && $tour->price)
                                        @if($tour->discount)
                                            <small class="text-decoration-line-through text-white-50 d-block">
                                                {{ format_price($tour->price) }}
                                            </small>
                                            <span class="h5 mb-0 text-white fw-bold">
                                                {{ format_price($tour->price * (1 - $tour->discount->percentage / 100)) }}
                                            </span>
                                        @else
                                            <span class="h5 mb-0 text-white fw-bold">
                                                {{ format_price($tour->price) }}
                                            </span>
                                        @endif
                                        <small class="text-white-50 d-block">per person</small>
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
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="hicon hicon-backpack text-muted" style="font-size: 80px;"></i>
                    </div>
                    <h3 class="h4 mb-3">No Tours Available Yet</h3>
                    <p class="text-muted mb-4">
                        Check back soon for exciting travel packages!
                    </p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
<!-- /Featured Tours -->

<!-- Call to Action -->
<section class="p-top-90 p-bottom-90 bg-primary text-white" data-aos="fade">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-8 text-center">
                <h2 class="display-4 mb-4">Ready to explore the world?</h2>
                <p class="lead mb-5">
                    Join thousands of travelers who have discovered amazing destinations with United Travels. 
                    Start your journey today!
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('tours.index') }}" class="btn btn-light btn-lg btn-uppercase">
                        <span>Browse Tours</span>
                        <i class="hicon hicon-flights-one-ways"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg btn-uppercase">
                        <span>Contact Us</span>
                        <i class="hicon hicon-email-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Call to Action -->

@endsection

@push('styles')
<style>
    /* Announcement Cards */
    .announcement-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .announcement-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }

    .announcement-card .card-title a {
        transition: color 0.3s ease;
    }

    .announcement-card .card-title a:hover {
        color: var(--bs-primary) !important;
    }

    .announcement-card .badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.35rem 0.75rem;
    }

    .announcement-card .btn-outline-primary:hover {
        transform: translateX(5px);
        transition: transform 0.3s ease;
    }

    /* Home Destination Cards */
    .home-destination-card {
        display: block;
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .home-destination-card figure {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 320px;
        position: relative;
        overflow: hidden;
        background: #f0f0f0;
    }

    .home-destination-card figure img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        min-width: 100%;
        min-height: 100%;
        transition: transform 0.3s ease;
    }

    .home-destination-card:hover figure img {
        transform: scale(1.05);
    }

    .home-destination-card .destination-placeholder {
        width: 100%;
        height: 100%;
    }

    .home-destination-card .destination-content {
        display: flex;
        flex-direction: column;
    }

    .home-destination-card .destination-info {
        flex: 1;
    }

    .home-destination-card .destination-title {
        font-size: 1.25rem;
        line-height: 1.4;
        margin-bottom: 0.5rem;
    }

    /* Responsive - Destinations */
    @media (max-width: 1399px) {
        .home-destination-card figure {
            height: 280px;
        }
    }

    @media (max-width: 991px) {
        .home-destination-card figure {
            height: 260px;
        }
    }

    @media (max-width: 767px) {
        .home-destination-card figure {
            height: 240px;
        }

        .home-destination-card .destination-title {
            font-size: 1.1rem;
        }
    }

    /* Home Tour Cards */
    .home-tour-card {
        overflow: hidden;
        border-radius: 0.5rem;
        transition: transform 0.3s ease;
    }

    .home-tour-card .tour-card-link {
        text-decoration: none;
        color: inherit;
    }

    .home-tour-card figure {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 380px;
        position: relative;
        overflow: hidden;
        background: #f0f0f0;
    }

    .home-tour-card figure img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        min-width: 100%;
        min-height: 100%;
        transition: transform 0.3s ease;
    }

    .home-tour-card:hover figure img {
        transform: scale(1.05);
    }

    .home-tour-card .tour-placeholder {
        width: 100%;
        height: 100%;
    }

    .home-tour-card .tour-card-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 1.5rem;
    }

    .home-tour-card .tour-info {
        flex: 1;
        min-width: 0;
    }

    .home-tour-card .tour-price {
        flex-shrink: 0;
    }

    .home-tour-card .destination-title {
        font-size: 1.25rem;
        line-height: 1.4;
        margin-bottom: 0.5rem;
    }

    /* Responsive - Tours */
    @media (max-width: 1399px) {
        .home-tour-card figure {
            height: 340px;
        }
    }

    @media (max-width: 991px) {
        .home-tour-card figure {
            height: 300px;
        }

        .home-tour-card .tour-card-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .home-tour-card .tour-price {
            text-align: left !important;
        }
    }

    @media (max-width: 767px) {
        .home-tour-card figure {
            height: 280px;
        }

        .home-tour-card .destination-title {
            font-size: 1.1rem;
        }
    }

    /* Empty state */
    .text-center.py-5 {
        padding: 3rem 0;
    }
</style>
@endpush
