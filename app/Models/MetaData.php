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
}

