<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $profile = $user->seekerProfile;

        $opportunities = $user->opportunities()->latest()->take(5)->get();
        $notifications = $user->notifications()->where('is_read', false)->latest()->take(5)->get();

        $interestCounts = [];
        foreach ($opportunities as $opp) {
            $interestCounts[$opp->id] = $opp->interests()->count();
        }

        return view('seeker.dashboard', compact('user', 'profile', 'opportunities', 'notifications', 'interestCounts'));
    }
}
