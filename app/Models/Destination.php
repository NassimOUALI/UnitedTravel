<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'location',
    ];

    /**
     * The tours that belong to the destination.
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_destination');
    }

    /**
     * Get all images for the destination.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->orderBy('order');
    }

    /**
     * Get the primary/featured image.
     */
    public function primaryImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_primary', true);
    }

    /**
     * Get the image path (fallback to old image_path or first image).
     */
    public function getImageAttribute()
    {
        // Try new images first (check if relationship is loaded and has items)
        if ($this->relationLoaded('images') && $this->images->count() > 0) {
            return $this->images->first()->path;
        }
        
        // Fall back to old image_path
        return $this->attributes['image_path'] ?? null;
    }
}

