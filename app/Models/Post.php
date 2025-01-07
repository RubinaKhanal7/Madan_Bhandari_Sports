<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $casts = [
        'pdf' => 'array',
        'other_images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    protected $fillable = [
        'title_ne', 'title_en', 'description_ne', 'description_en', 
        'image', 'pdf', 'other_images', 'category_id', 
        'is_featured', 'is_active', 'meta_data_id'
    ];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function metadata()
    {
        return $this->belongsTo(MetaData::class, 'meta_data_id');
    }
}
