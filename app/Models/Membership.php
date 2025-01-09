<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'p_province',
        'p_district',
        'p_local',
        'p_ward',
        'p_tole',
        't_province',
        't_district',
        't_local',
        't_ward',
        't_tole',
        'dob',
        'citizenship_no',
        'blood_group',
        'father_name',
        'mother_name',
        'phone',
        'email',
        'member_type_id',
        'profession',
        'game_entry_date',
        'membership_date',
        'description',
        'reference_no',
        'reference_name',
        'p_image',
        'position',
        'signature'
    ];

    protected $casts = [
        'dob' => 'date',
        'game_entry_date' => 'date',
        'membership_date' => 'date',
    ];

    /**
     * Get the member type associated with the membership.
     */
    public function memberType()
    {
        return $this->belongsTo(MemberType::class);
    }
}