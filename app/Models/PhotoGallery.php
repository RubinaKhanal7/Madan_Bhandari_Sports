<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    protected $fillable = [
        'title_ne',
        'title_en',
        'description_ne',
        'description_en',
        'images',
        'is_featured',
        'is_active',
        'meta_data_id'
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function metaData()
{
    return $this->belongsTo(Metadata::class, 'meta_data_id');
}
}