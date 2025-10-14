@props(['images', 'itemId', 'fallbackImage' => null, 'title' => ''])

@php
    $carouselId = 'gallery-' . $itemId;
    $hasImages = $images && $images->count() > 0;
    $imageCollection = $hasImages ? $images : collect([]);
@endphp

<div class="image-gallery">
    @if($hasImages)
        <!-- Main Carousel -->
        <div id="{{ $carouselId }}" class="carousel slide mb-3" data-bs-ride="carousel">
            <!-- Carousel Inner -->
            <div class="carousel-inner rounded">
                @foreach($imageCollection as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('public/' . $image->path) }}" 
                             class="d-block w-100 gallery-main-image" 
                             alt="{{ $image->alt_text ?? $title . ' - Image ' . ($index + 1) }}"
                             style="height: 500px; object-fit: cover; object-position: center;">
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
                
                <!-- Image Counter -->
                <div class="position-absolute bottom-0 end-0 m-3 bg-dark bg-opacity-75 text-white px-3 py-2 rounded">
                    <span class="current-slide">1</span> / {{ $imageCollection->count() }}
                </div>
            @endif
        </div>
        
        @if($imageCollection->count() > 1)
            <!-- Thumbnail Navigation -->
            <div class="gallery-thumbnails">
                <div class="row g-2">
                    @foreach($imageCollection as $index => $image)
                        <div class="col-auto">
                            <button type="button" 
                                    class="thumbnail-btn {{ $index === 0 ? 'active' : '' }}" 
                                    data-bs-target="#{{ $carouselId }}" 
                                    data-bs-slide-to="{{ $index }}"
                                    aria-label="View image {{ $index + 1 }}">
                                <img src="{{ asset('public/' . $image->path) }}" 
                                     alt="Thumbnail {{ $index + 1 }}"
                                     class="img-thumbnail"
                                     style="width: 100px; height: 70px; object-fit: cover;">
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @elseif($fallbackImage)
        <!-- Single Fallback Image -->
        <div class="rounded overflow-hidden">
            <img src="{{ asset($fallbackImage) }}" 
                 class="d-block w-100" 
                 alt="{{ $title }}"
                 style="height: 500px; object-fit: cover; object-position: center;">
        </div>
    @else
        <!-- Placeholder -->
        <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 500px;">
            <div class="text-center">
                <i class="hicon hicon-backpack text-muted" style="font-size: 80px;"></i>
                <p class="text-muted mt-3">No images available</p>
            </div>
        </div>
    @endif
</div>

@push('styles')
<style>
    .image-gallery {
        margin-bottom: 2rem;
    }
    
    .gallery-main-image {
        border-radius: 0.5rem;
    }
    
    .gallery-thumbnails {
        margin-top: 1rem;
    }
    
    .thumbnail-btn {
        border: 3px solid transparent;
        padding: 0;
        background: none;
        transition: all 0.3s ease;
        border-radius: 0.25rem;
        overflow: hidden;
    }
    
    .thumbnail-btn:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .thumbnail-btn.active {
        border-color: #667eea;
        box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
    }
    
    .thumbnail-btn img {
        display: block;
        margin: 0;
    }
    
    @media (max-width: 768px) {
        .gallery-main-image {
            height: 300px !important;
        }
        
        .thumbnail-btn img {
            width: 60px !important;
            height: 50px !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('{{ $carouselId }}');
        if (carousel) {
            const thumbnails = document.querySelectorAll('[data-bs-target="#{{ $carouselId }}"]');
            const currentSlideElement = carousel.querySelector('.current-slide');
            
            carousel.addEventListener('slid.bs.carousel', function (event) {
                // Update active thumbnail
                thumbnails.forEach(thumb => thumb.classList.remove('active'));
                if (thumbnails[event.to]) {
                    thumbnails[event.to].classList.add('active');
                }
                
                // Update counter
                if (currentSlideElement) {
                    currentSlideElement.textContent = event.to + 1;
                }
            });
        }
    });
</script>
@endpush

