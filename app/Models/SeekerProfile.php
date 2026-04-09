<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'company_name', 'company_logo', 'industry', 'stage',
        'team_size', 'location', 'country', 'website', 'linkedin_url',
        'twitter_url', 'business_summary', 'photo',
        'profile_completion', 'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }
}
