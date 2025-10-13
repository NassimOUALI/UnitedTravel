<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'filename',
        'path',
        'type',
        'mime_type',
        'size',
        'order',
    ];

    /**
     * Get the tour that owns the attachment.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Get human-readable file size.
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if attachment is an image.
     */
    public function isImage()
    {
        return $this->type === 'image';
    }

    /**
     * Check if attachment is a PDF.
     */
    public function isPdf()
    {
        return $this->type === 'pdf';
    }
}
