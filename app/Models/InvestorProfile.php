<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvestorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'investor_type', 'organization', 'designation',
        'sector_preferences', 'geographic_interest', 'ticket_size_min',
        'ticket_size_max', 'investment_stage', 'risk_profile',
        'linkedin_url', 'website', 'bio', 'photo',
        'verification_status', 'profile_completion', 'is_visible',
    ];

    protected $casts = [
        'sector_preferences'  => 'array',
        'geographic_interest' => 'array',
        'is_visible'          => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interests()
    {
        return $this->hasMany(InvestorInterest::class);
    }
}
