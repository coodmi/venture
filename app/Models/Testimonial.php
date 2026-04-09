<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'designation', 'organization', 'photo',
        'content', 'rating', 'is_published', 'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
