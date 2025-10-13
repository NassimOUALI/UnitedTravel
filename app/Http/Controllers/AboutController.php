<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page.
     */
    public function index()
    {
        // SEO Data
        $seoTitle = 'About Us';
        $seoDescription = 'Learn about United Travels - Your trusted partner for premium travel experiences in Morocco. Discover our story, mission, and commitment to exceptional service.';
        $seoKeywords = [
            'about United Travels',
            'Morocco travel agency',
            'tour operator Morocco',
            'travel company Casablanca',
            'premium tours Morocco'
        ];
        $seoImage = asset('assets/img/logos/logo.png');
        $seoUrl = route('about');

        return view('about', compact(
            'seoTitle',
            'seoDescription',
            'seoKeywords',
            'seoImage',
            'seoUrl'
        ));
    }
}

