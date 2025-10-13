@extends('layouts.app')

@section('title', 'Contact Us - United Travels')
@section('description', 'Get in touch with United Travels. We are here to help you plan your perfect vacation')

@section('content')

    <!-- Hero Section -->
    <section class="hero" data-aos="fade">
        <div class="hero-bg">
            <img src="{{ asset('assets/img/destinations/d3.jpg') }}" alt="Contact Us">
        </div>
        <div class="bg-content container">
            <div class="hero-page-title">
                <span class="hero-sub-title">Get in Touch</span>
                <h1 class="display-3 hero-title">Contact United Travels</h1>
                <p class="hero-description mt-3">
                    Have questions? We're here to help! Reach out to us and we'll get back to you as soon as possible.
                </p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- /Hero Section -->

    <!-- Contact Stats -->
    <section class="p-top-60 p-bottom-30 bg-light" data-aos="fade">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-6 col-lg-3">
                    <div class="contact-stat">
                        <i class="hicon hicon-24h-customer-support text-primary mb-3" style="font-size: 48px;"></i>
                        <h3 class="h5 mb-1">24/7 Support</h3>
                        <p class="text-muted small mb-0">Always here to help</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="contact-stat">
                        <i class="hicon hicon-confirmation-instant text-primary mb-3" style="font-size: 48px;"></i>
                        <h3 class="h5 mb-1">Quick Response</h3>
                        <p class="text-muted small mb-0">Within 24 hours</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="contact-stat">
                        <i class="hicon hicon-telephone text-primary mb-3" style="font-size: 48px;"></i>
                        <h3 class="h5 mb-1">Call Us</h3>
                        <p class="text-muted small mb-0">+212 520 697 004</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="contact-stat">
                        <i class="hicon hicon-email-envelope text-primary mb-3" style="font-size: 48px;"></i>
                        <h3 class="h5 mb-1">Email Us</h3>
                        <p class="text-muted small mb-0">Quick support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Contact Stats -->

    <!-- Contact Content -->
    <section class="p-top-60 p-bottom-90 bg-gray-gradient" data-aos="fade">
        <div class="container">
            <!-- Section Title -->
            <div class="text-center mb-5">
                <small class="sub-title">We're Here to Help</small>
                <h2 class="h1 mb-3">Send Us a Message</h2>
                <p class="text-muted">Fill out the form below and we'll get back to you within 24 hours</p>
            </div>

            <div class="row g-4">
                <!-- Contact Form -->
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-primary text-white p-4">
                            <h3 class="h5 mb-0 text-white">
                                <i class="hicon hicon-email-envelope me-2"></i>
                                Contact Form
                            </h3>
                        </div>
                        <div class="card-body p-4 p-md-5 bg-white">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="hicon hicon-confirmation-instant me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Full Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="subject" class="form-label">Subject <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                            id="subject" name="subject" value="{{ old('subject') }}" required>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="message" class="form-label">Message <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="6"
                                            required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Minimum 10 characters</small>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="hicon hicon-email-envelope me-2"></i>
                                            Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="col-12 col-lg-4">
                    <!-- Contact Details -->
                    <div class="card border-0 shadow-lg mb-4">
                        <div class="card-header bg-primary text-white p-4">
                            <h5 class="mb-0 text-white">
                                <i class="hicon hicon-telephone me-2"></i>
                                Contact Information
                            </h5>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <div class="mb-4 pb-4 border-bottom">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <span class="circle-icon bg-light-primary text-primary">
                                            <i class="hicon hicon-telephone"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <strong class="d-block mb-2">Phone</strong>
                                        <a href="tel:+212520697004" class="text-muted text-decoration-none d-block mb-1 hover-primary">
                                            <i class="hicon hicon-thin-arrow-right me-1"></i>
                                            +212 520 697 004
                                        </a>
                                        <a href="tel:+212666697004" class="text-muted text-decoration-none d-block hover-primary">
                                            <i class="hicon hicon-thin-arrow-right me-1"></i>
                                            +212 666 697 004
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 pb-4 border-bottom">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <span class="circle-icon bg-light-primary text-primary">
                                            <i class="hicon hicon-email-envelope"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <strong class="d-block mb-2">Email</strong>
                                        <a href="mailto:unitedtravelandservice@gmail.com" 
                                           class="text-muted text-decoration-none hover-primary" 
                                           style="word-break: break-all;">
                                            <i class="hicon hicon-thin-arrow-right me-1"></i>
                                            unitedtravelandservice@gmail.com
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <span class="circle-icon bg-light-primary text-primary">
                                            <i class="hicon hicon-location"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <strong class="d-block mb-2">Address</strong>
                                        <p class="text-muted mb-0">
                                            164 boulevard ambassadeur ben Aicha<br>
                                            Roches noires, Casablanca<br>
                                            Morocco
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light p-4">
                            <div class="d-flex align-items-center">
                                <i class="hicon hicon-time-clock text-primary me-2 fs-5"></i>
                                <div>
                                    <strong class="d-block">Business Hours</strong>
                                    <small class="text-muted">Mon-Fri: 9AM-6PM | Sat: 10AM-4PM</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="card border-0 shadow-lg bg-light">
                        <div class="card-body p-4">
                            <h6 class="card-title mb-3">
                                <i class="hicon hicon-link text-primary me-1"></i>
                                Quick Links
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3">
                                    <a href="{{ route('tours.index') }}" class="text-decoration-none hover-primary d-flex align-items-center">
                                        <i class="hicon hicon-flights-one-ways text-primary me-2"></i>
                                        <span>Browse Tours</span>
                                        <i class="hicon hicon-thin-arrow-right ms-auto"></i>
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="{{ route('destinations.index') }}" class="text-decoration-none hover-primary d-flex align-items-center">
                                        <i class="hicon hicon-location text-primary me-2"></i>
                                        <span>View Destinations</span>
                                        <i class="hicon hicon-thin-arrow-right ms-auto"></i>
                                    </a>
                                </li>
                                <li class="mb-0">
                                    <a href="{{ route('about') }}" class="text-decoration-none hover-primary d-flex align-items-center">
                                        <i class="hicon hicon-badge text-primary me-2"></i>
                                        <span>About Us</span>
                                        <i class="hicon hicon-thin-arrow-right ms-auto"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Contact Content -->

    <!-- Map Section (Optional) -->
    <section class="p-bottom-90" data-aos="fade">
        <div class="container">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="ratio ratio-21x9">
                    <!-- Replace with your actual Google Maps embed code -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.187508327672!2d-7.5874302999999985!3d33.600439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7cdf0f067d3b7%3A0xfd8a058eb901b0e4!2sUnited%20Travel%20%26%20Services!5e0!3m2!1sen!2sma!4v1760311070074!5m2!1sen!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- /Map Section -->

@endsection

@push('styles')
<style>
    /* Contact Stats Hover Effects */
    .contact-stat {
        transition: transform 0.3s ease;
        cursor: default;
    }

    .contact-stat:hover {
        transform: translateY(-5px);
    }

    .contact-stat i {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .contact-stat:hover i {
        transform: scale(1.1);
        color: var(--bs-primary) !important;
    }

    /* Form Input Enhancements */
    .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    .form-label {
        font-weight: 500;
        color: #495057;
    }

    /* Contact Info Hover Effects */
    .hover-primary {
        transition: color 0.3s ease, transform 0.3s ease;
        display: inline-block;
    }

    .hover-primary:hover {
        color: var(--bs-primary) !important;
        transform: translateX(5px);
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

    /* Card Animations */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    /* Quick Links Hover */
    .list-unstyled li a {
        padding: 0.5rem;
        border-radius: 0.375rem;
        transition: background-color 0.3s ease, padding-left 0.3s ease;
    }

    .list-unstyled li a:hover {
        background-color: rgba(13, 110, 253, 0.05);
        padding-left: 1rem;
    }

    /* Map Container Enhancement */
    .ratio iframe {
        border-radius: 0.5rem;
    }

    /* Submit Button Enhancement */
    .btn-primary {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    /* Mobile Optimizations */
    @media (max-width: 991px) {
        .sticky-top {
            position: relative !important;
            top: 0 !important;
        }
        
        .contact-stat {
            padding: 1rem;
        }
    }

    /* Alert Animations */
    .alert {
        animation: slideDown 0.5s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Input Icon Indicators */
    .form-control:valid {
        border-color: #198754;
    }

    /* Card Header Enhancement */
    .card-header {
        border-bottom: 3px solid rgba(255, 255, 255, 0.2);
    }

    /* Business Hours Footer */
    .card-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
</style>
@endpush
