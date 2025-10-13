<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Discount;
use App\Http\Requests\Admin\StoreTourRequest;
use App\Http\Requests\Admin\UpdateTourRequest;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::with(['destinations', 'discount', 'images'])->latest()->paginate(15);
        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tour = new Tour(); // Empty tour object for the form
        $destinations = Destination::orderBy('name')->get();
        $discounts = Discount::orderBy('name')->get();
        return view('admin.tours.create', compact('tour', 'destinations', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request)
    {
        $data = $request->validated();

        // Extract destinations for sync
        $destinations = $data['destinations'] ?? [];
        unset($data['destinations']);
        
        // Remove images from data (we'll handle them separately)
        unset($data['images']);

        // Create the tour
        $tour = Tour::create($data);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imageCount = min(count($images), 5); // Limit to 5 images
            $primaryIndex = $request->input('primary_image_new', 0); // Default to first image
            
            for ($i = 0; $i < $imageCount; $i++) {
                $image = $images[$i];
                $filename = time() . '_' . $i . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('tours', $filename, 'public');
                
                // Create image record
                $tour->images()->create([
                    'path' => 'storage/' . $path,
                    'order' => $i,
                    'is_primary' => ($i == $primaryIndex), // User-selected primary image
                    'alt_text' => $tour->title . ' - Image ' . ($i + 1),
                ]);
            }
        }

        // Sync destinations
        if (!empty($destinations)) {
            $tour->destinations()->sync($destinations);
        }

        // Handle attachment uploads
        if ($request->hasFile('attachments')) {
            $attachments = $request->file('attachments');
            $attachmentCount = min(count($attachments), 5); // Limit to 5 attachments
            
            for ($i = 0; $i < $attachmentCount; $i++) {
                $file = $attachments[$i];
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $i . '_' . $originalName;
                $path = $file->storeAs('tour-attachments', $filename, 'public');
                
                // Determine file type
                $mimeType = $file->getMimeType();
                $fileType = str_starts_with($mimeType, 'image/') ? 'image' : 'pdf';
                
                // Create attachment record
                $tour->attachments()->create([
                    'filename' => $originalName,
                    'path' => 'storage/' . $path,
                    'type' => $fileType,
                    'mime_type' => $mimeType,
                    'size' => $file->getSize(),
                    'order' => $i,
                ]);
            }
        }

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        $tour->load(['destinations', 'discount']);
        return view('admin.tours.show', compact('tour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        $destinations = Destination::orderBy('name')->get();
        $discounts = Discount::orderBy('name')->get();
        $tour->load(['destinations', 'images', 'attachments']);
        return view('admin.tours.edit', compact('tour', 'destinations', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        $data = $request->validated();

        // Extract destinations for sync
        $destinations = $data['destinations'] ?? [];
        unset($data['destinations']);
        
        // Remove images from data (we'll handle them separately)
        unset($data['images']);

        // Update the tour
        $tour->update($data);

        // Handle image deletion
        if ($request->filled('images_to_delete')) {
            $imagesToDelete = explode(',', $request->images_to_delete);
            foreach ($imagesToDelete as $imageId) {
                $image = $tour->images()->find($imageId);
                if ($image) {
                    // Delete file from storage
                    if (Storage::disk('public')->exists(str_replace('storage/', '', $image->path))) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $image->path));
                    }
                    // Delete database record
                    $image->delete();
                }
            }
        }

        // Handle primary image change for existing images
        if ($request->filled('primary_image_existing')) {
            // Reset all images to not primary
            $tour->images()->update(['is_primary' => false]);
            // Set selected image as primary
            $tour->images()->where('id', $request->primary_image_existing)->update(['is_primary' => true]);
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $currentImageCount = $tour->images()->count();
            $availableSlots = 5 - $currentImageCount;
            $imageCount = min(count($images), $availableSlots);
            $primaryIndex = $request->input('primary_image_new', 0); // Default to first new image
            
            // If uploading new images and one should be primary, reset existing images
            if ($imageCount > 0 && $request->filled('primary_image_new')) {
                $tour->images()->update(['is_primary' => false]);
            }
            
            for ($i = 0; $i < $imageCount; $i++) {
                $image = $images[$i];
                $filename = time() . '_' . $i . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('tours', $filename, 'public');
                
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
                $tour->images()->create([
                    'path' => 'storage/' . $path,
                    'order' => $currentImageCount + $i,
                    'is_primary' => $isPrimary,
                    'alt_text' => $tour->title . ' - Image ' . ($currentImageCount + $i + 1),
                ]);
            }
        }

        // Sync destinations
        $tour->destinations()->sync($destinations);

        // Handle attachment deletion
        if ($request->filled('attachments_to_delete')) {
            $attachmentsToDelete = explode(',', $request->attachments_to_delete);
            foreach ($attachmentsToDelete as $attachmentId) {
                $attachment = $tour->attachments()->find($attachmentId);
                if ($attachment) {
                    // Delete file from storage
                    if (Storage::disk('public')->exists(str_replace('storage/', '', $attachment->path))) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $attachment->path));
                    }
                    // Delete database record
                    $attachment->delete();
                }
            }
        }

        // Handle new attachment uploads
        if ($request->hasFile('attachments')) {
            $attachments = $request->file('attachments');
            $currentAttachmentCount = $tour->attachments()->count();
            $availableSlots = 5 - $currentAttachmentCount;
            $attachmentCount = min(count($attachments), $availableSlots);
            
            for ($i = 0; $i < $attachmentCount; $i++) {
                $file = $attachments[$i];
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $i . '_' . $originalName;
                $path = $file->storeAs('tour-attachments', $filename, 'public');
                
                // Determine file type
                $mimeType = $file->getMimeType();
                $fileType = str_starts_with($mimeType, 'image/') ? 'image' : 'pdf';
                
                // Create attachment record
                $tour->attachments()->create([
                    'filename' => $originalName,
                    'path' => 'storage/' . $path,
                    'type' => $fileType,
                    'mime_type' => $mimeType,
                    'size' => $file->getSize(),
                    'order' => $currentAttachmentCount + $i,
                ]);
            }
        }

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        // Delete all associated images
        foreach ($tour->images as $image) {
            if (Storage::disk('public')->exists(str_replace('storage/', '', $image->path))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $image->path));
            }
            $image->delete();
        }
        
        // Delete all associated attachments
        foreach ($tour->attachments as $attachment) {
            if (Storage::disk('public')->exists(str_replace('storage/', '', $attachment->path))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $attachment->path));
            }
            $attachment->delete();
        }
        
        // Delete old single image if exists (for backward compatibility)
        if ($tour->image_path && Storage::disk('public')->exists(str_replace('storage/', '', $tour->image_path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $tour->image_path));
        }

        $tour->delete();

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour deleted successfully!');
    }
}
