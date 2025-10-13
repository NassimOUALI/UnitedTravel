<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Destination;
use App\Models\Announcement;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate the sitemap XML
     */
    public function index()
    {
        $tours = Tour::latest()->get();
        $destinations = Destination::latest()->get();
        $announcements = Announcement::where('visible', true)->latest()->get();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . url('/') . '</loc>';
        $sitemap .= '<lastmod>' . now()->toW3cString() . '</lastmod>';
        $sitemap .= '<changefreq>daily</changefreq>';
        $sitemap .= '<priority>1.0</priority>';
        $sitemap .= '</url>';

        // Static pages
        $staticPages = [
            ['url' => '/about', 'priority' => '0.8'],
            ['url' => '/contact', 'priority' => '0.8'],
            ['url' => '/tours', 'priority' => '0.9'],
            ['url' => '/destinations', 'priority' => '0.9'],
        ];

        foreach ($staticPages as $page) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url($page['url']) . '</loc>';
            $sitemap .= '<lastmod>' . now()->toW3cString() . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>' . $page['priority'] . '</priority>';
            $sitemap .= '</url>';
        }

        // Tours
        foreach ($tours as $tour) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('tours.show', $tour) . '</loc>';
            $sitemap .= '<lastmod>' . $tour->updated_at->toW3cString() . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            if ($tour->image_path) {
                $sitemap .= '<image:image xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
                $sitemap .= '<image:loc>' . asset($tour->image_path) . '</image:loc>';
                $sitemap .= '<image:title>' . htmlspecialchars($tour->title) . '</image:title>';
                $sitemap .= '</image:image>';
            }
            $sitemap .= '</url>';
        }

        // Destinations
        foreach ($destinations as $destination) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('destinations.show', $destination) . '</loc>';
            $sitemap .= '<lastmod>' . $destination->updated_at->toW3cString() . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.7</priority>';
            if ($destination->image_path) {
                $sitemap .= '<image:image xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
                $sitemap .= '<image:loc>' . asset($destination->image_path) . '</image:loc>';
                $sitemap .= '<image:title>' . htmlspecialchars($destination->name) . '</image:title>';
                $sitemap .= '</image:image>';
            }
            $sitemap .= '</url>';
        }

        $sitemap .= '</urlset>';

        return response($sitemap, 200)->header('Content-Type', 'text/xml');
    }
}
