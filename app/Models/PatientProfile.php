<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     * These match the requirements for patient registration.
     */
    protected $fillable = [
        'user_id',
        'phone',
        'location',
        'address',
    ];

    /**
     * Get the user that owns the patient profile.
     * Inverse relationship (Every profile belongs to a base User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}