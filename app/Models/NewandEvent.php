<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewandEvent extends Model
{
    use HasFactory,  Sluggable;
    protected $table = "newsand_events";
    protected $fillable = ['title', 'image', 'content','status'];

    /**
     * Define sluggable configuration for the model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}