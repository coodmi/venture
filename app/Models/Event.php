<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'title', 'slug', 'category', 'summary', 'description', 'banner',
        'event_type', 'venue', 'online_link', 'start_date', 'end_date',
        'speakers', 'agenda', 'registration_open', 'max_attendees',
        'status', 'is_featured', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'speakers'          => 'array',
        'start_date'        => 'datetime',
        'end_date'          => 'datetime',
        'registration_open' => 'boolean',
        'is_featured'       => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }
}
