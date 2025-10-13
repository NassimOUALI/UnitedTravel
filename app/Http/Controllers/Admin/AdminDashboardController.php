<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\Announcement;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get statistics
        $stats = [
            'destinations' => Destination::count(),
            'tours' => Tour::count(),
            'users' => User::count(),
            'discounts' => Discount::count(),
        ];

        // Get recent data
        $recentDestinations = Destination::latest()->take(5)->get();
        $recentTours = Tour::with('discount')->latest()->take(5)->get();
        $recentAnnouncements = Announcement::where('visible', true)->latest()->take(5)->get();
        $activeDiscounts = Discount::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentDestinations',
            'recentTours',
            'recentAnnouncements',
            'activeDiscounts'
        ));
    }
}

