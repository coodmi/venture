<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Opportunity;
use App\Models\Event;
use App\Models\News;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'          => User::count(),
            'total_investors'      => User::role('investor')->count(),
            'total_seekers'        => User::role('seeker')->count(),
            'total_opportunities'  => Opportunity::count(),
            'total_events'         => Event::count(),
            'total_news'           => News::where('type', 'news')->count(),
        ];

        $recentUsers         = User::latest()->take(5)->get();
        $recentOpportunities = Opportunity::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentOpportunities'));
    }
}
