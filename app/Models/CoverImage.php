<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_en',
        'title_ne',
        'image',
        'description_en',
        'description_ne',
        'is_active',
    ];
}


