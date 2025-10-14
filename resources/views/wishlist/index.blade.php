@extends('layouts.app')

@section('title', 'My Wishlist - United Travels')

@section('content')

<!-- Page Title -->
<section class="hero hero-sm" data-aos="fade">
    <div class="hero-bg">
        <img src="{{ asset('assets/img/background/b4.jpg') }}" alt="Wishlist">
    </div>
    <div class="bg-content container">
        <div class="hero-page-title">
            <span class="hero-sub-title">Saved Tours</span>
            <h1 class="display-3 hero-title">My Wishlist</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </nav>
    </div>
</section>
<!-- /Page Title -->

<!-- Wishlist Content -->
<section class="p-top-90 p-bottom-90 bg-gray-gradient" data-aos="fade">
    <div class="container">
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="hicon hicon-confirmation-instant me-2"></i>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="hicon hicon-warning me-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Wishlist Header -->
        <div class="row mb-4">
            <div class="col-12 col-lg-8">
                <div class="block-title">
                    <h2 class="h3 title">Your Saved Tours</h2>
                    <p class="text-muted">You have {{ $wishlistItems->count() }} {{ Str::plural('tour', $wishlistItems->count()) }} in your wishlist</p>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <a href="{{ route('tours.index') }}" class="btn btn-primary">
                    <i class="hicon hicon-backpack me-1"></i>
                    Browse More Tours
                </a>
            </div>
        </div>

        @if($wishlistItems->count() > 0)
            <!-- Wishlist Items -->
            <div class="row g-4">
                @foreach($wishlistItems as $item)
                @php
                    $tour = $item->tour;
                @endphp
                <div class="col-12" id="wishlist-item-{{ $tour->id }}">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <!-- Tour Image -->
                                <div class="col-12 col-md-4 col-lg-3">
                                    @if($tour->image_path)
                                        <img src="{{ asset('public/' . $tour->image_path) }}" 
                                             alt="{{ $tour->title }}" 
                                             class="img-fluid rounded"
                                             style="width: 100%; height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 100%; height: 200px;">
                                            <i class="hicon hicon-backpack" style="font-size: 64px; color: #ccc;"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Tour Info -->
                                <div class="col-12 col-md-8 col-lg-6">
                                    <div class="h-100 d-flex flex-column">
                                        @if($tour->discount)
                                            <span class="badge bg-danger mb-2 align-self-start">{{ $tour->discount->percentage }}% OFF</span>
                                        @endif
                                        <h3 class="h4 mb-2">
                                            <a href="{{ route('tours.show', $tour) }}" class="text-decoration-none text-dark hover-primary">
                                                {{ $tour->title }}
                                            </a>
                                        </h3>
                                        <p class="text-muted mb-3">
                                            {{ Str::limit($tour->description, 150) }}
                                        </p>
                                        <div class="mt-auto">
                                            <div class="d-flex flex-wrap gap-3 small text-muted">
                                                @if($tour->destinations->count() > 0)
                                                <span>
                                                    <i class="hicon hicon-location me-1 text-primary"></i>
                                                    {{ $tour->destinations->first()->name }}
                                                </span>
                                                @endif
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
                                    </div>
                                </div>

                                <!-- Tour Actions -->
                                <div class="col-12 col-lg-3">
                                    <div class="h-100 d-flex flex-column justify-content-between">
                                        <!-- Price -->
                                        <div class="text-lg-center mb-3">
                                            @if($tour->is_price_defined && $tour->price)
                                                @if($tour->discount)
                                                    <div class="text-decoration-line-through text-muted small">
                                                        {{ format_price($tour->price, 2) }}
                                                    </div>
                                                    <div class="h3 text-primary mb-0">
                                                        {{ format_price($tour->price * (1 - $tour->discount->percentage / 100), 2) }}
                                                    </div>
                                                @else
                                                    <div class="h3 text-primary mb-0">
                                                        {{ format_price($tour->price, 2) }}
                                                    </div>
                                                @endif
                                                <small class="text-muted">per person</small>
                                            @else
                                                <span class="badge bg-secondary">Contact for Price</span>
                                            @endif
                                        </div>

                                        <!-- Actions -->
                                        <div class="d-flex flex-column gap-2">
                                            <a href="{{ route('tours.show', $tour) }}" class="btn btn-primary w-100">
                                                <i class="hicon hicon-thin-arrow-right me-1"></i>
                                                View Details
                                            </a>
                                            <form action="{{ route('wishlist.destroy', $tour) }}" method="POST" class="remove-from-wishlist-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger w-100">
                                                    <i class="hicon hicon-delete me-1"></i>
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Empty Wishlist -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5 text-center">
                            <div class="mb-4">
                                <i class="hicon hicon-menu-favorite text-muted" style="font-size: 80px;"></i>
                            </div>
                            <h3 class="h4 mb-3">Your Wishlist is Empty</h3>
                            <p class="text-muted mb-4">
                                Start adding tours to your wishlist to save them for later!
                            </p>
                            <a href="{{ route('tours.index') }}" class="btn btn-primary btn-lg">
                                <i class="hicon hicon-backpack me-2"></i>
                                Browse Tours
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</section>
<!-- /Wishlist Content -->

@endsection

@push('styles')
<style>
    .hover-primary:hover {
        color: var(--bs-primary) !important;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,.15) !important;
    }

    .btn {
        transition: transform 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@push('scripts')
<script>
    // Remove from wishlist with AJAX
    document.querySelectorAll('.remove-from-wishlist-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!confirm('Are you sure you want to remove this tour from your wishlist?')) {
                return;
            }

            const form = this;
            const button = form.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Removing...';

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    _method: 'DELETE'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Find and remove the wishlist item
                    const tourId = form.closest('[id^="wishlist-item-"]').id.split('-')[2];
                    const item = document.getElementById(`wishlist-item-${tourId}`);
                    
                    // Fade out and remove
                    item.style.transition = 'opacity 0.3s ease';
                    item.style.opacity = '0';
                    setTimeout(() => {
                        item.remove();
                        
                        // Check if wishlist is now empty
                        const remainingItems = document.querySelectorAll('[id^="wishlist-item-"]');
                        if (remainingItems.length === 0) {
                            location.reload();
                        }
                    }, 300);
                } else {
                    alert(data.message || 'Failed to remove tour from wishlist');
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                button.disabled = false;
                button.innerHTML = originalText;
            });
        });
    });
</script>
@endpush



