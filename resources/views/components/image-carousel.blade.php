@props(['images', 'itemId', 'fallbackImage' => null, 'altPrefix' => 'Image'])

@php
    $carouselId = 'carousel-' . $itemId;
    $hasImages = $images && $images->count() > 0;
    $imageCollection = $hasImages ? $images : collect([]);
@endphp

@if($hasImages)
    <!-- Image Carousel -->
    <div id="{{ $carouselId }}" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="3000">
        @if($imageCollection->count() > 1)
            <!-- Indicators -->
            <div class="carousel-indicators">
                @foreach($imageCollection as $index => $image)
                    <button type="button" 
                            data-bs-target="#{{ $carouselId }}" 
                            data-bs-slide-to="{{ $index }}" 
                            class="{{ $index === 0 ? 'active' : '' }}" 
                            aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                            aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
        @endif
        
        <!-- Carousel Items -->
        <div class="carousel-inner h-100">
            @foreach($imageCollection as $index => $image)
                <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('public/' . $image->path) }}" 
                         class="d-block w-100 h-100" 
                         alt="{{ $image->alt_text ?? $altPrefix . ' ' . ($index + 1) }}"
                         style="object-fit: cover; object-position: center;">
                </div>
            @endforeach
        </div>
        
        @if($imageCollection->count() > 1)
            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
@elseif($fallbackImage)
    <!-- Single Fallback Image -->
    <img src="{{ asset($fallbackImage) }}" 
         class="d-block w-100 h-100" 
         alt="{{ $altPrefix }}"
         style="object-fit: cover; object-position: center;">
@else
    <!-- Placeholder -->
    <div class="d-flex align-items-center justify-content-center bg-light h-100">
        <i class="hicon hicon-backpack" style="font-size: 64px; color: #ccc;"></i>
    </div>
@endif

@push('styles')
<style>
    .carousel-item img {
        min-height: 100%;
    }
    
    .carousel-indicators {
        margin-bottom: 0.5rem;
        z-index: 5;
    }
    
    .carousel-indicators [data-bs-target] {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        opacity: 0.6;
    }
    
    .carousel-indicators .active {
        opacity: 1;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        opacity: 0;
        transition: opacity 0.3s ease;
        width: 15%;
    }
    
    .carousel:hover .carousel-control-prev,
    .carousel:hover .carousel-control-next {
        opacity: 0.8;
    }
    
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1 !important;
    }
    
    /* Pause carousel on hover */
    .carousel:hover {
        animation-play-state: paused;
    }
</style>
@endpush

