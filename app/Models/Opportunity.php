<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Opportunity extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'user_id', 'seeker_profile_id', 'title', 'slug', 'sector', 'stage',
        'location', 'country', 'business_problem', 'solution', 'target_market',
        'traction', 'ask_amount', 'ask_currency', 'use_of_funds', 'key_metrics',
        'pitch_deck', 'documents', 'status', 'is_featured', 'is_hot_deal',
        'featured_until', 'views',
    ];

    protected $casts = [
        'documents'      => 'array',
        'is_featured'    => 'boolean',
        'is_hot_deal'    => 'boolean',
        'featured_until' => 'datetime',
        'ask_amount'     => 'decimal:2',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seekerProfile()
    {
        return $this->belongsTo(SeekerProfile::class);
    }

    public function interests()
    {
        return $this->hasMany(InvestorInterest::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeHotDeals($query)
    {
        return $query->where('is_hot_deal', true);
    }
}
