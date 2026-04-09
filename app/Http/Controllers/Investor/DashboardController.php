<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use App\Models\Event;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $profile = $user->investorProfile;

        $savedOpportunities = $profile
            ? $profile->interests()->with('opportunity')->where('action', 'saved')->latest()->take(5)->get()
            : collect();

        $interestedOpportunities = $profile
            ? $profile->interests()->with('opportunity')->where('action', 'interested')->latest()->take(5)->get()
            : collect();

        $hotDeals    = Opportunity::approved()->hotDeals()->latest()->take(4)->get();
        $upcomingEvents = Event::published()->upcoming()->orderBy('start_date')->take(3)->get();
        $latestNews  = News::published()->ofType('news')->latest('published_at')->take(4)->get();
        $notifications = $user->notifications()->where('is_read', false)->latest()->take(5)->get();

        return view('investor.dashboard', compact(
            'user', 'profile', 'savedOpportunities', 'interestedOpportunities',
            'hotDeals', 'upcomingEvents', 'latestNews', 'notifications'
        ));
    }
}
