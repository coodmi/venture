<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'user_id', 'membership_plan_id', 'status',
        'application_data', 'documents', 'admin_notes',
        'approved_at', 'expires_at',
    ];

    protected $casts = [
        'application_data' => 'array',
        'documents'        => 'array',
        'approved_at'      => 'datetime',
        'expires_at'       => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(MembershipPlan::class, 'membership_plan_id');
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
