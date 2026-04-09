<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'status', // active, suspended, pending
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at'     => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function investorProfile()
    {
        return $this->hasOne(InvestorProfile::class);
    }

    public function seekerProfile()
    {
        return $this->hasOne(SeekerProfile::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function activeMembership()
    {
        return $this->hasOne(Membership::class)->where('status', 'approved')->latest();
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }

    public function notifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isInvestor(): bool
    {
        return $this->hasRole('investor');
    }

    public function isSeeker(): bool
    {
        return $this->hasRole('seeker');
    }
}
