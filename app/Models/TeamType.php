<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamType extends Model
{
    use HasFactory;
    protected $fillable = ['title_ne', 'title_en', 'is_active'];
}
