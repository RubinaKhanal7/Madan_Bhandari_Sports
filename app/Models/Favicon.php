<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favicon extends Model
{
    use HasFactory;
    protected $fillable = [
        'fav_16',
        'fav_32',
        'fav_ico',
        'fav_apple',
        'fav_192', 
        'fav_512', 
        'site_manifest', 
        'is_active'
    ];
}
