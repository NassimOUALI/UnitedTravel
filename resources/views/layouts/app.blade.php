<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <x-seo 
        :title="$seoTitle ?? null"
        :description="$seoDescription ?? null"
        :keywords="$seoKeywords ?? []"
        :image="$seoImage ?? null"
        :url="$seoUrl ?? null"
        :schema="$seoSchema ?? null"
    />
    
    <!-- Favicons -->
    <link href="{{ asset('assets/img/logos/favicon.png') }}" rel="shortcut icon" type="image/png">
    <link href="{{ asset('assets/img/logos/favicon.png') }}" rel="apple-touch-icon">
    
    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/theme-1.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme-3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/logo-sizing.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>

<body>

    <!-- Preloader -->
    <x-preloader />
    <!-- /Preloader -->

    <!-- Header -->
    <x-header />
    <!-- /Header -->

    <!-- Main -->    
    <main>
        @yield('content')
    </main>
    <!-- /Main -->    

    <!-- Footer -->
    <x-footer />
    <!-- /Footer -->

    <!-- Scroll top -->
    <a href="#" class="scroll-top">
        <i class="hicon hicon-thin-arrow-up"></i>
    </a>
    <!-- /Scroll top -->

    <script defer src="{{ asset('assets/js/theme-1.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/theme-2.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/theme-3.min.js') }}"></script>
    
    @stack('scripts')

</body>

</html>

