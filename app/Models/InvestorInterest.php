<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorInterest extends Model
{
    protected $fillable = [
        'investor_profile_id', 'opportunity_id', 'action', 'notes', 'pipeline_stage',
    ];

    public function investorProfile()
    {
        return $this->belongsTo(InvestorProfile::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
