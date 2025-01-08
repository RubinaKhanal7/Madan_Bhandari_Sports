<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGovernment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'district_id', 'is_active'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
