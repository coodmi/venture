<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'user_notifications';

    protected $fillable = [
        'user_id', 'type', 'title', 'message', 'action_url', 'is_read', 'read_at',
    ];

    protected $casts = [
        'is_read'  => 'boolean',
        'read_at'  => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
