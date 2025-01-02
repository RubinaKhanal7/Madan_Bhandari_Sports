<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table ='socialmedia';

    protected $fillable = [
        'facebook_link',
        'instagram_link',
        'snapchat_link',
        'linkedin_link',
        'tiktok_link',
        'youtube_link',
        'twitter_link',
        'embed_fbpage',
    ];

}
