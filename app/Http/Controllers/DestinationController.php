<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    /**
     * Display a listing of destinations.
     */
    public function index(Request $request)
    {
        $query = Destination::with(['tours', 'images']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $destinations = $query->latest()->paginate(12)->withQueryString();

        return view('destinations.index', compact('destinations'));
    }

    /**
     * Display the specified destination.
     */
    public function show(Destination $destination)
    {
        $destination->load(['tours.discount', 'images']);
        
        // Get related destinations from the same location
        $relatedDestinations = Destination::with('images')
            ->where('location', $destination->location)
            ->where('id', '!=', $destination->id)
            ->take(3)
            ->get();

        // SEO Data
        $seoTitle = $destination->name . ' - Travel Destination';
        $seoDescription = Str::limit($destination->description, 155);
        $seoKeywords = [
            $destination->name,
            $destination->location,
            'Morocco destination',
            'travel to ' . $destination->name,
            $destination->name . ' tours'
        ];
        $seoImage = $destination->image_path;
        $seoUrl = route('destinations.show', $destination);
        $seoSchema = \App\Helpers\SeoHelper::destinationSchema($destination);

        return view('destinations.show', compact(
            'destination', 
            'relatedDestinations',
            'seoTitle',
            'seoDescription',
            'seoKeywords',
            'seoImage',
            'seoUrl',
            'seoSchema'
        ));
    }
}
