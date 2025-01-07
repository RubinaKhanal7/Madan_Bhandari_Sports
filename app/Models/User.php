<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
    
    protected $fillable = [
        'name',
        'email',
        'phonenumber',
        'password',
        'pin',
        'is_approved',
        'role',
        'is_active',
        'created_by_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'pin'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_approved' => 'boolean',
        'is_active' => 'integer'
    ];
}