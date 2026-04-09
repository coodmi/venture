<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class MembershipPlan extends Model
{
    use HasSlug;

    protected $fillable = [
        'name', 'slug', 'category', 'description', 'benefits',
        'fee', 'currency', 'duration_months', 'eligibility',
        'is_public', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'benefits'  => 'array',
        'is_public' => 'boolean',
        'is_active' => 'boolean',
        'fee'       => 'decimal:2',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
