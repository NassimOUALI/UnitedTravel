<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    /**
     * Generate dynamic robots.txt
     */
    public function index()
    {
        $robots = "# www.robotstxt.org/\n";
        $robots .= "# United Travels - Robots.txt\n\n";
        $robots .= "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /dashboard\n";
        $robots .= "Disallow: /login\n";
        $robots .= "Disallow: /register\n";
        $robots .= "Disallow: /logout\n";
        $robots .= "Disallow: /wishlist\n";
        $robots .= "Disallow: /profile\n";
        $robots .= "Disallow: /api/\n\n";
        $robots .= "# Sitemap\n";
        $robots .= "Sitemap: " . route('sitemap') . "\n\n";
        $robots .= "# Crawl-delay for nice crawling\n";
        $robots .= "Crawl-delay: 10\n";

        return response($robots, 200)->header('Content-Type', 'text/plain');
    }
}

