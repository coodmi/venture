<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformStat extends Model
{
    protected $fillable = ['key', 'label', 'value', 'icon', 'sort_order', 'is_visible'];

    protected $casts = [
        'is_visible' => 'boolean',
    ];
}
