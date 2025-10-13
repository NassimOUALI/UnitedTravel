@php
use App\Helpers\SeoHelper;

$pageTitle = $title ?? null;
$pageDescription = $description ?? null;
$pageKeywords = $keywords ?? [];
$pageImage = $image ?? null;
$pageUrl = $url ?? null;
$structuredData = $schema ?? null;
@endphp

<!-- Primary Meta Tags -->
<title>{{ SeoHelper::title($pageTitle) }}</title>
<meta name="title" content="{{ SeoHelper::title($pageTitle) }}">
<meta name="description" content="{{ SeoHelper::description($pageDescription) }}">
<meta name="keywords" content="{{ SeoHelper::keywords($pageKeywords) }}">
<meta name="author" content="United Travels">
<meta name="robots" content="index, follow">
<meta name="language" content="English">
<meta name="revisit-after" content="7 days">

<!-- Canonical URL -->
<link rel="canonical" href="{{ SeoHelper::canonical($pageUrl) }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ SeoHelper::canonical($pageUrl) }}">
<meta property="og:title" content="{{ SeoHelper::title($pageTitle) }}">
<meta property="og:description" content="{{ SeoHelper::description($pageDescription) }}">
<meta property="og:image" content="{{ SeoHelper::ogImage($pageImage) }}">
<meta property="og:site_name" content="United Travels">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ SeoHelper::canonical($pageUrl) }}">
<meta property="twitter:title" content="{{ SeoHelper::title($pageTitle) }}">
<meta property="twitter:description" content="{{ SeoHelper::description($pageDescription) }}">
<meta property="twitter:image" content="{{ SeoHelper::ogImage($pageImage) }}">

<!-- Additional Meta Tags for Better SEO -->
<meta name="theme-color" content="#667eea">
<meta name="msapplication-TileColor" content="#667eea">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- Geo Tags for Local SEO -->
<meta name="geo.region" content="MA">
<meta name="geo.placename" content="Casablanca">
<meta name="geo.position" content="33.5731;-7.5898">
<meta name="ICBM" content="33.5731, -7.5898">

<!-- Organization Schema (Always included) -->
<script type="application/ld+json">
@json(SeoHelper::organizationSchema(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
</script>

<!-- Page-Specific Structured Data -->
@if($structuredData)
<script type="application/ld+json">
@json($structuredData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
</script>
@endif

