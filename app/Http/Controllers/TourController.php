<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourController extends Controller
{
    /**
     * Display a listing of tours.
     */
    public function index(Request $request)
    {
        $query = Tour::with(['destinations', 'discount', 'images']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by destination
        if ($request->filled('destination')) {
            $query->whereHas('destinations', function($q) use ($request) {
                $q->where('destinations.id', $request->destination);
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by discount
        if ($request->filled('has_discount') && $request->has_discount) {
            $query->whereNotNull('discount_id');
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest();
        }

        $tours = $query->paginate(9);
        $destinations = Destination::all();

        return view('tours.index', compact('tours', 'destinations'));
    }

    /**
     * Display the specified tour.
     */
    public function show(Tour $tour)
    {
        $tour->load(['destinations', 'discount', 'images', 'attachments']);
        
        // Get related tours from same destinations
        $relatedTours = Tour::with(['destinations', 'discount', 'images'])
            ->whereHas('destinations', function($q) use ($tour) {
                $q->whereIn('destinations.id', $tour->destinations->pluck('id'));
            })
            ->where('id', '!=', $tour->id)
            ->take(3)
            ->get();

        // SEO Data
        $seoTitle = $tour->title;
        $seoDescription = Str::limit($tour->description, 155);
        $seoKeywords = array_merge(
            [$tour->title],
            $tour->destinations->pluck('name')->toArray(),
            ['Morocco tour', 'travel package']
        );
        $seoImage = $tour->image_path;
        $seoUrl = route('tours.show', $tour);
        $seoSchema = \App\Helpers\SeoHelper::tourSchema($tour);

        return view('tours.show', compact(
            'tour', 
            'relatedTours',
            'seoTitle',
            'seoDescription',
            'seoKeywords',
            'seoImage',
            'seoUrl',
            'seoSchema'
        ));
    }
}
