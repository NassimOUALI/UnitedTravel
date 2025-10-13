<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Tour;
use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get featured destinations (limit to 6)
        $featuredDestinations = Destination::with('images')
            ->latest()
            ->take(6)
            ->get();

        // Get featured tours (limit to 6)
        $featuredTours = Tour::with(['discount', 'destinations', 'images'])
            ->where('is_price_defined', true)
            ->latest()
            ->take(6)
            ->get();

        // Get visible announcements (limit to 4)
        $announcements = Announcement::where('visible', true)
            ->latest()
            ->take(4)
            ->get();

        // Get counts for stats
        $toursCount = Tour::count();
        $destinationsCount = Destination::count();

        // SEO Data
        $seoTitle = null; // Will use default from SeoHelper
        $seoDescription = 'Discover Morocco with United Travels. Explore ' . $destinationsCount . ' destinations and ' . $toursCount . ' premium tour packages. Book your dream vacation today!';
        $seoKeywords = [
            'Morocco travel',
            'Morocco tours',
            'travel packages Morocco',
            'Casablanca tours',
            'Marrakech tours',
            'Morocco vacation',
            'United Travels'
        ];
        $seoImage = asset('assets/img/logos/logo.png');
        $seoUrl = route('home');

        return view('home', compact(
            'featuredDestinations',
            'featuredTours',
            'announcements',
            'toursCount',
            'destinationsCount',
            'seoTitle',
            'seoDescription',
            'seoKeywords',
            'seoImage',
            'seoUrl'
        ));
    }
}

