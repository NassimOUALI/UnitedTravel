@props(['title', 'subtitle' => 'Explore United Travels', 'image' => 'assets/img/hero/h2.jpg'])

<div id="heroCarousel" class="carousel slide hero-style hero-style-1 hero-v1" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="hero-item carousel-item active">
            <div class="hero-bg">
                <img src="{{ asset($image) }}" alt="{{ $title }}">
            </div>
            <div class="hero-caption text-sm-start">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-xxl-6 col-xl-7 col-md-10">
                            <div class="hero-sub-title">
                                <span>{{ $subtitle }}</span>
                            </div>
                            <h2 class="display-3 hero-title">
                                {{ $title }}
                            </h2>
                            <div class="hero-action">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

