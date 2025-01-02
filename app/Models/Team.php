<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Team extends Model
{
    use HasFactory;

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];
    
    protected $fillable = [
        'team_type_id',
        'name',
        'position',
        'email',
        'phone',
        'is_featured',
        'is_active',
    ];

    public function teamType()
    {
        return $this->belongsTo(TeamType::class);
    }
}
