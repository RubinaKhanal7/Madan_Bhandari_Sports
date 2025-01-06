<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoGallery extends Model
{
    use HasFactory;  // Removed Sluggable

    protected $fillable = [
        'title_en',
        'title_ne',
        'description_en',
        'description_ne',
        'images',
        'is_active',
        'is_featured'
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    // Remove any slug-related methods

    public function getImagesAttribute($value)
{
    // Check if the value is already an array, return it as is
    return is_array($value) ? $value : json_decode($value, true);
}


    // Optional: Add mutators if you need to manipulate data before saving
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = is_array($value) ? json_encode($value) : $value;
    }

    // Scope for active galleries
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for featured galleries
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}