<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        'title_ne', 'title_en', 'slogan_ne', 'slogan_en', 'main_logo', 
        'alt_logo', 'phone_no', 'email', 'established_year', 'description_ne', 
        'description_en', 'socialmedia', 'google_map', 'is_active'
    ];

  
    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class, 'socialmedia');
    }
}

