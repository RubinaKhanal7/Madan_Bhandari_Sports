<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Team extends Model
{
    use HasFactory;

    public function setOrder($order)
    {
        $this->order = $order;
        $this->save();
    }
    
    protected $fillable = ['name', 'position', 'phone_no', 'email', 'role', 'image', 'description', 'order','status'];
}
