<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipVerifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_id',
        'verifier_id',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function verifier()
    {
        return $this->belongsTo(Verifier::class);
    }
}
