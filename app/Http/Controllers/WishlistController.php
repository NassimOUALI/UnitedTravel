<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     */
    public function index()
    {
        $user = Auth::user();
        $wishlistItems = $user->wishlists()->with(['tour.destinations', 'tour.discount'])->latest()->get();
        
        return view('wishlist.index', compact('wishlistItems'));
    }

    /**
     * Add a tour to the wishlist.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
        ]);

        $user = Auth::user();
        $tourId = $request->tour_id;

        // Check if already in wishlist
        $exists = Wishlist::where('user_id', $user->id)
                         ->where('tour_id', $tourId)
                         ->exists();

        if ($exists) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This tour is already in your wishlist!'
                ], 409);
            }
            return back()->with('error', 'This tour is already in your wishlist!');
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'tour_id' => $tourId,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Tour added to wishlist!',
                'wishlist_count' => $user->wishlists()->count()
            ]);
        }

        return back()->with('success', 'Tour added to wishlist!');
    }

    /**
     * Remove a tour from the wishlist.
     */
    public function destroy(Request $request, $tourId)
    {
        $user = Auth::user();

        $wishlistItem = Wishlist::where('user_id', $user->id)
                               ->where('tour_id', $tourId)
                               ->first();

        if (!$wishlistItem) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tour not found in wishlist!'
                ], 404);
            }
            return back()->with('error', 'Tour not found in wishlist!');
        }

        $wishlistItem->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Tour removed from wishlist!',
                'wishlist_count' => $user->wishlists()->count()
            ]);
        }

        return back()->with('success', 'Tour removed from wishlist!');
    }

    /**
     * Check if a tour is in the user's wishlist.
     */
    public function check($tourId)
    {
        if (!Auth::check()) {
            return response()->json(['in_wishlist' => false]);
        }

        $inWishlist = Wishlist::where('user_id', Auth::id())
                             ->where('tour_id', $tourId)
                             ->exists();

        return response()->json(['in_wishlist' => $inWishlist]);
    }
}
