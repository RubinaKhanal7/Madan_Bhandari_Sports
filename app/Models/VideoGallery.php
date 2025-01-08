<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ne', 
        'title_en', 
        'videos', 
        'url', 
        'description_ne', 
        'description_en', 
        'is_featured', 
        'is_active', 
        'meta_data_id',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function metaData()
    {
        return $this->belongsTo(MetaData::class, 'meta_data_id');
    }
}
