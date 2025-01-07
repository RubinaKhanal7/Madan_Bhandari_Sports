<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [ 
        'title_ne',
        'title_en',
        'description_ne',
        'description_en',
        'image',
        'is_active',
        'meta_data_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function metadata()
    {
        return $this->belongsTo(MetaData::class, 'meta_data_id');
    }
}
