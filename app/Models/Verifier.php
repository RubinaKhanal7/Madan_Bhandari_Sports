<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'committee',
        'signature',
        'is_active',
    ];


}
