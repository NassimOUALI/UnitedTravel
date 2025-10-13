<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Generate SEO-friendly title
     */
    public static function title($pageTitle = null, $siteName = 'United Travels')
    {
        if ($pageTitle) {
            return $pageTitle . ' - ' . $siteName;
        }
        return $siteName . ' - Premium Travel & Tour Packages in Morocco';
    }

    /**
     * Generate meta description
     */
    public static function description($description = null)
    {
        return $description ?? 'Discover Morocco with United Travels. Premium tour packages, exclusive destinations, and unforgettable experiences. Book your dream vacation today!';
    }

    /**
     * Generate keywords
     */
    public static function keywords($keywords = [])
    {
        $defaultKeywords = [
            'Morocco tours',
            'travel packages Morocco',
            'Morocco destinations',
            'Casablanca tours',
            'Marrakech travel',
            'Morocco vacation',
            'tour operator Morocco',
            'United Travels',
            'Morocco tourism',
            'desert tours Morocco'
        ];

        $allKeywords = array_merge($defaultKeywords, $keywords);
        return implode(', ', array_unique($allKeywords));
    }

    /**
     * Generate canonical URL
     */
    public static function canonical($url = null)
    {
        return $url ?? url()->current();
    }

    /**
     * Generate Open Graph image
     */
    public static function ogImage($image = null)
    {
        if ($image) {
            // If it's a relative path, make it absolute
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                return asset($image);
            }
            return $image;
        }
        return asset('assets/img/logos/logo.png');
    }

    /**
     * Generate structured data for Organization
     */
    public static function organizationSchema()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'TravelAgency',
            'name' => 'United Travels',
            'description' => 'Premium travel and tour packages in Morocco',
            'url' => url('/'),
            'logo' => asset('assets/img/logos/logo.png'),
            'image' => asset('assets/img/logos/logo.png'),
            'telephone' => '+212520697004',
            'email' => 'unitedtravelandservice@gmail.com',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '164 boulevard ambassadeur ben Aicha, Roches noires',
                'addressLocality' => 'Casablanca',
                'addressCountry' => 'MA'
            ],
            'sameAs' => [
                // Add your social media links here
                // 'https://www.facebook.com/unitedtravels',
                // 'https://www.instagram.com/unitedtravels',
                // 'https://www.twitter.com/unitedtravels'
            ]
        ];
    }

    /**
     * Generate structured data for Tour
     */
    public static function tourSchema($tour)
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'TouristTrip',
            'name' => $tour->title,
            'description' => $tour->description,
            'url' => route('tours.show', $tour),
        ];

        if ($tour->image_path) {
            $schema['image'] = asset($tour->image_path);
        }

        if ($tour->is_price_defined && $tour->price) {
            $schema['offers'] = [
                '@type' => 'Offer',
                'price' => $tour->price,
                'priceCurrency' => 'MAD',
                'availability' => 'https://schema.org/InStock'
            ];
        }

        if ($tour->destinations && $tour->destinations->count() > 0) {
            $schema['touristType'] = $tour->destinations->pluck('name')->toArray();
        }

        return $schema;
    }

    /**
     * Generate structured data for Destination
     */
    public static function destinationSchema($destination)
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'TouristDestination',
            'name' => $destination->name,
            'description' => $destination->description,
            'url' => route('destinations.show', $destination),
        ];

        if ($destination->image_path) {
            $schema['image'] = asset($destination->image_path);
        }

        if ($destination->location) {
            $schema['address'] = [
                '@type' => 'PostalAddress',
                'addressLocality' => $destination->name,
                'addressCountry' => 'MA'
            ];
        }

        return $schema;
    }

    /**
     * Generate breadcrumb schema
     */
    public static function breadcrumbSchema($items)
    {
        $listItems = [];
        $position = 1;

        foreach ($items as $name => $url) {
            $listItems[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $name,
                'item' => is_string($url) ? $url : url($url)
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems
        ];
    }
}

