<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mou extends Model
{
    protected $fillable = [
        'state',
        'district',
        'local',
        'university',
        'description',
        'image',
        'other_images',
        'is_active',
        'is_featured'
    ];

    protected $casts = [
        'other_images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];
}