<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'province_id', 'is_active'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    // public function locals()
    // {
    //     return $this->hasMany(Local::class);
    // }
}
