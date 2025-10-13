<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'duration',
        'price',
        'is_price_defined',
        'image_path',
        'start_date',
        'end_date',
        'discount_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_price_defined' => 'boolean',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    /**
     * Get the discount associated with the tour.
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * The destinations that belong to the tour.
     */
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'tour_destination');
    }

    /**
     * Get the wishlist items for the tour.
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Get the users who have wishlisted this tour.
     */
    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    /**
     * Get all images for the tour.
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

    /**
     * Get all attachments for the tour.
     */
    public function attachments()
    {
        return $this->hasMany(TourAttachment::class)->orderBy('order');
    }
}

