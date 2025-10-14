<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Http\Requests\Admin\StoreDestinationRequest;
use App\Http\Requests\Admin\UpdateDestinationRequest;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::with('images')->latest()->paginate(15);
        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destination = new Destination(); // Empty destination object for the form
        return view('admin.destinations.create', compact('destination'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinationRequest $request)
    {
        $data = $request->validated();
        
        // Remove images from data (we'll handle them separately)
        unset($data['images']);

        // Create the destination
        $destination = Destination::create($data);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imageCount = min(count($images), 5); // Limit to 5 images
            $primaryIndex = $request->input('primary_image_new', 0); // Default to first image
            
            for ($i = 0; $i < $imageCount; $i++) {
                $image = $images[$i];
                $filename = time() . '_' . $i . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('destinations', $filename, 'public_direct');
                
                // Create image record
                $destination->images()->create([
                    'path' => 'storage/' . $path,
                    'order' => $i,
                    'is_primary' => ($i == $primaryIndex), // User-selected primary image
                    'alt_text' => $destination->name . ' - Image ' . ($i + 1),
                ]);
            }
        }

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination created successfully with ' . ($imageCount ?? 0) . ' images!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        $destination->load('tours');
        return view('admin.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        $destination->load('images'); // Load images for the form
        return view('admin.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        $data = $request->validated();
        
        // Remove images from data (we'll handle them separately)
        unset($data['images']);

        // Update the destination
        $destination->update($data);

        // Handle image deletion
        if ($request->filled('images_to_delete')) {
            $imagesToDelete = explode(',', $request->images_to_delete);
            foreach ($imagesToDelete as $imageId) {
                $image = $destination->images()->find($imageId);
                if ($image) {
                    // Delete file from storage
                    if (Storage::disk('public_direct')->exists(str_replace('storage/', '', $image->path))) {
                        Storage::disk('public_direct')->delete(str_replace('storage/', '', $image->path));
                    }
                    // Delete database record
                    $image->delete();
                }
            }
        }

        // Handle primary image change for existing images
        if ($request->filled('primary_image_existing')) {
            // Reset all images to not primary
            $destination->images()->update(['is_primary' => false]);
            // Set selected image as primary
            $destination->images()->where('id', $request->primary_image_existing)->update(['is_primary' => true]);
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $currentImageCount = $destination->images()->count();
            $availableSlots = 5 - $currentImageCount;
            $imageCount = min(count($images), $availableSlots);
            $primaryIndex = $request->input('primary_image_new', 0); // Default to first new image
            
            // If uploading new images and one should be primary, reset existing images
            if ($imageCount > 0 && $request->filled('primary_image_new')) {
                $destination->images()->update(['is_primary' => false]);
            }
            
            for ($i = 0; $i < $imageCount; $i++) {
                $image = $images[$i];
                $filename = time() . '_' . $i . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('destinations', $filename, 'public_direct');
                
                // Determine if this should be primary
                $isPrimary = false;
                if ($currentImageCount === 0 && $i == $primaryIndex) {
                    // No existing images, use selected new image as primary
                    $isPrimary = true;
                } elseif ($request->filled('primary_image_new') && $i == $primaryIndex) {
                    // User explicitly selected a new image as primary
                    $isPrimary = true;
                }
                
                // Create image record
                $destination->images()->create([
                    'path' => 'storage/' . $path,
                    'order' => $currentImageCount + $i,
                    'is_primary' => $isPrimary,
                    'alt_text' => $destination->name . ' - Image ' . ($currentImageCount + $i + 1),
                ]);
            }
        }

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        // Delete all associated images
        foreach ($destination->images as $image) {
            if (Storage::disk('public_direct')->exists(str_replace('storage/', '', $image->path))) {
                Storage::disk('public_direct')->delete(str_replace('storage/', '', $image->path));
            }
            $image->delete();
        }
        
        // Delete old single image if exists (for backward compatibility)
        if ($destination->image_path && Storage::disk('public_direct')->exists(str_replace('storage/', '', $destination->image_path))) {
            Storage::disk('public_direct')->delete(str_replace('storage/', '', $destination->image_path));
        }

        $destination->delete();

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully!');
    }
}
