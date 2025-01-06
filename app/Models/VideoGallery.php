<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoGallery extends Model
{
    use HasFactory;

    // Specify the fillable fields
    protected $fillable = [
        'title_ne',
        'title_en',
        'videos',
        'url',
        'description_ne',
        'description_en',
        'is_featured',
        'is_active',
    ];

   
}
