<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard (for all authenticated users).
     *
     * @return \Illuminate\View\View
     */
    public function userDashboard()
    {
        $user = Auth::user();
        
        // TODO: Get user's bookings when booking system is implemented
        $bookings = collect([]); // Placeholder
        $upcomingBookings = collect([]); // Placeholder
        $pastBookings = collect([]); // Placeholder
        
        // Get user's wishlist count
        $wishlistCount = $user->wishlists()->count();

        return view('user.dashboard', compact(
            'user',
            'bookings',
            'upcomingBookings',
            'pastBookings',
            'wishlistCount'
        ));
    }
}


