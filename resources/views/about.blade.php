@extends('layouts.app')

@section('title', 'About Us - United Travels')
@section('description', 'Learn more about United Travels - your trusted travel partner for unforgettable adventures')

@section('content')

<!-- Hero -->
<section class="hero" data-aos="fade">
    <div class="hero-bg">
        <img src="{{ asset('assets/img/about/a6.jpg') }}" {{-- srcset="{{ asset('assets/img/about/a6@2x.jpg') }} 2x" --}} alt="About Us">
    </div>
    <div class="bg-content container">
        <div class="hero-page-title">
            <span class="hero-sub-title">Get to Know Us</span>
            <h1 class="display-3 hero-title">
                About Us
            </h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About us</li>
            </ol>
        </nav>
    </div>
</section>
<!-- /Hero -->

<!-- Featured Stats -->
<section class="pt-5 pb-4" data-aos="fade">
    <div class="container">
        <ul class="stats-list row g-0">
            <li class="col-6 col-xl-3">
                <div class="stats-item">
                    <h2 class="h1 stats-number">250+</h2>
                    <p class="stats-desc">
                        Attractive tours <br> around the world
                    </p>
                </div>
            </li>
            <li class="col-6 col-xl-3">
                <div class="stats-item">
                    <h2 class="h1 stats-number">1.1M+</h2>
                    <p class="stats-desc">
                        Clients from<br> around the world
                    </p>
                </div>
            </li>
            <li class="col-6 col-xl-3">
                <div class="stats-item">
                    <h2 class="h1 stats-number">4.9</h2>
                    <p class="stats-desc">
                        <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-50"></span></span>
                        <br>
                        <span>On Tripadvisor</span>
                    </p>
                </div>
            </li>
            <li class="col-6 col-xl-3">
                <div class="stats-item">
                    <h2 class="h1 stats-number">98%+</h2>
                    <p class="stats-desc">
                        Our clients <br>are satisfied
                    </p>
                </div>
            </li>
        </ul>
    </div>
</section>
<!-- /Featured Stats -->

<!-- About -->
<section class="p-top-90 p-bottom-90 bg-gray-gradient" data-aos="fade">
    <div class="container">
        <div class="row g-0">
            <div class="col-12 col-xl-6 order-1 order-xl-0">
                <!-- Image -->
                <div class="image-info image-info-vertical me-xl-5">
                    <div class="vertical-title">
                        <small class="ls-2">
                            <strong class="text-primary fw-semibold">Since 1993</strong> - <strong class="text-body fw-semibold">31 years</strong> of experience
                        </small>
                    </div>
                    <div class="image-center rounded">
                        <img src="{{ asset('assets/img/about/a5.jpg') }}" {{-- srcset="{{ asset('assets/img/about/a5@2x.jpg') }} 2x" --}} class="w-100" alt="United Travels">
                    </div>
                    <div class="position-absolute top-0 end-0 me-4 mt-4">
                        <div class="vertical-award rounded shadow-sm">
                            <div class="award-content">
                                <img src="{{ asset('assets/img/logos/trip-best.png') }}" srcset="{{ asset('assets/img/logos/trip-best@2x.png') }} 2x" class="w-100" alt="TripAdvisor Best">
                            </div>
                            <div class="award-footer">
                                <small>Tripadvisor</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Image -->
            </div>
            <div class="col-12 col-xl-6 order-0 order-xl-1">
                <!-- Content -->
                <div class="pt-xl-4 mb-xl-0 mb-5">
                    <div class="block-title">
                        <small class="sub-title">United Travels Agency</small>
                        <h2 class="h1 title lh-sm">We are the leading tour service provider worldwide</h2>
                    </div>
                    <p>
                        United Travels is your gateway to unforgettable adventures around the world. With years of experience and a passion for travel, we offer
                        expertly curated tours that showcase the world's stunning landscapes, vibrant cultures,
                        and rich histories. Our dedicated team ensures every aspect of your journey is seamless,
                        from comfortable accommodations to immersive activities. Whether exploring majestic
                        mountains, serene beaches, or bustling city districts, our itineraries cater to all
                        interests. At United Travels, we pride ourselves on exceptional service and
                        unique experiences that leave lasting memories. Discover the world's hidden gems with us!
                    </p>
                    <div class="pt-3">
                        <a href="{{ route('contact') }}" class="btn btn-primary mnw-180">
                            <i class="hicon hicon-email-envelope"></i>
                            <span>Let's talk now</span>
                        </a>
                        <a href="tel:+212520697004" class="btn btn-link link-dark link-hover fw-medium mnw-180">
                            <i class="hicon hicon-telephone"></i>
                            <span>+212 520 697 004</span>
                        </a>
                    </div>
                </div>
                <!-- /Content -->
            </div>
        </div>
    </div>
</section>
<!-- /About -->

<!-- Why Choose Us -->
<section class="hero" data-aos="fade">
    <div class="hero-bg">
        <img src="{{ asset('assets/img/background/b6.jpg') }}" {{-- srcset="{{ asset('assets/img/background/b6@2x.jpg') }} 2x" --}} alt="Why choose us">
    </div>
    <div class="bg-content container">
        <div class="p-top-90 p-bottom-90">
            <div class="block-title text-center pb-4">
                <small class="sub-title text-light">Great experience</small>
                <h2 class="h1 title text-white">Why choose us</h2>
            </div>
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="transparent-card rounded hover-effect">
                        <div class="card-icon">
                            <i class="hicon hicon-family-with-teens"></i>
                        </div>
                        <h3 class="h5 card-title">Leading travel agency</h3>
                        <p class="card-desc">
                            Top-rated agency renowned for exceptional service and unforgettable travel experiences worldwide.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="transparent-card rounded hover-effect">
                        <div class="card-icon">
                            <i class="hicon hicon-regular-travel-protection"></i>
                        </div>
                        <h3 class="h5 card-title">Years of experience</h3>
                        <p class="card-desc">
                            With years of expertise, we excel at organizing seamless, enjoyable, and memorable tours for every traveler.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="transparent-card rounded hover-effect">
                        <div class="card-icon">
                            <i class="hicon hicon-pay-on-checkin"></i>
                        </div>
                        <h3 class="h5 card-title">Flexible tour packages</h3>
                        <p class="card-desc">
                            We offer customizable trips with flexible packages and convenient booking options tailored to your needs.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="transparent-card rounded hover-effect">
                        <div class="card-icon">
                            <i class="hicon hicon-menu-price-display"></i>
                        </div>
                        <h3 class="h5 card-title">Best prices with offers</h3>
                        <p class="card-desc">
                            Enjoy unbeatable prices and exclusive offers, ensuring you receive great value and memorable vacation experiences.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Why Choose Us -->

<!-- CTA Section -->
<section class="p-top-110 p-bottom-110 bg-dark-blue" data-aos="fade">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-xl-8">
                <div class="text-center">
                    <div class="block-title">
                        <small class="sub-title text-light">Start Exploring</small>
                        <h2 class="h1 title text-white">Ready for your next adventure?</h2>
                    </div>
                    <div class="d-md-inline-flex align-items-md-center">
                        <a href="{{ route('tours.index') }}" class="btn btn-primary btn-uppercase mnw-180 me-2 ms-2 mt-4">
                            <i class="hicon hicon hicon-bold hicon-menu-calendar"></i>
                            <span>Book tours</span>
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-uppercase mnw-180 me-2 ms-2 mt-4">
                            <i class="hicon hicon hicon-email-envelope"></i>
                            <span>Contact Us</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /CTA Section -->

@endsection

