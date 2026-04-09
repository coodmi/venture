<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model
{
    use SoftDeletes, HasSlug;

    protected $table = 'news';

    protected $fillable = [
        'type', 'title', 'slug', 'category', 'summary', 'body',
        'cover_image', 'author', 'tags', 'attachment',
        'importance_level', 'deadline', 'audience_scope',
        'status', 'is_featured', 'published_at',
        'meta_title', 'meta_description',
    ];

    protected $casts = [
        'tags'         => 'array',
        'is_featured'  => 'boolean',
        'published_at' => 'datetime',
        'deadline'     => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
