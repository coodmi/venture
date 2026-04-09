<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $table = 'about_content';

    protected $fillable = [
        'section', 'title', 'content', 'image', 'video_url',
        'extra', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'extra'        => 'array',
        'is_published' => 'boolean',
    ];
}
