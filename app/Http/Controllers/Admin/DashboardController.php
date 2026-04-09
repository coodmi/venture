<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Opportunity;
use App\Models\Membership;
use App\Models\Event;
use App\Models\News;
use App\Models\EventRegistration;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'          => User::count(),
            'total_investors'      => User::role('investor')->count(),
            'total_seekers'        => User::role('seeker')->count(),
            'total_opportunities'  => Opportunity::count(),
            'pending_opportunities'=> Opportunity::where('status', 'submitted')->count(),
            'pending_memberships'  => Membership::where('status', 'submitted')->count(),
            'total_events'         => Event::count(),
            'upcoming_events'      => Event::published()->upcoming()->count(),
            'total_news'           => News::where('type', 'news')->count(),
        ];

        $recentUsers        = User::latest()->take(5)->get();
        $recentOpportunities = Opportunity::with('user')->latest()->take(5)->get();
        $pendingMemberships = Membership::with(['user', 'plan'])->where('status', 'submitted')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentOpportunities', 'pendingMemberships'));
    }
}
