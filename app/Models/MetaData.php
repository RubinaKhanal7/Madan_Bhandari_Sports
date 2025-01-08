<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    use HasFactory;

    protected $fillable = [
        'metaTitle',
        'metaDescription',
        'metaKeywords',
        'slug',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function photoGallery()
    {
        return $this->hasOne(PhotoGallery::class);
    }
}

